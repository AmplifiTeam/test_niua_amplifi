<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Pipeline extends BaseController{
public  function __construct(){
helper(['form', 'url', 'text']);
helper("app");
$this->db=db_connect();
}

public function data_pipeline(){
//die("Fine here...");
$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City'];
$loginUserRole=$logedInUserDetail['role'];
$loginUserCityId=$logedInUserDetail['City_ID'];
$loginUserId=$logedInUserDetail['user_id'];
if($loginUserRole!=5){
$url=base_url()."admin/dashboard";
header("Location: $url"); exit();
}
$SurveyModel=new \App\Models\SurveyModel();
$SectorModel=new \App\Models\SectorModel();       
$Users=new \App\Models\Users();
$data['allSurvey']=$SurveyModel->findAll();
$data['allsector']=$SectorModel->findAll();
$data['city']=$Users->where('role',4)->findAll();
// echo "<pre>";  print_r($data['city']);die;
return view('backend/pipeline/pipelinedata',$data);
}

public function pipeline_filter(){
$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City'];
$loginUserRole=$logedInUserDetail['role'];
$loginUserCityId=$logedInUserDetail['City_ID'];
$loginUserId=$logedInUserDetail['user_id'];
if($loginUserRole!=5){
$url=base_url()."admin/dashboard";
header("Location: $url"); exit();
}        
$SurveyModel=new \App\Models\SurveyModel();
$questionModel=new \App\Models\QuestionModel();
$surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
$SectorModel=new \App\Models\SectorModel();
$Users=new \App\Models\Users();
$SurveyResultModel=new \App\Models\Survey_result();
$response=['status'=>0, 'msg'=>'', 'html'=>''];
$logedInUserDetail=session('admin_detail');
$survey=trim($this->request->getPost('survey'));
$sector=trim($this->request->getPost('sector'));
$city=trim($this->request->getPost('city'));
if($survey==''){
$response["message"]="Survey not found!";
echo json_encode($response); exit();
}
if(!empty($survey) && !empty($sector) && !empty($city)){
$getQuestions['filter']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$city)->where('validator_2_status',1)->findAll();
}else if(!empty($survey) && !empty($sector)){
$getQuestions['filter']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('validator_2_status',1)->findAll();
}else if(!empty($survey)){
$getQuestions['filter']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('validator_2_status',1)->findAll();
}      

//print_data($getQuestions['filter']);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('A3:A4');
$sheet->getCell('A3')->setValue( 'S. No.');
$sheet->mergeCells('B3:B4');
$sheet->getCell('B3')->setValue('Question Title');
$sheet->mergeCells('C3:C4');
$sheet->getCell('C3')->setValue('Question Type');
$sheet->mergeCells('D3:D4');
$sheet->getCell('D3')->setValue('Value');
$sheet->mergeCells('E3:E4');
$sheet->getCell('E3')->setValue('City Id');
$sheet->mergeCells('F3:F4');
$sheet->getCell('F3')->setValue('Sector');
$sheet->mergeCells('G3:G4');
$sheet->getCell('G3')->setValue('Framework');
$sheet->mergeCells('H3:H4');
$sheet->getCell('H3')->setValue('Answer Date');
$sheet->mergeCells('F3:F4');
$sheet->mergeCells('G3:G4');
$sheet->mergeCells('H3:H4');
$sheet->mergeCells('I3:I4');
$sheet->mergeCells('J3:J4');
$sheet->mergeCells('K3:K4');
$sheet->mergeCells('L3:L4');

// $sheet->mergeCells('A1:L1');
$sheet->getCell('A1')->setValue('');
// $sheet->getCell('A2')->setValue($getDetail['Survey_Name'].' Details');
$sheet->getCell('A2')->setValue("testing");
$sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
$sheet->mergeCells('A2:L2');
$sheet->getStyle("A2:L2")->getFont()->setBold(true)->getColor()->setRGB('000000');
$sheet->getStyle("A3:L4")->getFont()->setBold(true)->getColor()->setRGB('000000');
$sheet->getStyle('A2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
$sheet->getStyle('A3:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
$sheet->getStyle('A1:L4')->getAlignment()->setHorizontal('center');
$styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
$spreadsheet->getActiveSheet()->getStyle("A1:L15")->applyFromArray($styleArray);
$counter=5;
$i=1;
if(!empty($getQuestions['filter'])){
foreach($getQuestions['filter'] as $key=>$questionDetail){
$getQuestionMasterDetail=$surveyquestionMasterModel->where('QB_ID',$questionDetail['QB_ID'])->first();
$getQuestionMasterDetail1=$questionModel->where('QB_ID',$questionDetail['QB_ID'])->first();
$sheet->setCellValue('A'.$counter, $i);
$sheet->setCellValue('B'.$counter, $getQuestionMasterDetail1['Description']);    
$sheet->setCellValue('C'.$counter, getUOMName($getQuestionMasterDetail['UOM_ID']));          
$sheet->setCellValue('D'.$counter, $questionDetail['Value']);      
$sheet->setCellValue('E'.$counter, $questionDetail['City_ID']);               
$sheet->setCellValue('F'.$counter, getSectorName($questionDetail['sector_id']));      
$sheet->setCellValue('G'.$counter, getFrameworkName($questionDetail['Framework_ID']));   
$sheet->setCellValue('H'.$counter, date('d-m-Y',strtotime($questionDetail['answer_date'])));
$counter++;
$i++;
}
}

$fileName=str_replace(" ","-","test")."-".date("Y-m-d-His").".xlsx";
$writer=new Xlsx($spreadsheet);
ob_end_clean();
header('Content-Disposition: attachment;filename="'.$fileName.'";');
header('Content-Type: application/csv; charset=UTF-8');
$writer->save('php://output');
exit();
}



public function publishToDashboard(){
$surveySubmittedCities=[];
$today=date("Y-m-d");
$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City_ID'];
$db= \Config\Database::connect(); 
$response=['status'=>0, 'msg'=>''];
$SurveyResultModel=new \App\Models\Survey_result();
$City_submissionModel=new \App\Models\City_submission();  
$questionModel=new \App\Models\QuestionModel();
$SectorModel=new \App\Models\SectorModel();
$SurveyModel = new \App\Models\SurveyModel();
$surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
$ValidatorJobCity=new \App\Models\Validator_jobs_cities();
$Users=new \App\Models\Users();
$geographyModel=new \App\Models\Geography();
$surveyCityModel=new \App\Models\SurveyCity();
$SurveyResultDashboardModel=new \App\Models\SurveyResultDashboard();
$SecdpModel=new \App\Models\Secdp();
$Timeserieschart_financeModel=new \App\Models\Timeserieschart_finance();

$getsurvey=trim($this->request->getPost('survey'));
$chkSurvey=$SurveyModel->where('Survey_ID',$getsurvey)->where('publish_status',2)->where('is_uof',1)->first();
$getAllCityOfficialsWhoSubmitted=$City_submissionModel->where('Survey_ID',$getsurvey)->where('submission_status',1)->findAll();
//echo "getAllCityOfficialsWhoSubmitted ::".count($getAllCityOfficialsWhoSubmitted)."---->";
if(!empty($chkSurvey)){
$surveyEndDate=$chkSurvey["To_Date"];

if(strtotime($today)>strtotime($surveyEndDate)){ //Condition1

//Get Survey All the sector...
$getSurveyAllSectors=$surveyquestionMasterModel->select('DISTINCT("Sector_ID"),Survey_ID')->where('Survey_ID',$getsurvey)->findAll();
//echo "getSurveyAllSectors ::".count($getSurveyAllSectors)."---->";
//Get Survey All created jobs...
$getSurveyAllJobs=$ValidatorJobCity->where('survey_id',$getsurvey)->findAll();
//echo "getSurveyAllJobs ::".count($getSurveyAllJobs)."---->";

$getSurveyAllJobsSubmittedByV2=$ValidatorJobCity->where('survey_id',$getsurvey)->where('v2_status',1)->findAll();
//echo "getSurveyAllJobsSubmittedByV2 ::".count($getSurveyAllJobsSubmittedByV2)."---->";
//echo $surveyquestionMasterModel->lastQuery();
$requiredJobs=count($getSurveyAllSectors)*count($getAllCityOfficialsWhoSubmitted);
//echo "requiredJobs ::".$requiredJobs."---->";
if($getSurveyAllJobs=$requiredJobs){ //Condition2
//echo 'In Condition2---->';
if($getSurveyAllJobs=$getSurveyAllJobsSubmittedByV2){ //Condition3
$userToBePush=[];
$surveyCityToBePush=[];
$surveyResultDashboardToBePush=[];
$secdpDataArrToBePush=[];
$financeDataArrToBePush=[];
//Push to dashboard code here....
//echo 'In Condition3---->';
$getAllCityOfficialUsers=$Users->where('role',4)->findAll();
//print_data($getAllCityOfficialUsers);
if(!empty($getAllCityOfficialUsers)){
foreach($getAllCityOfficialUsers as $userKey=>$userDetail){
$cityId=$userDetail["City_ID"];
$chkUserInGeography=$geographyModel->where('City_ID',$cityId)->first();
if(empty($chkUserInGeography)){
$geographyDataArr=array(
'City_ID'=>$userDetail["City_ID"],
'City'=>$userDetail["City"],
'State'=>$userDetail["State"],
'Lat'=>$userDetail["Lat"],
'Long'=>$userDetail["Long"],
'City_Type'=>$userDetail["City_Type"],
'State_Code'=>$userDetail["State_Code"],
'Zone'=>$userDetail["Zone"],
);
array_push($userToBePush,$geographyDataArr);
}

}
//print_data($userToBePush); 
if(!empty($userToBePush)){
   $geographyModel->insertBatch($userToBePush);
}

}

//SurveyCity...
if(!empty($getAllCityOfficialsWhoSubmitted)){
foreach($getAllCityOfficialsWhoSubmitted as $cityKey=>$citySubmissionDetail){
$co_submitted_cityId=$citySubmissionDetail["City_ID"];
$co_submitted_surveyId=$citySubmissionDetail["Survey_ID"];
array_push($surveySubmittedCities,$co_submitted_cityId);
$getCityUserDetail=$Users->where('City_ID',$co_submitted_cityId)->first();
$chkSurveyCity=$surveyCityModel->where('Survey_ID',$co_submitted_surveyId)->where('City_ID',$co_submitted_cityId)->first();
if(empty($chkSurveyCity)){

$surveyCityDataArr=array(
'Survey_ID'=>$co_submitted_surveyId,
'Survey_Name'=>$chkSurvey["Survey_Name"],
'City_ID'=>$getCityUserDetail["City_ID"],
'City'=>$getCityUserDetail["City"],
'State'=>$getCityUserDetail["State"],
'State_Code'=>$getCityUserDetail["State_Code"],
'Zone'=>$getCityUserDetail["Zone"],
);
array_push($surveyCityToBePush,$surveyCityDataArr);
}
}
//print_data($surveyCityToBePush);
if(!empty($surveyCityToBePush)){
   $surveyCityModel->insertBatch($surveyCityToBePush);
}
}

//FactSurveyResultDashboard...
$builder=$this->db->table("fact_surveyresults_dashboard");
$builder->select('fact_surveyresults_dashboard.Survey_ID');
$builder->where('Survey_ID', $getsurvey);
$builder->limit(1);
$allFactSurveyResultDashboard=$builder->get()->getResult();


//$getSurveyAllAnswer=$SurveyResultModel->where("Survey_ID",$getsurvey)->whereIn("validator_2_status",["1","2"])->findAll();
//print_data($surveySubmittedCities);
$getSurveyAllAnswer=$SurveyResultModel->where("Survey_ID",$getsurvey)->whereIn("City_ID",$surveySubmittedCities)->findAll();
//print_data($getSurveyAllAnswer);
if(!empty($getSurveyAllAnswer)){
foreach($getSurveyAllAnswer as $Anskey=>$AnsDetail){
$quest_qbId=$AnsDetail["QB_ID"];
$quest_framework=$AnsDetail["Framework_ID"];
$quest_Answer=trim($AnsDetail["Value"]);
$quest_city=trim($AnsDetail["City_ID"]);
$quest_sector=$AnsDetail["sector_id"];
$getParentQB_ID=trim($AnsDetail["parent_qb_id"]);
$parentChildConcatinationQuestion='';
$getCityOffUserDetail=$Users->where('City_ID',$quest_city)->first();
$GetCurrentQuestionDetail=getQuestionDetail(trim($quest_qbId));
$frameworkDetail=getFrameworkDetail(trim($quest_framework));
$uomDetail=getQuestionUnitOfMeasurement($GetCurrentQuestionDetail["UOM_ID"]);
if($getParentQB_ID!=0){
    $GetConcatinationParentQuestionDetail=getQuestionDetail($getParentQB_ID);
    $parentChildConcatinationQuestion.=$GetConcatinationParentQuestionDetail["Description"];
    $parentChildConcatinationQuestion.="-".$GetCurrentQuestionDetail["Description"];
}else{
$parentChildConcatinationQuestion=isset($GetCurrentQuestionDetail["Description"])?$GetCurrentQuestionDetail["Description"]:'';
}


$FactSurveyResultDashboardArr=array(
'Survey_ID'=>$getsurvey,
'Survey_Name'=>isset($chkSurvey["Survey_Name"])?$chkSurvey["Survey_Name"]:'',
'survey_description'=>isset($chkSurvey["Description"])?$chkSurvey["Description"]:'',
'Framework_ID'=>$quest_framework,
'Framework'=>isset($frameworkDetail["Framework"])?$frameworkDetail["Framework"]:'',
'framework_description'=>isset($frameworkDetail["Description"])?$frameworkDetail["Description"]:'',
'QB_ID'=>$quest_qbId,
'Qb_Code'=>isset($GetCurrentQuestionDetail["Qb_Code"])?$GetCurrentQuestionDetail["Qb_Code"]:'',
'Parent_QB_ID'=>$getParentQB_ID,
'DataPoint'=>$parentChildConcatinationQuestion,
'UOM'=>isset($uomDetail["UOM"])?$uomDetail["UOM"]:'',
'Sector_ID'=>$quest_sector,
'Sector'=>getSectorName($quest_sector),
'City_ID'=>$quest_city,
'City'=>isset($getCityOffUserDetail["City"])?$getCityOffUserDetail["City"]:'',
'Lat'=>isset($getCityOffUserDetail["Lat"])?$getCityOffUserDetail["Lat"]:0,
'Long'=>isset($getCityOffUserDetail["Long"])?$getCityOffUserDetail["Long"]:0,
'City_Type'=>isset($getCityOffUserDetail["City_Type"])?$getCityOffUserDetail["City_Type"]:'',
'State'=>isset($getCityOffUserDetail["State"])?$getCityOffUserDetail["State"]:'',
'State_Code'=>isset($getCityOffUserDetail["State_Code"])?$getCityOffUserDetail["State_Code"]:'',
'Zone'=>isset($getCityOffUserDetail["Zone"])?$getCityOffUserDetail["Zone"]:'',
'county'=>"India",
'numeratorvalue'=>$quest_Answer,
'denominator_qb_id'=>0,
'Denominator'=>"* None",
'denominatorvalue'=>1,
'denominator_type'=>"",
'NumeratorResult'=>0,
'DenominatorResult'=>1,
'Result'=>(is_numeric($quest_Answer))?$quest_Answer:0,
'Classification'=>"",
'city_classfication_desc'=>"",
'population_projected'=>0,
'Population'=>"",
'exceptioncode'=>"",
'exception'=>"",
'Data_Source'=>isset($GetCurrentQuestionDetail["Data_Source"])?$GetCurrentQuestionDetail["Data_Source"]:'',
'Reference_Period'=>isset($GetCurrentQuestionDetail["Reference_Period"])?$GetCurrentQuestionDetail["Reference_Period"]:'',
'DetailedDescription'=>isset($GetCurrentQuestionDetail["DetailedDescription"])?$GetCurrentQuestionDetail["DetailedDescription"]:''
);

array_push($surveyResultDashboardToBePush,$FactSurveyResultDashboardArr);

//Publish Dashboard fact_surveyresults_dashboard_secdp Tbl Data... 
$secdpDataArr=array(
    'Survey_ID'=>$getsurvey,
    'DataPoint'=>$parentChildConcatinationQuestion,
    'Sector'=>getSectorName($quest_sector),
    'Denominator'=>"None",
    'Survey_Name'=>isset($chkSurvey["Survey_Name"])?$chkSurvey["Survey_Name"]:'',
);
array_push($secdpDataArrToBePush,$secdpDataArr);


//Publish Dashboard fact_timeserieschart_finance Tbl Data...
$financeDataArr=array(
    'Survey_ID'=>$getsurvey,
    'city'=>isset($getCityOffUserDetail["City"])?$getCityOffUserDetail["City"]:'',
    'result'=>(is_numeric($quest_Answer))?$quest_Answer:0,
    'datapoint'=>$GetCurrentQuestionDetail["Description"],
    'year'=>isset($chkSurvey["survey_year"])?$chkSurvey["survey_year"]:'',
    'State'=>isset($getCityOffUserDetail["State"])?$getCityOffUserDetail["State"]:'',
    'Zone'=>isset($getCityOffUserDetail["Zone"])?$getCityOffUserDetail["Zone"]:'',
    'Sector'=>getSectorName($quest_sector),
    'UOM'=>isset($uomDetail["UOM"])?$uomDetail["UOM"]:'',
    'date_filled'=>$AnsDetail["Date_filled"]
);

$excludeUOM=['42','43','44','28','29','40','30','39','36','25','8','31','32','33','34','41',''];
if(!in_array($GetCurrentQuestionDetail["UOM_ID"],$excludeUOM)){
  array_push($financeDataArrToBePush,$financeDataArr);
}

}
}


//print_data($financeDataArrToBePush);
//print_data($secdpDataArrToBePush);
//print_data($surveyResultDashboardToBePush);


if(!empty($surveyResultDashboardToBePush) && empty($allFactSurveyResultDashboard)){
    $SurveyResultDashboardModel->insertBatch($surveyResultDashboardToBePush);
}



$chkSecdp=$this->db->table("fact_surveyresults_dashboard_secdp");
$chkSecdp->select('fact_surveyresults_dashboard_secdp.Survey_ID');
$chkSecdp->where('Survey_ID', $getsurvey);
$chkSecdp->limit(1);
$allchkSecdp=$chkSecdp->get()->getResult();

if(!empty($secdpDataArrToBePush) && empty($allchkSecdp)){
    $SecdpModel->insertBatch($secdpDataArrToBePush);
}

$finance=$this->db->table("fact_timeserieschart_finance");
$finance->select('fact_timeserieschart_finance.Survey_ID');
$finance->where('Survey_ID', $getsurvey);
$finance->limit(1);
$allfinance=$finance->get()->getResult();
if(!empty($financeDataArrToBePush) && empty($allfinance)){
    $Timeserieschart_financeModel->insertBatch($financeDataArrToBePush);
}
$response['status']=1;
$response['msg']="Data published to dashboard successfully!";
}else{ //End Condition3
    $response['msg']="Survey all jobs still not submitted by validator-2";  
}
}else{//End Condition2
    $response['msg']="Survey all jobs still not created!";
}
}else{ //End Condition1
    $response['msg']="Survey is still running!";
} 
}else{
    $response['msg']="Survey not published!";
    echo json_encode($response); exit();
}
   echo json_encode($response); exit();
} // End of the function.



public function pushCityOfficialUserFromExcel(){
$Users=new \App\Models\Users();
$State_Model=new \App\Models\State_Model();
$Validator_sector=new \App\Models\Validator_sector();  
$DataArr=array();
//$file=fopen("assets/uploads/niua_co_csv.csv", "r");
$file=fopen("assets/uploads/aulbp_cities_971_final.csv", "r");
$i=0;
$maxCity_id=$Users->select('MAX("City_ID")')->first();
//die($maxCity_id['max']);
$cityIDToInsert=0;
    while(($filedata=fgetcsv($file, 1000, ",")) !== FALSE){
        
                if($i>0){
                $city=trim($filedata[2]);
                // echo ($i).". ".$city;
                // echo "</br>";
                //die($city."<===>");
                if($city==""){
                    echo json_encode(array("status" => "error", "msg" => "City is empty at ".$i+1)); 
                    die();
                }

                if($cityIDToInsert!=0){
                    $cityIDToInsert=$cityIDToInsert+1;
                }else{
                    $cityIDToInsert=(int)$maxCity_id['max']+1;
                }


                $chkUser=$Users->where('lower("City")',strtolower($city))->first();
                //$chkUser=$Users->where('City',$city)->first();
                /*if(!empty($chkUser)){
                    //echo $Users->getLastQuery();
                    echo json_encode(array("status" => "error", "msg" => "City already exist at ".$i+1)); 
                    die();
                }*/
                // echo trim($filedata[6]);
                // echo "</br>";
                $generated_password=md5(trim($filedata[6]));

                $userArr=array(
                    'City_ID' =>$cityIDToInsert,
                    'City' =>$city,
                    'State' =>trim(ucwords(strtolower($filedata[0]))),
                    'Lat' =>0,
                    'Long' =>0,
                    'City_Type' =>'Other city',
                    'State_Code' =>trim($filedata[3]),        
                    'Zone' =>'Central Zone',
                    'role' =>4,
                    'user_password'=>$generated_password
                );
                //if(empty($chkUser)){
                  array_push($DataArr, $userArr);
                //}  
                 
              }
              $i++;
    }
  print_data($DataArr);
} // End of the function.







} // End of the class.
?>