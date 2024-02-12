<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends BaseController{


    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        // $session=session();
        // $session= session_start();  
        // $session = \Config\Services::session();
        $this->db=db_connect();
    }

    public function login(){
        $logedInUserEmail=session()->get('logedInUser');
        if($logedInUserEmail){
            return redirect()->to(base_url('admin/dashboard'));
        }
        return view('backend/login');
        // die("Fine here...");
        // $UsersModel=new \App\Models\Users();        
        // $d=$UsersModel->findall();
        // foreach($d as $userDetail){
        //     $uid=$userDetail["user_id"];
        //         $updateData=[
        //             'user_password'=>md5('NIUA@'.$userDetail["City_ID"].'!#'),
        //         ];
        //     $UsersModel->update($uid, $updateData);
        // }
    } // End of the function.

    
    public function validatelogin(){
        $response=['status' => 0, 'msg' => ''];
        $db= \Config\Database::connect(); 
        $UsersModel=new \App\Models\Users();        
        $username=trim($this->request->getPost('userName'));
        $password=trim($this->request->getPost('userPassword'));
        if($username!="" && $password!=""){
            $UsersModel->where('City_ID', $username);
            $UsersModel->orWhere('City', $username);

            $get_user=$UsersModel->where('status',1)->where('user_password', $password)->first();
            
            if(!empty($get_user)){
                $session=session();
                $sessiondata=['logedInUser'=> $username, 'admin_detail'=> $get_user];
                $session->set($sessiondata);
                $response['status']=1;
                $response['msg']="Login successfully!"; 
            }else{
                $response['status']=0;
                $response['msg']="Invalid login credentials!"; 
            }
        }else{
            $response['msg']="Please enter username and password!"; 
        }
        echo json_encode($response); exit;
    } // End of the function.

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

public function dashboard(){
    $session = session();
    $questionModel=new \App\Models\QuestionModel();
    $SectorModel=new \App\Models\SectorModel();
    $SurveyModel = new \App\Models\SurveyModel();
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $SurveyResultModel=new \App\Models\Survey_result();
    $City_submissionModel=new \App\Models\City_submission();               
    $logedInUserDetail=session('admin_detail');
    $loginUserCity=$logedInUserDetail['City'];
    $loginUserRole=$logedInUserDetail['role'];
    $loginUserCityId=$logedInUserDetail['City_ID'];
    $loginUserId=$logedInUserDetail['user_id'];
    if($loginUserRole==4){ //City Official
        $data["survey_start_date"]="";
        $data["survey_end_date"]="";
        $data["surveyAllAssignQuestions"]=array();
        $data["surveyAllAnsweredQuestions"]=array();
        $data['city_official_selected_Survey'] = (session('city_official_selected_Survey') && session('city_official_selected_Survey') > 0)?session('city_official_selected_Survey'):0;
        $SurveyModel->where('publish_status',2);
        if($data['city_official_selected_Survey'] > 0){
            $SurveyModel->where('Survey_ID',$data['city_official_selected_Survey']);
        }
        $surveyDetail=$SurveyModel->first();
        //print_data($surveyDetail);
        if(!empty($surveyDetail)){
            $data["survey_id"]=$surveyDetail["Survey_ID"];
            $data["survey_start_date"]=$surveyDetail["From_Date"]; 
            $data["survey_end_date"]=$surveyDetail["To_Date"];
            $surveyId=$surveyDetail["Survey_ID"];
            $data['chkSubmitStatus']=$City_submissionModel->where('Survey_ID',$surveyDetail["Survey_ID"])->where('City_ID',$loginUserCityId)->first();
            $data["surveyAllAssignQuestions"]=$surveyquestionMasterModel->where("Survey_ID",$surveyId)->findAll();
            $data["surveyAllAnsweredQuestions"]=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$surveyId)->where("City_ID",$loginUserCityId)->where("Value !=","")->findAll();
        }
        $data['allSurveyList']=$SurveyModel->where('publish_status',2)->orderBy('published_on','DESC')->findAll();
        // print_data($data['allSurveyList']);      
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $getDetail=$SurveyModel->where('publish_status', 0)->first();
        // if(!empty($getDetail)){    
        //     foreach($data['allsector'] as $key=>$sector){
        //         if($getDetail["publish_status"]==2){
        //             $totalQuestions = $surveyquestionMasterModel->where('Survey_ID',13)->where('Sector_ID',$sector['Sector_ID'])->findAll();
        //             if(!empty($totalQuestions)){
        //                 $data['allsector'][$key]['QuestionsInSurvey'] = count($totalQuestions);
        //             }else{
        //                 $data['allsector'][$key]['QuestionsInSurvey'] = 0;
        //             }
        //         }else{
        //             $data['allsector'][$key]['QuestionsInSurvey'] = 0;
        //         }
        //     }
        // }
        // $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('UOM_ID >0')->findall();
        //$data['questionList'] = $surveyquestionMasterModel->where('Survey_ID',13)->findall();           
        return view('backend/city_official/dashboard',$data);

    }else if($loginUserRole==1){

        $data['SurveySelectedByAdmins'] = (session('SurveySelectedByAdmins') && session('SurveySelectedByAdmins') > 0)?session('SurveySelectedByAdmins'):0;
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,question_placeholder')->where('Parent_QB_ID',NULL)->orWhere('Parent_QB_ID',0)->where('is_child_question','no')->where('UOM_ID >0')->findall();
        // $data['questionList'] = $surveyquestionMasterModel->where('Survey_ID',3)->findall();
        $data['questionList'] = [];
        // $data['surveyList']=$SurveyModel->where('Survey_ID',3)->findall();
        $data['surveyList'] =[];
        $data['surveyListCheck']=$SurveyModel->orderBy('Survey_ID','DESC')->findall();        
        return view('backend/admin/dashboard',$data);

    }else if($loginUserRole==5){

        $data['SurveySelectedByAdmins'] = (session('SurveySelectedByAdmins') && session('SurveySelectedByAdmins') > 0)?session('SurveySelectedByAdmins'):0;
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,question_placeholder')->where('Parent_QB_ID',NULL)->orWhere('Parent_QB_ID',0)->where('is_child_question','no')->where('UOM_ID >0')->findall();
        // $data['questionList'] = $surveyquestionMasterModel->where('Survey_ID',3)->findall();
        $data['questionList'] =[];
        // $data['surveyList']=$SurveyModel->where('Survey_ID',3)->findall();
        $data['surveyList'] =[];
        $data['surveyListCheck']=$SurveyModel->where('admin_status >=',1)->orderBy('Survey_ID','DESC')->findall();
        return view('backend/admin/dashboard',$data);

    }else if($loginUserRole==2){ //Validator1 User
        //die("User Id :: ".$loginUserId);  
        $validatorSectorModel=new \App\Models\Validator_sector();
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        //$data["validator_sector"]=$validatorSectorModel->where('user_id',$loginUserId)->findAll();
        //print_data($data["validator_sector"]);
        $data['assigned_survey']=$validatorJobCity->select('DISTINCT("survey_id")')->where('validator_1_user_id',$loginUserId)->findAll();
        //print_data($data['assigned_survey']);
        return view('backend/validator1/dashboard',$data);
    }else if($loginUserRole==3){ //Validator2 User
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        // print_data($loginUserId);

        $data['assigned_survey']=$validatorJobCity->select('DISTINCT("survey_id")')->where('validator_2_user_id',$loginUserId)->where('sand_to_v2',1)->findAll();
        
        return view('backend/validator2/dashboard',$data);
    }
} // End of the function.


public function getSectorQuestion(){
    $questionModel=new \App\Models\QuestionModel();
    $SectorModel=new \App\Models\SectorModel();
    $selectedSector=trim($this->request->getPost('sector'));
    $searchValue=trim($this->request->getPost('search'));
    $data['Survey_ID'] = $this->request->getPost('Survey_ID');

    if(!empty($selectedSector) && !empty($searchValue)){
       $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('is_child_question','no')->where('UOM_ID >0')->where('Sector_ID',$selectedSector)->like('LOWER("Description")',strtolower($searchValue))->findall();
    }else if(!empty($selectedSector) && empty($searchValue)){

       $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('is_child_question','no')->where('UOM_ID >0')->where('Sector_ID',$selectedSector)->findall();
    }else if(empty($selectedSector) && !empty($searchValue)){
       $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('is_child_question','no')->where('UOM_ID >0')->like('LOWER("Description")',strtolower($searchValue))->findall();
    }else{
       $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('Parent_QB_ID',NULL)->orWhere('Parent_QB_ID',0)->where('is_child_question','no')->where('UOM_ID >0')->findall();
    }

    if(empty($selectedSector)){
        $data['Sector_ID']=0;
    }else{
        $data['Sector_ID']=$selectedSector;
    }
    
    $data['totalQuestion']=count($data['allquestion']);
    $html=view('backend/ajax/sectorQuestionView',$data);
    echo json_encode(['html'=>$html,'csrf_token'=>'']);    
} // End of the function

public function searchSectorQuestion(){
    $questionModel=new \App\Models\QuestionModel();
    $SectorModel=new \App\Models\SectorModel();
    $selectedSector=trim($this->request->getPost('Sector_ID'));
    $skey=trim($this->request->getPost('searchKey'));
    $Survey_ID=trim($this->request->getPost('Survey_ID'));
    //die($selectedSector."    ::: ".$skey);
    if(!empty($selectedSector)){       
       $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('is_child_question','no')->where('UOM_ID >0')->where('Sector_ID',$selectedSector)->like('LOWER("Description")',strtolower($skey))->findall();
    }else if(empty($skey) && !empty($selectedSector)){
          $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('is_child_question','no')->where('UOM_ID >0')->where('Sector_ID',$selectedSector)->findall();
    }else{
       $data['allquestion']=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID')->where('Parent_QB_ID',NULL)->orWhere('Parent_QB_ID',0)->where('is_child_question','no')->where('UOM_ID >0')->like('LOWER("Description")',strtolower($skey))->findall();
    }

    if(empty($selectedSector)){
        $data['Sector_ID']=0;
    }else{
        $data['Sector_ID']=$selectedSector;
    }
   
    $data['totalQuestion']=count($data['allquestion']);
    $data['Survey_ID']=$Survey_ID;
    $html=view('backend/ajax/sectorQuestionView',$data);
    echo json_encode(['html'=>$html,'csrf_token'=>'']);   
    exit; 
} // End of the function



 // code for avlok starts here
public function addQuestionToSurvey(){
    $questionModel=new \App\Models\QuestionModel();
    $SurveyModel=new \App\Models\SurveyModel();    
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $SectorModel=new \App\Models\SectorModel();

    $logedInUserDetail=session('admin_detail');
    $loginUserCity=$logedInUserDetail['City'];
    $loginUserRole=$logedInUserDetail['role'];


    $qid = $this->request->getPost('qid');
    $Survey_ID = $this->request->getPost('Survey_ID');
    $Sector_ID = 0;
    /*Check Survey Publish Status*/
    $getDetail=$SurveyModel->where('Survey_ID',$Survey_ID)->first();
    
    if(!empty($getDetail)){
        if($getDetail["publish_status"]==2){
            $data['msg']="Survey already published, question can not add now";
            echo json_encode($data);
            exit; 
        }
    }
    $existanceData = $surveyquestionMasterModel->where('QB_ID',$qid)->where('Survey_ID',$Survey_ID)->findall();
    if(!empty($existanceData)){
        $data['questionHtml'] ='';
        $data['status'] =0;
        $data['msg'] ='Question already added';
    }else{
        $questionDetail = $questionModel->where('QB_ID',$qid)->findall();

        // need to add all details in database here
        if(!empty($questionDetail)){
            $Sector_ID = $questionDetail[0]['Sector_ID'];

            $getSortOrder = $surveyquestionMasterModel->select('Max("sort_order") as max_sort_order')->where('Sector_ID',$Sector_ID)->where('Survey_ID',$Survey_ID)->first();
            if(!empty($getSortOrder)){
                $sort_order = $getSortOrder['max_sort_order'] + 1;
            }else{
                $sort_order = 1;
            }


            $surveyDataToInsert = array(
                'Survey_ID'=>$Survey_ID,
                'Sector_ID'=>$questionDetail[0]['Sector_ID'],
                'QB_ID'=>$questionDetail[0]['QB_ID'],
                'UOM_ID'=>$questionDetail[0]['UOM_ID'],
                'Description'=>$questionDetail[0]['Description'],
                'created_on'=>date('Y-m-d h:i:s'),
                'sort_order'=>$sort_order
            );
            $surveyquestionMasterModel->insert($surveyDataToInsert);
            if($loginUserRole==5){
                $updateSurveyStatus = array(
                    'publish_status'=>0,
                    'admin_status'=>1
                );
                $SurveyModel->update($Survey_ID,$updateSurveyStatus);
            }else if($loginUserRole==1){
                $updateSurveyStatus = array(
                    'publish_status'=>0,
                    'admin_status'=>0
                );
                $SurveyModel->update($Survey_ID,$updateSurveyStatus);
            }           
        }
        // need to add all details in database here    
        $questiondata['questionDetail'] = $questionDetail[0];

        if(!empty($questiondata['questionDetail'])){
            $sectorData = $SectorModel->where('Sector_ID',$questiondata['questionDetail']['Sector_ID'])->first();
            $questionHtml = view('backend/admin/ajax/QuestionDataAjax',$questiondata);
            $data['questionHtml'] =$questionHtml;
            $data['Sector_ID'] = $Sector_ID;
            $data['status'] =1;
            $data['msg'] ='Question added successfully in '.$sectorData['Sector'];
        }else{
            $data['questionHtml'] ='';
            $data['Sector_ID'] = $Sector_ID;
            $data['status'] =0;
            $data['msg'] ='Something went wrong..';
        }
    }
    echo json_encode($data);
    exit;    
}

public function removeSigleQuestion(){
    $SurveyModel=new \App\Models\SurveyModel();
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $qid = $this->request->getPost('qid');
    $Survey_ID = $this->request->getPost('Survey_ID');
    /*Check Survey Publish Status*/
    $getDetail=$SurveyModel->where('Survey_ID',$Survey_ID)->first();
    if(!empty($getDetail)){
        if($getDetail["publish_status"]==2){
            $data['msg']="Survey already published, question can not remove now";
            echo json_encode($data);
            exit; 
        }
    }
    $res = $surveyquestionMasterModel->where('Survey_ID', $Survey_ID)->where('QB_ID',$qid)->delete();
    if($res){
        $updateSurveyStatus = array(
            'publish_status'=>0
        );
        $SurveyModel->update($Survey_ID,$updateSurveyStatus);
        $data['status']=1;
        $data['msg']='Question removed successfully';
    }else{
        $data['status']=0;
        $data['msg']='Something went wrong...';
    }
    echo json_encode($data);
    exit;
}

public function removeMultipleQuestion(){
    $SurveyModel=new \App\Models\SurveyModel();
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $questionList = $this->request->getPost('questionList');
    $Survey_ID = $this->request->getPost('Survey_ID');
    /*Check Survey Publish Status*/
    $getDetail=$SurveyModel->where('Survey_ID',$Survey_ID)->first();
    if(!empty($getDetail)){
        if($getDetail["publish_status"]==2){
            $data['status']=0;
            $data['msg']="Survey already published, question can not remove now";
            echo json_encode($data);
            exit; 
        }
    }
  
    if(!empty($questionList)){
        foreach($questionList as $key=>$qid){
            $res = $surveyquestionMasterModel->where('Survey_ID', $Survey_ID)->where('QB_ID',$qid)->delete();
            if($res){
                $updateSurveyStatus = array(
                    'publish_status'=>0
                );
                $SurveyModel->update($Survey_ID,$updateSurveyStatus);
                $data['status']=1;
                $data['msg']='Question removed successfully';
            }else{
                $data['status']=0;
                $data['msg']='Something went wrong...';
            }
        }
    }else{
        $data['status']=0;
        $data['msg']='Select atleast one question...';
    }
    echo json_encode($data);
    exit;

}

public function save_survey(){
    $response=['status' => 0, 'msg' => ''];
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $SurveyModel=new \App\Models\SurveyModel();
    $survey_id=trim($this->request->getPost('Survey_ID'));
    //die("Survey Id :: ".$survey_id);
    $getDetail=$SurveyModel->where('Survey_ID',$survey_id)->first();
    $getTotalSurveyQuestion=$surveyquestionMasterModel->where('Survey_ID',$survey_id)->findAll();
    if(empty($getTotalSurveyQuestion)){
      $response['msg']="No question found in this survey";
      echo json_encode($response); exit;   
    }
    if(!empty($getDetail)){

        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        // print_data($loginUserRole);
            if($loginUserRole==5){
                if($getDetail["publish_status"]==0){
                    $updateData=[
                        'publish_status'=>1,
                        'admin_status'=>1,
                        'saved_on'=>date('Y-m-d h:i:s')
                    ];
                    $SurveyModel->update($survey_id, $updateData);
                    $response['status']=1;
                    $response['msg']="Survey save successfully!";
                }else if($getDetail["publish_status"]==1){
                    $response['msg']="Survey already saved";
                }if($getDetail["publish_status"]==2){
                    $response['msg']="Survey Published";
                }
            }else if($loginUserRole==1){
                if($getDetail["admin_status"]==0){
                    $updateData=[
                        'admin_status'=>1,
                        'saved_on'=>date('Y-m-d h:i:s')
                    ];
                    $SurveyModel->update($survey_id, $updateData);
                    $response['status']=1;
                    $response['msg']="Survey save successfully!";
                }else if($getDetail["admin_status"]==1){
                    $response['msg']="Survey already saved";
                }if($getDetail["admin_status"]==2){
                    $response['msg']="Survey Published";
                }
            }
    }else{
        $response['msg']="Survey not found!";
    }
    echo json_encode($response); exit;
} // End of the question


public function publish_survey(){
    $response=['status' => 0, 'msg' => ''];
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $SurveyModel=new \App\Models\SurveyModel();
    $survey_id=trim($this->request->getPost('Survey_ID'));
    //die("Survey Id :: ".$survey_id);
    $getDetail=$SurveyModel->where('Survey_ID',$survey_id)->first();
    
    $getTotalSurveyQuestion=$surveyquestionMasterModel->where('Survey_ID',$survey_id)->findAll();
    if(empty($getTotalSurveyQuestion)){
      $response['msg']="No question found in this survey";
      echo json_encode($response); exit;   
    }
    if(!empty($getDetail)){
        if($getDetail["publish_status"]==0){
            $response['msg']="Survey form not saved,Please save first";           
        }else if($getDetail["publish_status"]==1){
            $updateData=[
            'publish_status'=>2,
            'admin_status'=>2,
            'published_on'=>date('Y-m-d H:i:s')
            ];
            $SurveyModel->update($survey_id, $updateData);
            $response['status']=1;
            $response['msg']="Survey published successfully!";
        }if($getDetail["publish_status"]==2){
            $response['msg']="Survey already published";
        }
    }else{
        $response['msg']="Survey not found!";
    }
    echo json_encode($response); exit;
} // End of the question


public function addNewSurvey(){
    $SurveyModel=new \App\Models\SurveyModel();
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $QuestionForNewAddedSurvey = array();
    $is_uof=trim($this->request->getPost('is_uof'));
    $survey_year=trim($this->request->getPost('survey_year'));
    //die($is_uof);
    $Survey_Name = trim($this->request->getPost('Survey_Name'));
    $Description = trim($this->request->getPost('Description'));
    $From_Date = trim($this->request->getPost('From_Date'));
    $To_Date = trim($this->request->getPost('To_Date'));
    $Import_From_Survey_ID = trim($this->request->getPost('Import_From_Survey_ID'));
    if(strtotime($To_Date)<strtotime($From_Date)){
        $data['status']=0;
        $data['msg']='Please select another date, end date can not be less then start date!';
        $data['data']='';
        echo json_encode($data);
        exit();
    }

    $existData =$SurveyModel->like('LOWER("Survey_Name")',strtolower($Survey_Name))->first();
    if(!empty($existData)){
        $data['status']=0;
        $data['msg']='Survey name already exist';
        $data['data']='';
        echo json_encode($data);
        exit();
    }

    if($Survey_Name!='' && $Description!='' && $From_Date!='' && $To_Date!=''){
        $dataToSaveSurvey=array(
            'Survey_Name'=>$Survey_Name,
            'Description'=>$Description,
            'From_Date'=>date('Y-m-d',strtotime($From_Date)),
            'To_Date'=>date('Y-m-d',strtotime($To_Date)),
            'is_uof'=>$is_uof,
            'survey_year'=>$survey_year,
        );

        $logedInUserDetail=session('admin_detail');
        $loginUserRole=$logedInUserDetail['role'];
        if($loginUserRole==5){
            $dataToSaveSurvey['admin_status']=1;   
        }

        $SurveyID=$SurveyModel->insert($dataToSaveSurvey);
        if($Import_From_Survey_ID > 0 && $SurveyID > 0){
            $QuestionList_SelectedSurvey = $surveyquestionMasterModel->where('Survey_ID',$Import_From_Survey_ID)->findAll();
            if(!empty($QuestionList_SelectedSurvey)){
                foreach($QuestionList_SelectedSurvey as $key=>$Qlist){
                    $Qlist['Survey_ID'] = $SurveyID;
                    $Qlist['created_on'] = date('Y-m-d');
                    array_push($QuestionForNewAddedSurvey,$Qlist);
                }
            }
            if(!empty($QuestionForNewAddedSurvey)){
                $inserted_IDs = $surveyquestionMasterModel->insertBatch($QuestionForNewAddedSurvey);
            }
        }
        if($SurveyID){
            $data['status']=1;
            $data['msg']='Survey created successfully';
            $data['data']='<option class="surveyClassName" value="'.$SurveyID.'">'.$Survey_Name.'</option>';
        }else{
            $data['status']=0;
            $data['msg']='Something went wrong';
            $data['data']='';
        }
    }else{
        $data['status']=0;
        $data['msg']='Please fill all required fields';
        $data['data']='';
    }
    echo json_encode($data);
    exit;
}


public function surveyDetailsDataAjax(){
        $seesion = session();
        $Survey_ID = $this->request->getPost('Survey_ID');
        $data['Survey_ID']=$Survey_ID;
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $data['questionList']=[];
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];

        if($Survey_ID!='' && $Survey_ID > 0){
            $suveySession['SurveySelectedByAdmins'] = $Survey_ID;
            $seesion->set($suveySession);
        }

        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $getDetail=$SurveyModel->where('Survey_ID',$Survey_ID)->first();
        if(!empty($getDetail)){
            if($loginUserRole==5){
                if($getDetail['admin_status'] > 0){
                    $data['questionList'] = $surveyquestionMasterModel->where('Survey_ID',$Survey_ID)->orderBy('sort_order','ASC')->findall();
                }
            }elseif($loginUserRole==1){
                $data['questionList'] = $surveyquestionMasterModel->where('Survey_ID',$Survey_ID)->orderBy('sort_order','ASC')->findall();
            }
        }

        if(!empty($data['questionList'])){
            foreach($data['questionList'] as $key=>$quest){
                $Qdata = $questionModel->where('QB_ID',$quest['QB_ID'])->first();
                $data['questionList'][$key]['question_placeholder'] = $Qdata['question_placeholder'];
                $data['questionList'][$key]['child_questions'] = $Qdata['child_questions'];
                $data['questionList'][$key]['sub_question'] = $Qdata['sub_question'];
                $data['questionList'][$key]['question_matrix_barcode'] = $Qdata['question_matrix_barcode'];
                $data['questionList'][$key]['calculation_type'] = $Qdata['calculation_type'];
            }
        }
        $data['allquestion']=$questionModel->where('Parent_QB_ID',NULL)->orWhere('Parent_QB_ID',0)->where('is_child_question','no')->where('UOM_ID >0')->findall();
        //print_data($data['questionList']);
        $data['surveyListCheck']=$SurveyModel->orderBy('Survey_ID','DESC')->findall();
        $data['surveyList']=$SurveyModel->where('Survey_ID',$Survey_ID)->orderBy('Survey_ID','DESC')->findAll();
        if(!empty($data)){                
            $result['survey_html'] = view('backend/ajax/SurveyDetailsDataAjax',$data);
            $result['msg'] = 'Survey changed successfully';
            $result['status'] = 1;
        }else{
            $result['survey_html'] ='';
            $result['msg'] = 'Something went wrong';
            $result['status'] = 0;
        }
        echo json_encode($result);
        exit;
}

public function addNewSector(){

    $SectorModel=new \App\Models\SectorModel();

    $Sector = $this->request->getPost('Sector');
    $Description = $this->request->getPost('Description');

    $icon = $this->request->getFile('sectorIcon');
    $background = $this->request->getFile('sectorBackground');


    if($Sector!=''){
        $existData = $SectorModel->where('Sector',$Sector)->first();
        if(!empty($existData)){
            $data['status']=0;
            $data['msg']='Sector Name Already exist';
            $data['data']='';
            echo json_encode($data);
            exit;
        }
    }

    $sectorIcon = $icon->getRandomName();
    $icon->move('assets/niua/img/', $sectorIcon);

    $sectorBackground = $background->getRandomName();
    $background->move('assets/niua/img/', $sectorBackground);

    $saveData = [
        'Sector' => $Sector,
        'Description' => $Description,
        'sectorIcon' => $sectorIcon,
        'sectorBackground'=>$sectorBackground,
        'created_on'=>date('Y-m-d h:i:s'),
        'active_status'=>1
    ];
    $sector_id = $SectorModel->insert($saveData);
    if($sector_id){
        $data['status']=1;
        $data['msg']='Sector added successfully';
        $data['data']='';
    }else{
        $data['status']=0;
        $data['msg']='Something went wrong';
        $data['data']='';
    }
    echo json_encode($data);
    exit;
}

public function editSector(){
    $uri=service('uri');
    $geturi=$uri->getSegments();
    $sectorId=$geturi[2];
    //echo "Sector Id : ".$sectorId; die;
    $SectorModel=new \App\Models\SectorModel();
    $chkSector=$SectorModel->where("Sector_ID",$sectorId)->first();
    if($sectorId=="" || empty($chkSector)){
            $url=base_url()."/admin/view-sector";
            header("Location: $url"); exit();
    }
    $data["sectorDetail"]=$chkSector;
    return view('backend/admin/sector_edit',$data);
}

public function update_sector_detail(){
    $response=['status'=>0, 'msg'=>''];
    $SectorModel=new \App\Models\SectorModel();
    $currentSector=trim($this->request->getPost('sid'));
    $Sector =trim($this->request->getPost('sector_name'));
    $Description = trim($this->request->getPost('Sector_Description'));
    $icon = $this->request->getFile('Sector_Icon');
    $background =$this->request->getFile('Sector_Images');
    // print_r($icon);
    // print_r($background);
    // print_data($_FILES);
    //die("dddd");
    $getSectorDetail=$SectorModel->where("Sector_ID",$currentSector)->first();
    if($icon==""){
        $sectorIcon=$getSectorDetail["sectorIcon"];
    }else{
        $sectorIcon=$icon->getRandomName();
        $icon->move('assets/niua/img/', $sectorIcon);
    }

    if($background==""){
        $sectorBackgroundImg=$getSectorDetail["sectorBackground"];
    }else{
        $sectorBackgroundImg=$background->getRandomName();
        $background->move('assets/niua/img/', $sectorBackgroundImg);
    }

    $updateData=[
        'Description'=>$Description,
        'sectorIcon'=>$sectorIcon,
        'sectorBackground'=>$sectorBackgroundImg
    ];
    //print_data($updateData);
    $updateData=$SectorModel->update($currentSector,$updateData);
    if($updateData){
        $data['status']=1;
        $data['msg']='Sector updated successfully';
        $data['data']='';
    }else{
        $data['status']=0;
        $data['msg']='Something went wrong';
        $data['data']='';
    }
    echo json_encode($data); exit;
} // End of the function.






public function addMultipleQuestion(){
    $SectorModel=new \App\Models\SectorModel();
    $questionModel=new \App\Models\QuestionModel();
    $SurveyModel=new \App\Models\SurveyModel();    
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();

    $dataToBeAddedIntoSurvey=array();
    $html_questions ='';

    $Sector_ID = $this->request->getPost('Sector_ID');
    $selectQuestinList = $this->request->getPost('selectQuestinList'); 
    $qid = $this->request->getPost('qid');
    $Survey_ID = $this->request->getPost('Survey_ID');
    $getDetail=$SurveyModel->where('Survey_ID',$Survey_ID)->first();
    
    if(!empty($getDetail)){
        if($getDetail["publish_status"]==2){
            $data['msg']="Survey already published, question can not add now";
            $data['status']=0;
            echo json_encode($data);
            exit; 
        }
    }

    if(!empty($selectQuestinList) && count($selectQuestinList) > 0){
        $sort_order = 0;
        foreach($selectQuestinList as $key=>$qid){
            $questionDetail = $questionModel->where('QB_ID',$qid)->where('Sector_ID',$Sector_ID)->findall();
            if(!empty($questionDetail)){
                $Sector_ID = $questionDetail[0]['Sector_ID'];
                if($sort_order==0){
                    $getSortOrder = $surveyquestionMasterModel->select('Max("sort_order") as max_sort_order')->where('Sector_ID',$Sector_ID)->where('Survey_ID',$Survey_ID)->first();
                    if(!empty($getSortOrder)){
                        $sort_order = $getSortOrder['max_sort_order'] + 1;
                    }else{
                        $sort_order = 1;
                    }
                }else{
                    $sort_order = $sort_order + 1;
                }

                $surveyDataToInsert = array(
                    'Survey_ID'=>$Survey_ID,
                    'Sector_ID'=>$questionDetail[0]['Sector_ID'],
                    'QB_ID'=>$questionDetail[0]['QB_ID'],
                    'UOM_ID'=>$questionDetail[0]['UOM_ID'],
                    'Description'=>$questionDetail[0]['Description'],
                    'created_on'=>date('Y-m-d h:i:s'),
                    'sort_order'=>$sort_order
                );
               array_push($dataToBeAddedIntoSurvey,$surveyDataToInsert);
               $questiondata['questionDetail'] = $questionDetail[0];
               $html_questions = $html_questions.''.view('backend/admin/ajax/QuestionDataAjax',$questiondata);
            }
        }
    }

    if(!empty($dataToBeAddedIntoSurvey)){
        $status = $surveyquestionMasterModel->insertBatch($dataToBeAddedIntoSurvey);
        if($status){
            $updateSurveyStatus = array(
                'publish_status'=>0
            );
            $SurveyModel->update($Survey_ID,$updateSurveyStatus);

            $sectorData = $SectorModel->where('Sector_ID',$Sector_ID)->first();


            $data['msg'] = "All question added successfully in ".$sectorData['Sector'];
            $data['status']=1;
            $data['Sector_ID']=$Sector_ID;
            $data['data'] = $html_questions;

        }else{
            $data['msg'] = "Something went wrong";
            $data['status']=0;
            $data['Sector_ID']=$Sector_ID;
            $data['data'] ='';
        }
    }
    echo json_encode($data);
    exit;
}

public function download_survey_question(){
        $response=['status'=>0, 'msg'=>'', 'html'=>''];
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City_ID'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $SurveyModel=new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $questionModel=new \App\Models\QuestionModel();
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $surveyId=$geturi[2];
        $data['allQuestion']=array();
        $getDetail=$SurveyModel->where('Survey_ID',$surveyId)->first();
        $allQuestion=$surveyquestionMasterModel->where('Survey_ID',$surveyId)->findAll();
        if(!empty($allQuestion)){
            foreach($allQuestion as $key=>$questionDetail){
                if($questionDetail['UOM_ID']==42){
                    $qid=trim($questionDetail["QB_ID"]);
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    $Questiondata['QB_ID']=$qid;
                    $Questiondata['question_placeholder']=$getQuestionMasterDetail["question_placeholder"];
                    $Questiondata['question_description']=$getQuestionMasterDetail["Description"];
                    $Questiondata['question_framework']=$getQuestionMasterDetail["framework_id"];
                    $Questiondata['Parent_QB_ID']=0;
                    $Questiondata['Parent_option']='';
                    $Questiondata['Survey_ID']=$questionDetail['Survey_ID'];
                    $Questiondata['Sector_ID']=$questionDetail['Sector_ID'];
                    $Questiondata['created_on']=$questionDetail['created_on'];
                    $Questiondata['UOM_ID']=$getQuestionMasterDetail['UOM_ID'];
                    array_push($data['allQuestion'],$Questiondata);
                    $childQuestionList=json_decode($getQuestionMasterDetail['child_questions']);
                    foreach($childQuestionList as $chkey =>$chileQuestion){
                        foreach($chileQuestion as $cKey=>$child){
                            $getChildQuestionDetail=$questionModel->where('QB_ID',$child)->first();
                            $ChildQuestiondata['QB_ID']=$child;
                            $ChildQuestiondata['question_placeholder']=$getChildQuestionDetail["question_placeholder"];
                            $ChildQuestiondata['question_description']=$getChildQuestionDetail["Description"];
                            $ChildQuestiondata['question_framework']=$getChildQuestionDetail["framework_id"];
                            $ChildQuestiondata['Parent_QB_ID']=$qid;
                            $ChildQuestiondata['Parent_option']=$chkey;
                            $ChildQuestiondata['created_on']=$questionDetail['created_on'];

                            $ChildQuestiondata['Survey_ID']=$questionDetail['Survey_ID'];
                            $ChildQuestiondata['Sector_ID']=$questionDetail['Sector_ID'];
                            $ChildQuestiondata['UOM_ID']=$getChildQuestionDetail['UOM_ID'];
                            array_push($data['allQuestion'],$ChildQuestiondata);
                        }
                    }
                }else if($questionDetail['UOM_ID']==43){
                    $qid=trim($questionDetail["QB_ID"]);
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    $childQuestionList=json_decode($getQuestionMasterDetail['sub_question']);
                    $Questiondata['QB_ID']=$qid;
                    $Questiondata['question_placeholder']=$getQuestionMasterDetail["question_placeholder"];
                    $Questiondata['question_description']=$getQuestionMasterDetail["Description"];
                    $Questiondata['question_framework']=$getQuestionMasterDetail["framework_id"];
                    $Questiondata['Parent_QB_ID']=0;
                    $Questiondata['Parent_option']='';
                    $Questiondata['Survey_ID']=$questionDetail['Survey_ID'];
                    $Questiondata['Sector_ID']=$questionDetail['Sector_ID'];
                    $Questiondata['created_on']=$questionDetail['created_on'];
                    $Questiondata['UOM_ID']=$getQuestionMasterDetail['UOM_ID'];
                    array_push($data['allQuestion'],$Questiondata);
                    foreach($childQuestionList as $sKey=>$subchild){
                            $getChildQuestionDetail=$questionModel->where('QB_ID',$subchild)->first();
                            $ChildQuestiondata['QB_ID']=$subchild;
                            $ChildQuestiondata['question_placeholder']=$getChildQuestionDetail["question_placeholder"];
                            $ChildQuestiondata['question_description']=$getChildQuestionDetail["Description"];
                            $ChildQuestiondata['question_framework']=$getChildQuestionDetail["framework_id"];
                            $ChildQuestiondata['Parent_QB_ID']=$qid;
                            $ChildQuestiondata['Parent_option']='';
                            $ChildQuestiondata['created_on']=$questionDetail['created_on'];
                            $ChildQuestiondata['Survey_ID']=$questionDetail['Survey_ID'];
                            $ChildQuestiondata['Sector_ID']=$questionDetail['Sector_ID'];
                            $ChildQuestiondata['UOM_ID']=$getChildQuestionDetail['UOM_ID'];
                            array_push($data['allQuestion'],$ChildQuestiondata);
                    }
                }else{
                    $qid=trim($questionDetail["QB_ID"]);
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    if(!empty($getQuestionMasterDetail)){
                        $Questiondata['QB_ID']=$qid;
                        $Questiondata['question_placeholder']=$getQuestionMasterDetail["question_placeholder"];
                        $Questiondata['question_description']=$getQuestionMasterDetail["Description"];
                        $Questiondata['question_framework']=$getQuestionMasterDetail["framework_id"];
                        $Questiondata['Parent_QB_ID']=0;
                        $Questiondata['Parent_option']='';
                        $Questiondata['Survey_ID']=$questionDetail['Survey_ID'];
                        $Questiondata['Sector_ID']=$questionDetail['Sector_ID'];
                        $Questiondata['created_on']=$questionDetail['created_on'];
                        $Questiondata['UOM_ID']=$getQuestionMasterDetail['UOM_ID'];
                        array_push($data['allQuestion'],$Questiondata);
                    }
                }
            }
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A3:A4');
        $sheet->getCell('A3')->setValue( 'S. No.');
        $sheet->mergeCells('B3:B4');
        $sheet->getCell('B3')->setValue('QB ID');
        $sheet->getCell('C3')->setValue('Question Title');
        $sheet->mergeCells('C3:C4');
        $sheet->getCell('D3')->setValue( 'Question Type');
        $sheet->mergeCells('D3:D4');
        $sheet->getCell('E3')->setValue( 'Sector');
        $sheet->mergeCells('E3:E4');
        $sheet->getCell('F3')->setValue( 'Framework');
        $sheet->getCell('G3')->setValue( 'Parent QB ID');
        $sheet->getCell('H3')->setValue( 'Parent Option');
        $sheet->mergeCells('F3:F4');
        $sheet->getCell('I3')->setValue('Added On');
        $sheet->mergeCells('F3:F4');
        $sheet->mergeCells('G3:G4');
        $sheet->mergeCells('H3:H4');
        $sheet->mergeCells('I3:I4');
        $sheet->mergeCells('J3:J4');
        $sheet->mergeCells('K3:K4');
        $sheet->mergeCells('L3:L4');
        // $sheet->mergeCells('A1:L1');
        $sheet->getCell('A1')->setValue('');
        $sheet->getCell('A2')->setValue($getDetail['Survey_Name'].' Details');
        $sheet->getStyle("A1:A2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle("A2:I2")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle("A3:I4")->getFont()->setBold(true)->getColor()->setRGB('000000');
        $sheet->getStyle('A2:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('92d050');
        $sheet->getStyle('A3:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffc000');
        $sheet->getStyle('A1:I4')->getAlignment()->setHorizontal('center');
        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => '000000'],],],];
        $counter=5;
        $i=1;
        if(!empty($data["allQuestion"])){
            foreach($data['allQuestion'] as $key=>$questionDetail){
                $sheet->setCellValue('A'.$counter, $i);
                $sheet->setCellValue('B'.$counter, $questionDetail['QB_ID']);
                $sheet->setCellValue('C'.$counter, $questionDetail['question_description']);
                $sheet->setCellValue('D'.$counter, getUOMName($questionDetail['UOM_ID']));
                $sheet->setCellValue('E'.$counter, getSectorName($questionDetail['Sector_ID']));
                $sheet->setCellValue('F'.$counter, getFrameworkName($questionDetail['question_framework']));
                $sheet->setCellValue('G'.$counter, ($questionDetail['Parent_QB_ID'] >0)?$questionDetail['Parent_QB_ID']:'');
                $sheet->setCellValue('H'.$counter, $questionDetail['Parent_option']);
                $sheet->setCellValue('I'.$counter, date('d-m-Y',strtotime($questionDetail['created_on'])));
                $counter++;
                $i++;
            }
        }

        $spreadsheet->getActiveSheet()->getStyle("A1:I".$counter)->applyFromArray($styleArray);

        $fileName = str_replace(" ","-",$getDetail['Survey_Name'])."-".date("Y-m-d-His").".xlsx";
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        //echo json_encode(['status'=>1,'csrf_token'=>$csrf_token]);
        exit();
} // End of the class.


public function getSuffleSectorQuestionData(){
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $SectorModel=new \App\Models\SectorModel();
    $questionModel=new \App\Models\QuestionModel();
    $SurveyModel=new \App\Models\SurveyModel();


    $Survey_ID = $this->request->getPost('Survey_ID');
    $sector_id = $this->request->getPost('sector_id');
    $qCount = $this->request->getPost('qCount');

    $surevyQuestionData = $surveyquestionMasterModel->where('Survey_ID',$Survey_ID)->where('Sector_ID',$sector_id)->orderBy('sort_order','ASC')->findAll();

    if(!empty($surevyQuestionData)){
        $surveyData = $SurveyModel->where('Survey_ID',$Survey_ID)->first();
        $sectorData = $SectorModel->where('Sector_ID',$sector_id)->first();
        $res['Survey_Name'] = $surveyData['Survey_Name'];
        $res['Sector'] = $sectorData['Sector'];
        $res['Sector_ID'] = $sectorData['Sector_ID'];
        $res['questionList'] = $surevyQuestionData;


        if(!empty($res['questionList'])){
            foreach($res['questionList'] as $key=>$questionDetail){
                    $qid=trim($questionDetail["QB_ID"]);
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    if(!empty($getQuestionMasterDetail)){
                        $res['questionList'][$key]['question_placeholder']=$getQuestionMasterDetail["question_placeholder"];
                        $res['questionList'][$key]['question_description']=$getQuestionMasterDetail["DetailedDescription"];
                        $res['questionList'][$key]['question_framework']=$getQuestionMasterDetail["framework_id"];
                        $res['questionList'][$key]['child_questions'] = $getQuestionMasterDetail['child_questions'];
                        $res['questionList'][$key]['sub_question'] = $getQuestionMasterDetail['sub_question'];
                        $res['questionList'][$key]['question_matrix_barcode'] = $getQuestionMasterDetail['question_matrix_barcode'];
                        $res['questionList'][$key]['calculation_type'] = $getQuestionMasterDetail['calculation_type'];
                    }else{
                        $res['questionList'][$key]['question_placeholder']="";
                        $res['questionList'][$key]['question_description']="";
                        $res['questionList'][$key]['question_framework']="";
                        $res['questionList'][$key]['child_questions'] = '';
                        $res['questionList'][$key]['sub_question'] = '';
                        $res['questionList'][$key]['question_matrix_barcode'] = '';
                        $res['questionList'][$key]['calculation_type'] = '';
                    }
            }
        }
        $data['modal_html']=view('backend/ajax/SuffleSectorQuestionModalAjax',$res);
        $data['status']=1;
        $data['msg']='check the data';
        
    }else{
        $data['modal_html']='';
        $data['status']=0;
        $data['msg']='Something went wrong';
    }

    echo json_encode($data);
    exit;

}


public function update_sort_order(){
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $dataArray = $this->request->getPost('dataArray');
    $survey_id = $this->request->getPost('Survey_ID');

    if(!empty($dataArray)){
        foreach($dataArray as $key=>$question){
            $updateData=array(
                'sort_order'=>$question['sort_order']
            );
            $res = $surveyquestionMasterModel->set('sort_order',$question['sort_order'])->where('Survey_ID',$survey_id)->where('Sector_ID',$question['sector_id'])->where('QB_ID',$question['question_id'])->update();
            if($res){
                $data['status']=1;
                $data['msg']='Order updated successfully';
            }else{
                $data['status']=0;
                $data['msg']='Something went wrong';
            }
        }
    }else{
        $data['status']=0;
        $data['msg']='Something went wrong';
    }
    echo json_encode($data);
    exit;
}


} // End of the class
?>
