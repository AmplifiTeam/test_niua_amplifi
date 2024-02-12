<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class UserMaster extends BaseController{

    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }

    public function user_master(){
            /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
            $SectorModel=new \App\Models\SectorModel();
            $State_Model=new \App\Models\State_Model();
            $User_master_role=new \App\Models\User_master_role();
            $Users=new \App\Models\Users();
            $data['allsector']=$SectorModel->orderBy('Sector')->findall();
            $data['user_type']=$User_master_role->orderBy('id')->findall();
            $data['statedata'] = $State_Model->orderBy('state', 'ASC')->findAll();
            $data['statedata'] = $State_Model->orderBy('state', 'ASC')->findAll();
            $notrequired = ['SuperAdmin','validator2','validator1','','Admin'];
            $data['zoneData'] = $Users->select('DISTINCT("Zone")')->whereNotIn('Zone', $notrequired)->findAll();
            // print_data($data['zoneData']);
            //  echo "<pre>"; print_r($data['statedata']);die;
            return view('backend/User/userfile',$data);
    }

    public function add_user(){
            /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
            $db= \Config\Database::connect(); 
            $Users=new \App\Models\Users();
            $State_Model=new \App\Models\State_Model();
            $Validator_sector=new \App\Models\Validator_sector();        
            $validation=  \Config\Services::validation();
            $response=['status'=>0, 'msg'=>'', 'validation' => ''];
            $role=$this->request->getPost('role');
            $city=trim($this->request->getPost('city'));
            $password=trim($this->request->getPost('password'));
            $Cpassword=trim($this->request->getPost('Cpassword'));
            $state=trim($this->request->getPost('state'));
            $lat=(trim($this->request->getPost('lat')) !='')?$this->request->getPost('lat'):0;
            $long=(trim($this->request->getPost('long')) !='')?$this->request->getPost('long'):0;
            $zone=$this->request->getPost('zone');
            $userSector=$this->request->getPost('userSector');
            $city_type='Other city';
            $City_ID = 0;
            $state_code='';
            if($role==4){
               $userSector=[];
               $state_code=$State_Model->select('state_code')->where("state", $state)->first();
               $state_code=$state_code['state_code'];
            } 

            //Chk City
            $chkUser=$Users->where('lower("City")',strtolower($city))->first();
            // $chkUser=$Users->where('City',$city)->first();

            if(!empty($chkUser)){
                $errorMsg['fieldName'] = 'city';
                $errorMsg['errorMsgFieldName'] = 'err_city';
                $errorMsg['errorMsg'] = 'Already exist!';
                $response['validation'] = $errorMsg;
                echo json_encode($response);exit();
            }

            $maxCity_id=$Users->select('MAX("City_ID")')->first();

            if(!empty($maxCity_id)){
                $City_ID = (int)$maxCity_id['max'] + 1;
            }else{
                $errorMsg['fieldName'] = 'city';
                $errorMsg['errorMsgFieldName'] = 'err_city';
                $errorMsg['errorMsg'] = 'Something went wrong!';
                $response['validation'] = $errorMsg;
                echo json_encode($response);exit();
            } 
            
            $savedata = [
            'City_ID' => $City_ID,
            'City' => $city,
            'State' => $state,
            'Lat' => $lat,
            'Long' => $long,
            'City_Type' => $city_type,
            'State_Code' => $state_code,
            'Zone' => $zone,
            'role' => $role,
            'user_password' =>md5($password)
            ];
            //print_data($savedata);
            $Users->insert($savedata);
            $inserted_page_id=$Users->getInsertID();
           
            // Validator Sectors...
            $data=array();
            if(!empty($userSector)){
                foreach ($userSector as $key => $sector) {
                    $savedatavalue= [
                    'user_id' =>  $inserted_page_id,
                    'sector_id' => $sector,
                    'City_ID' => $City_ID,
                    'added_on' => date('Y-m-d')
                    ];
                    array_push($data, $savedatavalue);
                }      
                $Validator_sector->insertBatch($data);                
            }
            $response['inserted_id']=$inserted_page_id;
            $response['status']=1;
            $response['msg']="User added successfully";
            echo json_encode($response);
            exit;
    }

    public function user_list(){
        /* Check Valid User */
        $getLogedInUserDetail=session('admin_detail');
        $getLoginUserRole=$getLogedInUserDetail['role'];
        if($getLoginUserRole!=5){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        $Users=new \App\Models\Users();
        $data['listdata'] = $Users->orderBy('user_id','DESC')->findAll();
        return view('backend/User/listuser',$data);
    }
  
    public function user_fetch(){
        /* Check Valid User */
        $getLogedInUserDetail=session('admin_detail');
        $getLoginUserRole=$getLogedInUserDetail['role'];
        if($getLoginUserRole!=5){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        $allSectors=[];
        $Users=new \App\Models\Users();
        $Validator_sector=new \App\Models\Validator_sector();
        $User_master_role=new \App\Models\User_master_role();
        $SectorModel=new \App\Models\SectorModel();
        $State_Model=new \App\Models\State_Model();
        $uri = service('uri');
        $geturi = $uri->getSegments();
        $id = $geturi[2];
        $data['list']=$Users->where('user_id', $id)->first();
        //print_r($data['list']);die;
        if($id=="" || empty($data['list'])){
              $url=base_url()."/admin/user-list";
              header("Location: $url"); exit();
        }
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $data['sectorlist']=$Validator_sector->select('sector_id,user_id')->where('user_id', $id)->findAll();
        if(!empty($data['sectorlist'])){
            foreach ($data['sectorlist'] as $key=>$value){
                $sec=$value['sector_id'];
                array_push($allSectors,$sec);
            }
        }
        $data['userSectors']=implode(',',$allSectors);
        $data['statedata'] = $State_Model->orderBy('state', 'ASC')->findAll();
        $data['userRole']=$data['list']['role'];
        $data['user']=$User_master_role->orderBy('id')->findall();
        return view('backend/User/edituser',$data);
    }

    public function edit_user(){
        $db= \Config\Database::connect(); 
        $Users=new \App\Models\Users();
        $Validator_sector=new \App\Models\Validator_sector();
        $State_Model=new \App\Models\State_Model();
        $response=['status'=>0, 'msg'=>''];
        $city_id=trim($this->request->getPost('user_city_id'));
        $city=$this->request->getPost('city');
        $state=$this->request->getPost('state');
        $lat=(trim($this->request->getPost('lat')) !='')?$this->request->getPost('lat'):0;
        $long=(trim($this->request->getPost('long')) !='')?$this->request->getPost('long'):0;
        // $state_code = $this->request->getPost('state_code');
        $zone=$this->request->getPost('zone');
        $role=$this->request->getPost('role');
        $password=$this->request->getPost('password');
        $Cpassword=$this->request->getPost('Cpassword');
        $status=$this->request->getPost('status');
        $id=$this->request->getPost('id');
        $userSector=$this->request->getPost('userSector');
        $state_code=$State_Model->select('state_code')->where("state", $state)->first();
        //print_r($state);die;
      
        if($role==2 || $role==3){
          $state='';
          $lat=0;
          $long=0;
          $city_type='';
          $state_code='';
          $zone='';
        }
     
        if($role==4){
            $userSector='';
        }
       
        $updatedata=[
             'State' => $state,
             'Lat' => $lat,
             'Long' => $long,
             'State_Code' => $state_code,
             'Zone' => $zone,
             'status' => $status
         ];

        if($password!=''){
          $updatedata['user_password']=md5($password); 
        }
        $Users->update($id, $updatedata);
        $inserted_page_id=$id; 
       
        $data=array();             
        if(!empty($userSector)){
         $Validator_sector->where('user_id', $id)->delete();
          foreach ($userSector as $key => $sector) {
              $savedatavalue= [
                  'user_id' =>  $id,
                  'sector_id' => $sector,
                  'City_ID' => $city_id,
                  'added_on' => date('Y-m-d')
              ];
              array_push($data, $savedatavalue);
        }
        $Validator_sector->insertBatch($data);
      }
       $response['updated_id']=$inserted_page_id;
       $response['status']=1;
       $response['msg']="User updated successfully";
       echo json_encode($response);  exit;
    }
    
    public function download_excel(){
      $response=['status'=>0, 'msg'=>'', 'html'=>''];
        $logedInUserDetail=session('admin_detail');
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        //print_data($logedInUserDetail);
        $questionModel=new \App\Models\QuestionModel();
        $loginUserCity=$logedInUserDetail['City_ID'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $surveyId=$geturi[2];
        $City_ID=$geturi[3];
        $data['excelData']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$surveyId)->where('City_ID',$City_ID)->findAll();
        if($surveyId=="" || empty( $data['excelData'])){
          $response["message"]="Survey not found!";
          echo json_encode($response); exit();
        }
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
        $sheet->getCell('H3')->setValue('Added On');
        $sheet->getCell('I3')->setValue('Remark By City');
        $sheet->getCell('J3')->setValue('V1 Status');
        $sheet->getCell('K3')->setValue('V2 Status');
        $sheet->mergeCells('F3:F4');
        $sheet->mergeCells('G3:G4');
        $sheet->mergeCells('H3:H4');
        $sheet->mergeCells('I3:I4');
        $sheet->mergeCells('J3:J4');
        $sheet->mergeCells('K3:K4');
        $sheet->mergeCells('L3:L4');
        $sheet->getCell('A1')->setValue('');
        $sheet->getCell('A2')->setValue(getCityNameByCity_id($City_ID).' ( '.getSurveyName($surveyId).' ) ');
        $sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle("A2:L2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle("A3:L4")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle('A2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
        $sheet->getStyle('A3:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
        $sheet->getStyle('A1:L4')->getAlignment()->setHorizontal('center');
        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
        $counter=5;
        $i=1;
        if(!empty($data['excelData'])){
            foreach($data['excelData'] as $key=>$questionDetail){
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
                $remarkData = getCityRemarksAndDocumentDetail($surveyId,$questionDetail['sector_id'],$questionDetail['QB_ID'],$questionDetail['City_ID']);

                if(!empty($remarkData)){
                    $remarks = $remarkData['city_remark'];
                }else{
                    $remarks = '';
                }
                $sheet->setCellValue('I'.$counter,$remarks);

                $v1Remarks = 'Not Validated';
                if($questionDetail["validator_1_status"]==1){
                    $v1Remarks ="Approved";
                }else if($questionDetail["validator_1_status"]==2){
                    $v1Remarks ="Rejected";
                }else if($questionDetail["validator_1_status"]==3){
                    $v1Remarks ="Reverted To City";
                }
                $sheet->setCellValue('J'.$counter, $v1Remarks );

                $v2Remarks = 'Not Validated';
                if($questionDetail["validator_2_status"]==1){
                    $v2Remarks ="Approved";
                }else if($questionDetail["validator_2_status"]==2){
                    $v2Remarks ="Rejected";
                }else if($questionDetail["validator_2_status"]==3){
                    $v2Remarks ="Reverted To City";
                }
                $sheet->setCellValue('K'.$counter, $v2Remarks);
                $counter++;
                $i++;
            }
        }
        $spreadsheet->getActiveSheet()->getStyle("A1:L".$counter)->applyFromArray($styleArray);
        $fileName = str_replace(" ","-",$City_ID)."-".date("Y-m-d-His").".xlsx";
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        exit();
    }

    public function download_myJobsData_excel(){
      $response=['status'=>0, 'msg'=>'', 'html'=>''];
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City_ID'];
        $uri=service('uri');
        $geturi=$uri->getSegments();
        
        $survey_id=$geturi[2];
        $sector_id=$geturi[3];
        $city_id=$geturi[4];


        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();


        if($survey_id > 0 && $survey_id!=''){
            $ValidatorJobCity->select('DISTINCT ON("job_id") job_id,created_on,sector_id,survey_id,updated_on,validator_1_user_id,validator_2_user_id,sand_to_v2,v2_status')->where('survey_id',$survey_id);

            if($sector_id !='' && $sector_id > 0){
                $ValidatorJobCity->where('sector_id',$sector_id);
            }
            if($city_id !='' && $city_id > 0){
                $ValidatorJobCity->where('city_id',$city_id);
            }
            
            $jobData = $ValidatorJobCity->orderBy('job_id,updated_on','DESC')->findAll();

            if(!empty($jobData)){
                foreach($jobData as $key=>$job){
                    $jobData[$key]['created_on'] = date('d-m-Y',strtotime($job['created_on']));
                    $jobData[$key]['sector_Name'] = getSectorName($job['sector_id']);
                    $jobData[$key]['survey_Name'] = getSurveyName($job['survey_id']);
                    $jobData[$key]['V1_name'] = getCityNameByUserId($job['validator_1_user_id']);
                    $jobData[$key]['V2_name'] = getCityNameByUserId($job['validator_2_user_id']);
                    $jobData[$key]['cityNameArray'] = array();
                    $jobData[$key]['total_QuestionCount'] = 0;
                    $jobData[$key]['total_v1_attempt'] = 0;
                    $jobData[$key]['total_v2_attempt'] = 0;
                    $cityData = $ValidatorJobCity->select('city_id')->where('job_id',$job['job_id'])->findAll();
                    if(!empty($cityData)){
                        foreach($cityData as $ckey=>$city){
                            $total_QuestionCount = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('City_ID',$city['city_id'])->countAllResults();
                            $total_v1_attempt = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('validator_1_status !=',0)->where('City_ID',$city['city_id'])->countAllResults();

                            $total_v2_attempt = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('validator_2_status !=',0)->where('City_ID',$city['city_id'])->countAllResults();
                            
                            $jobData[$key]['total_QuestionCount'] = $jobData[$key]['total_QuestionCount'] + $total_QuestionCount;

                            $jobData[$key]['total_v1_attempt'] = $jobData[$key]['total_v1_attempt'] + $total_v1_attempt;

                            $jobData[$key]['total_v2_attempt'] = $jobData[$key]['total_v2_attempt'] + $total_v2_attempt;

                            array_push($jobData[$key]['cityNameArray'],getCityNameByCity_id($city['city_id']));
                        }
                    }
                }
            }
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A3:A4');
        $sheet->getCell('A3')->setValue( 'S. No.');
        $sheet->mergeCells('B3:B4');
        $sheet->getCell('B3')->setValue('Job ID');
        $sheet->mergeCells('C3:C4');
        $sheet->getCell('C3')->setValue('Creation Date');
        $sheet->mergeCells('D3:D4');
        $sheet->getCell('D3')->setValue('Survey Name');
        $sheet->mergeCells('E3:E4');
        $sheet->getCell('E3')->setValue('Sector Name');
        $sheet->mergeCells('F3:F4');
        $sheet->getCell('F3')->setValue('Total Cities');
        $sheet->mergeCells('G3:G4');
        $sheet->getCell('G3')->setValue('Cities Name');
        $sheet->mergeCells('H3:H4');
        $sheet->getCell('H3')->setValue('Total Questions');
        $sheet->getCell('I3')->setValue('Validator 1');
        $sheet->getCell('J3')->setValue('Validated By V1');
        $sheet->getCell('K3')->setValue('Validator 2');
        $sheet->getCell('L3')->setValue('Validated By V2');
        $sheet->mergeCells('F3:F4');
        $sheet->mergeCells('G3:G4');
        $sheet->mergeCells('H3:H4');
        $sheet->mergeCells('I3:I4');
        $sheet->mergeCells('J3:J4');
        $sheet->mergeCells('K3:K4');
        $sheet->mergeCells('L3:L4');
        $sheet->getCell('A1')->setValue('');

        $sheet->getCell('A2')->setValue(' Jobs Data List');
        $sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle("A2:L2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle("A3:L4")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle('A2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
        $sheet->getStyle('A3:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
        $sheet->getStyle('A1:L4')->getAlignment()->setHorizontal('center');
        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
        
        $counter=5;
        $i=1;
        if(!empty($jobData)){
            foreach($jobData as $key=>$job){
                $sheet->setCellValue('A'.$counter, $i);
                $sheet->setCellValue('B'.$counter, $job['job_id']);    
                $sheet->setCellValue('C'.$counter, date('d-m-Y',strtotime($job['created_on'])));          
                $sheet->setCellValue('D'.$counter, $job['survey_Name']);      
                $sheet->setCellValue('E'.$counter, $job['sector_Name']);               
                $sheet->setCellValue('F'.$counter, count($job['cityNameArray']));      
                $sheet->setCellValue('G'.$counter, implode(", ",$job['cityNameArray']));
                $sheet->setCellValue('H'.$counter, $job['total_QuestionCount']);   
                $sheet->setCellValue('I'.$counter, $job['V1_name'] );
                $sheet->setCellValue('J'.$counter,$job['total_v1_attempt']);
                $sheet->setCellValue('K'.$counter,$job['V2_name'] );
                $sheet->setCellValue('L'.$counter, $job['total_v2_attempt']);
                $counter++;
                $i++;
            }
        }
        $spreadsheet->getActiveSheet()->getStyle("A1:L".$counter)->applyFromArray($styleArray);
        $fileName = "JobsData.xlsx";
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        exit();
    }

    public function download_ConsolodatedData_excel(){
        $response=['status'=>0, 'msg'=>'', 'html'=>''];
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City_ID'];
        $uri=service('uri');
        $geturi=$uri->getSegments();
        
        $survey_id=$geturi[2];
        $sector_id=$geturi[3];
        $city_id=$geturi[4];

        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();

        $jobDatasurvey_Name = getSurveyName($survey_id);

        if($survey_id > 0 && $survey_id!=''){
            $ValidatorJobCity->select('DISTINCT ON("city_id") city_id,job_id,created_on,sector_id,survey_id,updated_on,validator_1_user_id,validator_2_user_id,sand_to_v2,v2_status')->where('survey_id',$survey_id);

            if($sector_id !='' && $sector_id > 0){
                $ValidatorJobCity->where('sector_id',$sector_id);
            }
            if($city_id !='' && $city_id > 0){
                $ValidatorJobCity->where('city_id',$city_id);
            }
            
            $jobData = $ValidatorJobCity->orderBy('city_id,updated_on','DESC')->findAll();

            if(!empty($jobData)){
                foreach($jobData as $key=>$job){
                    $jobData[$key]['created_on'] = date('d-m-Y',strtotime($job['created_on']));
                    $jobData[$key]['sector_Name'] = getSectorName($job['sector_id']);
                    $jobData[$key]['survey_Name'] = getSurveyName($job['survey_id']);
                    $jobData[$key]['cityName'] = getCityNameByCity_id($job['city_id']);

                    $totalQuestionCount = $SurveyResultModel->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('City_ID',$job['city_id'])->where('parent_qb_id',0)->countAllResults();
                    $jobData[$key]['totalQuestion'] = $totalQuestionCount;

                    $totalRejectedQuestionCount = $SurveyResultModel->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('City_ID',$job['city_id'])->where('parent_qb_id',0)->where('validator_2_status',2)->countAllResults();
                    $jobData[$key]['totalRejectedQuestionCount'] = $totalRejectedQuestionCount;

                    $totalApprovedQuestionCount = $SurveyResultModel->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('City_ID',$job['city_id'])->where('parent_qb_id',0)->where('validator_2_status',1)->countAllResults();
                    $jobData[$key]['totalApprovedQuestionCount'] = $totalApprovedQuestionCount;

                    $totalRevertedQuestionCount = $SurveyResultModel->where('Survey_ID',$job['survey_id'])->where('sector_id',$job['sector_id'])->where('City_ID',$job['city_id'])->where('parent_qb_id',0)->where('validator_2_status',3)->countAllResults();
                    $jobData[$key]['totalRevertedQuestionCount'] = $totalRevertedQuestionCount;
                }
            }
        }

        // print_data($jobData);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A3:A4');
        $sheet->getCell('A3')->setValue( 'S. No.');
        $sheet->mergeCells('B3:B4');
        $sheet->getCell('B3')->setValue('Job ID');
        $sheet->mergeCells('C3:C4');
        $sheet->getCell('C3')->setValue('Creation Date');
        $sheet->mergeCells('D3:D4');
        $sheet->getCell('D3')->setValue('Survey Name');
        $sheet->mergeCells('E3:E4');
        $sheet->getCell('E3')->setValue('Sector Name');
        $sheet->mergeCells('F3:F4');
        $sheet->getCell('F3')->setValue('City Name');
        $sheet->mergeCells('G3:G4');
        $sheet->getCell('G3')->setValue('Total Questions');
        $sheet->mergeCells('H3:H4');
        $sheet->getCell('H3')->setValue('Approved');
        $sheet->getCell('I3')->setValue('Rejected');
        $sheet->getCell('J3')->setValue('Reverted to city');
        $sheet->getCell('K3')->setValue('Pending at V1');
        $sheet->getCell('L3')->setValue('Pending at V2');
        $sheet->mergeCells('F3:F4');
        $sheet->mergeCells('G3:G4');
        $sheet->mergeCells('H3:H4');
        $sheet->mergeCells('I3:I4');
        $sheet->mergeCells('J3:J4');
        $sheet->mergeCells('K3:K4');
        $sheet->mergeCells('L3:L4');
        $sheet->getCell('A1')->setValue('');
        
        $sheet->getCell('A2')->setValue('Consolidated Data Sheet');
        $sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle("A2:L2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle("A3:L4")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle('A2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
        $sheet->getStyle('A3:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
        $sheet->getStyle('A1:L4')->getAlignment()->setHorizontal('center');
        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
        
        $counter=5;
        $i=1;
        if(!empty($jobData)){
            foreach($jobData as $key=>$job){
                $sheet->setCellValue('A'.$counter, $i);
                $sheet->setCellValue('B'.$counter, $job['job_id']);    
                $sheet->setCellValue('C'.$counter, date('d-m-Y',strtotime($job['created_on'])));          
                $sheet->setCellValue('D'.$counter, $job['survey_Name']);      
                $sheet->setCellValue('E'.$counter, $job['sector_Name']);               
                $sheet->setCellValue('F'.$counter, $job['cityName']);
                $sheet->setCellValue('G'.$counter, $job['totalQuestion']);
                $sheet->setCellValue('H'.$counter, $job['totalApprovedQuestionCount']);   
                $sheet->setCellValue('I'.$counter, $job['totalRejectedQuestionCount'] );
                $sheet->setCellValue('J'.$counter,$job['totalRevertedQuestionCount']);
                $pendingAtv1 = 'No';
                if($job['sand_to_v2']==0){
                    $pendingAtv1 = 'Yes';
                }
                $sheet->setCellValue('K'.$counter,$pendingAtv1 );

                $pendingAtv2 = 'No';
                if($job['v2_status']==0){
                    $pendingAtv2 = 'Yes';
                }

                $sheet->setCellValue('L'.$counter, $pendingAtv2);
                $counter++;
                $i++;
            }
        }
        $spreadsheet->getActiveSheet()->getStyle("A1:L".$counter)->applyFromArray($styleArray);
        $fileName = "ConsolidatedSheet.xlsx";
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        exit();
    }

    public function download_cityStatusData_excel(){
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $SurveyResultModel=new \App\Models\Survey_result();
        $citySubmission=new \App\Models\City_submission();
        $Users=new \App\Models\Users();

        $uri=service('uri');
        $geturi=$uri->getSegments();
        $survey_id=$geturi[2];
        
        $survey_Name = getSurveyName($survey_id);
        $cityList['cityList'] = $Users->where('role',4)->findAll();

        $surveyAllQuestions = $surveyquestionMasterModel->where("Survey_ID",$survey_id)->countAllResults();
        if(!empty($cityList['cityList'])){
            foreach($cityList['cityList'] as $ckey=>$city){
                $surveyAllAnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$city['City_ID'])->where("Value !=","")->countAllResults();
                $cityList['cityList'][$ckey]['surveyAnsweredQuest'] = $surveyAllAnsweredQuestions;
                $cityList['cityList'][$ckey]['surveyAllQuestions'] = $surveyAllQuestions;
            }
        }
        // print_data($cityList);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A3:A4');
        $sheet->getCell('A3')->setValue( 'S. No.');
        $sheet->mergeCells('B3:B4');
        $sheet->getCell('B3')->setValue('City ID');
        $sheet->mergeCells('C3:C4');
        $sheet->getCell('C3')->setValue('City Name');
        $sheet->mergeCells('D3:D4');
        $sheet->getCell('D3')->setValue('State');
        $sheet->mergeCells('E3:E4');
        $sheet->getCell('E3')->setValue('Status');
        $sheet->mergeCells('F3:F4');
        $sheet->getCell('F3')->setValue('Total Questions');
        $sheet->mergeCells('G3:G4');
        $sheet->getCell('G3')->setValue('Attempted');
        $sheet->mergeCells('H3:H4');
        $sheet->mergeCells('F3:F4');
        $sheet->mergeCells('G3:G4');
        $sheet->mergeCells('H3:H4');
        $sheet->mergeCells('I3:I4');
        $sheet->mergeCells('J3:J4');
        $sheet->mergeCells('K3:K4');
        $sheet->mergeCells('L3:L4');
        $sheet->getCell('A1')->setValue('');
        // $sheet->getCell('A2')->setValue($getDetail['Survey_Name'].' Details');
        $sheet->getCell('A2')->setValue($survey_Name);
        $sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle("A2:L2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle("A3:L4")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle('A2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
        $sheet->getStyle('A3:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
        $sheet->getStyle('A1:L4')->getAlignment()->setHorizontal('center');
        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
        $counter=5;
        $i=1;
        if(!empty($cityList['cityList'])){
            foreach($cityList['cityList'] as $key=>$city){
                $sheet->setCellValue('A'.$counter, $i);
                $sheet->setCellValue('B'.$counter, $city['City_ID']);    
                $sheet->setCellValue('C'.$counter, $city['City']);          
                $sheet->setCellValue('D'.$counter, $city['State']);
                $status ="Not Started";
                if($city['surveyAnsweredQuest'] == $city['surveyAllQuestions']){
                    $status ="Completed";
                }else if($city['surveyAnsweredQuest'] > 0 && $city['surveyAnsweredQuest'] < $city['surveyAllQuestions']){
                    $status ="Inprogress";
                }      
                $sheet->setCellValue('E'.$counter, $status);               
                $sheet->setCellValue('F'.$counter, $city['surveyAllQuestions']);      
                $sheet->setCellValue('G'.$counter, $city['surveyAnsweredQuest']);   
                $counter++;
                $i++;
            }
        }
        $spreadsheet->getActiveSheet()->getStyle("A1:L".$counter)->applyFromArray($styleArray);
        $fileName = str_replace(" ","-",$survey_Name).".xlsx";
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        exit();
    }

    public function downLoadSurveyResultDataExcel(){
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
            $Uom = new \App\Models\Uom();
            $Users=new \App\Models\Users();
            $uri = service('uri');
            $geturi = $uri->getSegments();
            $getsurvey = $geturi[2];
            $cityiesArray=array();
            $surveyResutData = array();
            $chkSurvey=$SurveyModel->where('Survey_ID',$getsurvey)->where('publish_status',2)->first();
            $survey_Name = getSurveyName($getsurvey);
            $getAllCityOfficialsWhoSubmitted=$City_submissionModel->where('Survey_ID',$getsurvey)->where('submission_status',1)->findAll();
            if(!empty($chkSurvey)){
                $getSurveyAllSectors=$surveyquestionMasterModel->select('DISTINCT("Sector_ID"),Survey_ID')->where('Survey_ID',$getsurvey)->findAll();
                
                foreach($getAllCityOfficialsWhoSubmitted as $cKey=>$city){
                    $jobCreatedAndStatus = $ValidatorJobCity->where('survey_id',$getsurvey)->where('city_id',$city['City_ID'])->where('v2_status',1)->findAll();
                   if(count($getSurveyAllSectors) == count($jobCreatedAndStatus)){
                        array_push($cityiesArray,$city['City_ID']);
                   }
                }
            }

            if(!empty($cityiesArray)){
                $surveyResutData = $SurveyResultModel->where('Survey_ID',$getsurvey)->whereIn('City_ID',$cityiesArray)->findAll();
            }else{
                echo 'No data Found';
                exit;
            }
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $sheet->mergeCells('A3:A4');
                    $sheet->getCell('A3')->setValue( 'S. No.');
                    $sheet->mergeCells('B3:B4');
                     $sheet->getCell('B3')->setValue('City ID');
                    $sheet->getCell('C3')->setValue('City Name');
                    $sheet->getCell('D3')->setValue('State');
                    $sheet->getCell('E3')->setValue('Framework Name');
                    $sheet->getCell('F3')->setValue('Sector Name');
                    $sheet->getCell('G3')->setValue('Data Point');
                    $sheet->getCell('H3')->setValue('Result');
                    $sheet->getCell('I3')->setValue('UOM');
                    $sheet->getCell('J3')->setValue('V1 Status');
                    $sheet->getCell('K3')->setValue('V2 Status');
                    
                    $sheet->getCell('L3')->setValue('Rejected for');
                    $sheet->getCell('M3')->setValue('Is Child Question');
                    $sheet->getCell('N3')->setValue('Parent QB ID');
                    $sheet->getCell('O3')->setValue('Parent Option (If Any)');
                    $sheet->getCell('P3')->setValue('QB ID');
                    $sheet->getCell('Q3')->setValue('Sector ID');
                    $sheet->getCell('R3')->setValue('Framework ID');
                    
                    $sheet->mergeCells('C3:C4');
                    $sheet->mergeCells('D3:D4');
                    $sheet->mergeCells('E3:E4');
                    $sheet->mergeCells('F3:F4');
                    $sheet->mergeCells('G3:G4');
                    $sheet->mergeCells('H3:H4');
                    $sheet->mergeCells('I3:I4');
                    $sheet->mergeCells('J3:J4');
                    $sheet->mergeCells('K3:K4');
                    $sheet->mergeCells('L3:L4');
                    $sheet->mergeCells('M3:M4');
                    $sheet->mergeCells('N3:N4');
                    $sheet->mergeCells('O3:O4');
                    $sheet->mergeCells('P3:P4');
                    $sheet->mergeCells('Q3:Q4');
                    $sheet->mergeCells('R3:R4');
                    $sheet->getCell('A1')->setValue('');
                    // $sheet->getCell('A2')->setValue($getDetail['Survey_Name'].' Details');
                    $sheet->getCell('A2')->setValue($survey_Name);
                    $sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
                    $sheet->mergeCells('A2:R2');
                    $sheet->getStyle("A2:R2")->getFont()->setBold(true)->getColor()->setRGB('000000');
                    $sheet->getStyle("A3:R4")->getFont()->setBold(true)->getColor()->setRGB('000000');
                    $sheet->getStyle('A2:R2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
                    $sheet->getStyle('A3:R4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
                    $sheet->getStyle('A1:R4')->getAlignment()->setHorizontal('center');
                    $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
                    
                    
                    $counter=5;
                    $i=1;
                    if(!empty($surveyResutData)){
                        foreach($surveyResutData as $key=>$city){

                            $sheet->setCellValue('A'.$counter, $i);
                            $sheet->setCellValue('B'.$counter, $city['City_ID']);
                            $getcityDetails = $Users->where('City_ID',$city['City_ID'])->first();  
                            $sheet->setCellValue('C'.$counter,(!empty($getcityDetails) && $getcityDetails['City']!='')?$getcityDetails['City']:'' ); 
                            $sheet->setCellValue('D'.$counter, (!empty($getcityDetails) && $getcityDetails['State']!='')?$getcityDetails['State']:''); 
                            $frameworkName ='';
                            if($city['Framework_ID'] > 0){
                                $frameworkName =getFrameworkName($city['Framework_ID']);
                            }
                            $sheet->setCellValue('E'.$counter, $frameworkName); 
                            $sheet->setCellValue('F'.$counter, getSectorName($city['sector_id']));
                            $questionDetail =   $questionModel->where('QB_ID',$city['QB_ID'])->first(); 
                            $sheet->setCellValue('G'.$counter, (!empty($questionDetail) && $questionDetail['Description']!='')?$questionDetail['Description']:'');
                            $sheet->setCellValue('H'.$counter, $city['Value']); 
                            $getUOMDetails =  $Uom->where('UOM_ID',$questionDetail['UOM_ID'])->first();   
                            $sheet->setCellValue('I'.$counter, (!empty($getUOMDetails) && $getUOMDetails['UOM']!='')?$getUOMDetails['UOM']:'' ); 
                            $v1status ='';
                            if($city['validator_1_status']==1){
                                $v1status ='Approved';
                            }else if($city['validator_1_status']==2){
                                $v1status ='Rejected';
                            }else if($city['validator_1_status']==3){
                                $v1status ='Reverted to city';
                            }
                            $sheet->setCellValue('J'.$counter, $v1status);

                            $v2status ='';
                            if($city['validator_2_status']==1){
                                $v2status ='Approved';
                            }else if($city['validator_2_status']==2){
                                $v2status ='Rejected';
                            }else if($city['validator_2_status']==3){
                                $v2status ='Reverted to city';
                            }
                            $sheet->setCellValue('K'.$counter, $v2status); 
                            $sheet->setCellValue('L'.$counter, ($city['validator_2_status']==2)?$city['rejectedByv2_reason']:''); 
                            $sheet->setCellValue('M'.$counter, ($city['parent_qb_id'] > 0)?'Yes':'No'); 
                            
                            $sheet->setCellValue('N'.$counter, ($city['parent_qb_id'] > 0)?$city['parent_qb_id']:''); 
                            $sheet->setCellValue('O'.$counter, $city['parent_option']);
                            $sheet->setCellValue('P'.$counter, $city['QB_ID']); 
                            $sheet->setCellValue('Q'.$counter, $city['sector_id']);      
                            $sheet->setCellValue('R'.$counter, $city['Framework_ID']); 
                            $counter++;
                            $i++;
                        }
                    }
                    $spreadsheet->getActiveSheet()->getStyle("A1:R".$counter)->applyFromArray($styleArray);

                    $fileName = str_replace(" ","-",$survey_Name).".xlsx";
                    $writer = new Xlsx($spreadsheet);
                    ob_end_clean();
                    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
                    $writer->save('php://output');
                    exit();
    }

public function showSelectedQuestionOrder(){
    $questionModel=new \App\Models\QuestionModel();
    $selectedChildQuestionOrder = '';
    $selectedCalculatedQuestions =$this->request->getPost('selectedCalculatedQuestions');
    if(!empty($selectedCalculatedQuestions)){
        foreach($selectedCalculatedQuestions as $key=>$question){
            $questionDetail = $questionModel->where('QB_ID',$question)->first();
            $selectedChildQuestionOrder = $selectedChildQuestionOrder." ".($key + 1).". ".$questionDetail['Description']."<br>";

        }
    }
    echo json_encode(array('qData'=>$selectedChildQuestionOrder));
    exit;
}



public function downLoadSurveyResultDataAPI(){
        $allData=[];
        $today=date("Y-m-d");
        //$logedInUserDetail=session('admin_detail');
        //$loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();
        $Uom = new \App\Models\Uom();
        $Users=new \App\Models\Users();
        $uri = service('uri');
        $geturi = $uri->getSegments();
        $getsurvey = $geturi[2];
        $getApiKey = $geturi[3];
        $getEnvApiKey=getenv('data_api_key');
        
        //die("SurveyID :: ".trim($getsurvey)." & Received Key :: ".$getApiKey." & Valid Key :: ".$getEnvApiKey);
        if($getApiKey=="" || $getApiKey!=$getEnvApiKey){
            echo json_encode(array("status" => "error", "msg" => "Invalid request!")); 
           die();
        }
        $chkSurveyExist=$SurveyModel->where('Survey_ID',$getsurvey)->where('publish_status',2)->first();
        if(empty($chkSurveyExist)){
           echo json_encode(array("status" => "error", "msg" => "Survey not found!")); 
           die();
        }
        /*############### Check Condition ################# */               
                $getAllCityOfficialsWhoSubmitted=$City_submissionModel->where('Survey_ID',$getsurvey)->where('submission_status',1)->findAll();
                $surveyEndDate=$chkSurveyExist["To_Date"];
                if(strtotime($today)>strtotime($surveyEndDate)){ //Condition1
                        $getSurveyAllSectors=$surveyquestionMasterModel->select('DISTINCT("Sector_ID"),Survey_ID')->where('Survey_ID',$getsurvey)->findAll();
                        $getSurveyAllJobs=$ValidatorJobCity->where('survey_id',$getsurvey)->findAll();
                        $getSurveyAllJobsSubmittedByV2=$ValidatorJobCity->where('survey_id',$getsurvey)->where('v2_status',1)->findAll();
                        $requiredJobs=count($getSurveyAllSectors)*count($getAllCityOfficialsWhoSubmitted);
                        if($getSurveyAllJobs=$requiredJobs){ //Condition2
                            if($getSurveyAllJobs=$getSurveyAllJobsSubmittedByV2){ //Condition3
                                
                                //All condition match

                            }else{
                              echo json_encode(array("status" => "error", "msg" => "Survey all the jobs still not validated!")); 
                             die(); 
                        }
                        }else{
                           echo json_encode(array("status" => "error", "msg" => "Survey all the jobs not created!")); 
                          die(); 
                        }
                        }else{
                           echo json_encode(array("status" => "error", "msg" => "Survey not ended now!")); 
                          die(); 
                }                
        /*############### End Check Condition ########################## */
        $cityiesArray=array();
        $surveyResutData = array();
        $chkSurvey=$SurveyModel->where('Survey_ID',$getsurvey)->where('publish_status',2)->first();
        $survey_Name = getSurveyName($getsurvey);
        $getAllCityOfficialsWhoSubmitted=$City_submissionModel->where('Survey_ID',$getsurvey)->where('submission_status',1)->findAll();
        if(!empty($chkSurvey)){
        $getSurveyAllSectors=$surveyquestionMasterModel->select('DISTINCT("Sector_ID"),Survey_ID')->where('Survey_ID',$getsurvey)->findAll();

        foreach($getAllCityOfficialsWhoSubmitted as $cKey=>$city){
            $jobCreatedAndStatus = $ValidatorJobCity->where('survey_id',$getsurvey)->where('city_id',$city['City_ID'])->where('v2_status',1)->findAll();
           if(count($getSurveyAllSectors) == count($jobCreatedAndStatus)){
                array_push($cityiesArray,$city['City_ID']);
           }
        }
        }

        if(!empty($cityiesArray)){
           $surveyResutData=$SurveyResultModel->where('Survey_ID',$getsurvey)->whereIn('City_ID',$cityiesArray)->findAll();
        }else{
           echo json_encode(array("status" => "error", "msg" => "No data found!")); 
           die();
        }

        if(!empty($surveyResutData)){
        $i=1;
        foreach($surveyResutData as $key=>$city){
        $frameworkName='';
        if($city['Framework_ID'] > 0){
          $frameworkName=getFrameworkName($city['Framework_ID']);
        }

        $v1status ='';
        if($city['validator_1_status']==1){
          $v1status ='Approved';
        }else if($city['validator_1_status']==2){
          $v1status ='Rejected';
        }else if($city['validator_1_status']==3){
          $v1status ='Reverted to city';
        }


        $v2status ='';
        if($city['validator_2_status']==1){
          $v2status ='Approved';
        }else if($city['validator_2_status']==2){
          $v2status ='Rejected';
        }else if($city['validator_2_status']==3){
          $v2status ='Reverted to city';
        }

        $getcityDetails=$Users->where('City_ID',$city['City_ID'])->first();
        $questionDetail=$questionModel->where('QB_ID',$city['QB_ID'])->first();
        $getUOMDetails=$Uom->where('UOM_ID',$questionDetail['UOM_ID'])->first();
        $getUOMDetails=$Uom->where('UOM_ID',$questionDetail['UOM_ID'])->first();

        $apiData=array(
          'S_NO'=>$i,
          'City ID'=>trim($city['City_ID']),
          'City Name'=>(!empty($getcityDetails) && $getcityDetails['City']!='')?$getcityDetails['City']:'',
          'State'=>(!empty($getcityDetails) && $getcityDetails['State']!='')?$getcityDetails['State']:'',
          'Framework Name'=>$frameworkName,
          'Sector Name'=>getSectorName($city['sector_id']),
          'Data Point'=>(!empty($questionDetail) && $questionDetail['Description']!='')?$questionDetail['Description']:'',
          'Result'=>trim($city['Value']),
          'UOM'=>(!empty($getUOMDetails) && $getUOMDetails['UOM']!='')?$getUOMDetails['UOM']:'',
          'V1 Status'=>$v1status,
          'V2 Status'=>$v2status,
          'Rejected for'=>($city['validator_2_status']==2)?$city['rejectedByv2_reason']:'',
          'Is Child Question'=>($city['parent_qb_id'] > 0)?'Yes':'No',
          'Parent QB ID'=>($city['parent_qb_id'] > 0)?$city['parent_qb_id']:'',
          'Parent Option (If Any)'=>$city['parent_option'],
          'QB ID'=>trim($city['QB_ID']),
          'Sector ID'=>trim($city['sector_id']),
          'Framework ID'=>trim($city['Framework_ID'])
        );
        array_push($allData,$apiData);

        // echo json_encode(array("status" => "success", "data" => $allData)); 
        // die(); 


        $i++;}}

        echo json_encode(array("status" => "success", "data" => $allData)); 
        die();

    } // End of the function
        
    
}
?>