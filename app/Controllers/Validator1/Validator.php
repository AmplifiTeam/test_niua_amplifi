<?php
namespace App\Controllers\Validator1;
use App\Controllers\BaseController;
class Validator extends BaseController{

    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }

    public function index(){
    	die("Index");
    } 

    public function get_kpi_list(){
        $SurveyResultModel=new \App\Models\Survey_result();
        $validatorSectorModel=new \App\Models\Validator_sector();
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $City_submissionModel=new \App\Models\City_submission();
        $validatorPriorityCity=new \App\Models\Validator_priority_city();
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $data["loginUserId"]=$logedInUserDetail['user_id'];
        $response=['status' => 0, 'msg' => ''];
        $selectedSurvey=trim($this->request->getPost('Survey_ID'));

        // print_data($selectedSurvey);

        $session=session();
        $sessiondata=['V1_selected_Survey'=> $selectedSurvey];
        $session->set($sessiondata);

        $data['Survey_ID']=trim($this->request->getPost('Survey_ID'));

        //die("Survey :: ".$selectedSurvey);
        if($selectedSurvey!=""){
            $data["total_city_assigned"]=$validatorJobCity->where('survey_id',$selectedSurvey)->where('validator_1_user_id',$loginUserId)->countAllResults();
            $pre_seven_day=date('Y-m-d', strtotime('-7 days'));
            $todat=date('Y-m-d');
             
            $data["recent_added_city"]=$validatorJobCity->where('survey_id',$selectedSurvey)->where('validator_1_user_id',$loginUserId)->where('created_on >=',$pre_seven_day)->where('created_on <=',$todat)->countAllResults();
            $data['priority_city']=$validatorPriorityCity->where('survey_id',$selectedSurvey)->where('validator_user_id',$loginUserId)->countAllResults();

            $data['sendtov2']=$validatorJobCity->where('survey_id',$selectedSurvey)->where('validator_1_user_id',$loginUserId)->where('sand_to_v2',1)->countAllResults();

            $data["showTableCities"]=$validatorJobCity->where('survey_id',$selectedSurvey)->where('validator_1_user_id',$loginUserId)->findAll();

            $city_validated=0;
            $pending_city_for_validate=0;
            $data["pending_city_validate"]=0;            
            if(!empty($data["showTableCities"])){
            foreach($data['showTableCities'] as $key=>$jobDetail){
                    $cityid=trim($jobDetail["city_id"]);
                    $sectorId=trim($jobDetail['sector_id']);
                    /* Get City Validated */
                        $getTotal=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->where('validator_1_status',0)->where('sector_id',$sectorId)->countAllResults();
                        $data['getTotal']=$getTotal;
                        if($getTotal){
                            $pending_city_for_validate=$pending_city_for_validate+1;
                        }else{
                            $city_validated=$city_validated+1;
                        }
                    /* End Get City Validated */

                    $getTotalV1Questions=$SurveyResultModel->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->where('sector_id',$sectorId)->countAllResults();
                    // print_data($getTotalV1Questions);

                    //Get Approved...
                    $getTotalV1Approved=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->where('validator_1_status',1)->where('sector_id',$sectorId)->countAllResults();

                    //Get Rejected...
                    $getTotalV1Rejected=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->where('validator_1_status',2)->where('sector_id',$sectorId)->countAllResults();
                    //Get Revert With Comment...
                    $getTotalV1Reverted=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->where('validator_1_status',3)->where('sector_id',$sectorId)->countAllResults();

                    $getTotalAssignQuestion=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->where('sector_id',$sectorId)->countAllResults();
                    $data['showTableCities'][$key]['city_total_questions']=$getTotalAssignQuestion;
                    $data['showTableCities'][$key]['total_approved']=$getTotalV1Approved;
                    $data['showTableCities'][$key]['total_rejected']=$getTotalV1Rejected;
                    $data['showTableCities'][$key]['total_reverted']=$getTotalV1Reverted;
                    $getSubmissionDate=$City_submissionModel->where('Survey_ID',$selectedSurvey)->where('City_ID',$cityid)->first();
                    if(!empty($getSubmissionDate)){
                        $data['showTableCities'][$key]['survey_submission_date']=$getSubmissionDate["submission_date"];
                    }else{
                        $data['showTableCities'][$key]['survey_submission_date']="";
                    }
                }
            }
            $data["pending_city_for_validate"]=$pending_city_for_validate;
            $data["city_validated"]=$city_validated;
            $data['Survey_Name']=getSurveyName($selectedSurvey);
            //print_data($data['showTableCities']);
            //print_data($data);
            $response['kpi']=view('backend/validator1/get_kpi_list_ajax',$data);            
        }else{
            $data["showTableCities"]=array();
            $data["total_city_assigned"]=0;
            $data["recent_added_city"]=0;
            $data['Survey_Name']='Welcome to Urban Outcomes Frameworks '.date('Y');
            $response['kpi']=view('backend/validator1/get_kpi_list_ajax',$data);
        }
        echo json_encode($response); exit;
    } // End of the function.

    public function city_questions(){
        $data['allsector']=array();
        $sectors=[];
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel=new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $questionModel=new \App\Models\QuestionModel();
        $remarkModel=new \App\Models\Remark();
        $userModel=new \App\Models\Users();
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $cityUserId=$geturi[2];
        $sectorId=trim($geturi[3]);
        $survey=trim($geturi[4]);  

        //die("City User Id :: ".$cityUserId.", Sector :: ".$sectorId.", Survey :: ".$survey);
        if($cityUserId=="" || $sectorId=="" || $survey==""){
            $url=base_url()."admin/dashboard";
            header("Location: $url"); exit();            
        }

        $getUserDetail=$userModel->where('user_id',$cityUserId)->first();
        //print_data($getUserDetail);
        $getCityId=$getUserDetail["City_ID"];
        $data["surveyId"]=$survey;
        $data["sectorId"]=$sectorId;
        $data["city"]=$getCityId;
        //$chk_validate=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('City_ID',$getCityId)->where('validator_1_status',0)->where('sector_id',$sectorId)->countAllResults();
        
        $chk_validate=$validatorJobCity->where('survey_id',$survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$cityUserId)->where('sector_id',$sectorId)->first();
        // print_data($chk_validate);
        // if($chk_validate['sand_to_v2']==1){
        //    $data["chkvalidated"]=$chk_validate['sand_to_v2'];
        //    $data["v2_status"]=$chk_validate['v2_status'];
        // }else{
           $data["chkvalidated"]=$chk_validate['sand_to_v2']; 
           $data["v2_status"]=$chk_validate['v2_status'];
        // }
        //print_data($data["validated"]);
        $data["getcityUserId"]=trim($cityUserId);
        $data["totalQuestions"]=getSurveySectorQuestions($survey,$sectorId);
        $data['total_aproved']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sectorId)->where('City_ID',$getCityId)->where('validator_1_status',1)->countAllResults();
        $data['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sectorId)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();        
        $data['total_revert_with_comment']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sectorId)->where('City_ID',$getCityId)->where('validator_1_status',3)->countAllResults();
        $data['total_validated']=$data['total_aproved']+$data['total_rejected']+$data['total_revert_with_comment'];
        $getAllsector=$validatorJobCity->where('survey_id',$survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$cityUserId)->findall();
        //print_data($getAllsector);
        if(!empty($getAllsector)){
            foreach($getAllsector as $key=>$value){
                $secId=$value["sector_id"];
                array_push($sectors,$secId);
            }
        }
        //print_data($sectors);
        if(!empty($sectors)){
           $data['allsector']=$SectorModel->whereIn('Sector_ID',$sectors)->orderBy('Sector')->findall(); 
        }

        //Get all Questions...
        $data["allQuestion"]=$surveyquestionMasterModel->where('Sector_ID', $sectorId)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
        //print_data($data["allQuestion"]);
        if(!empty($data["allQuestion"])){
            foreach($data['allQuestion'] as $key=>$questionDetail){
                    $qid=trim($questionDetail["QB_ID"]);
                    $chkV1Action=$SurveyResultModel->where('parent_qb_id',0)->select('validator_1_status,validator_2_status,reverted')->where('Survey_ID',$survey)->where('sector_id',$sectorId)->where('City_ID',$getCityId)->where('QB_ID',$qid)->first();
                    //print_data($chkV1Action);
                    $data['allQuestion'][$key]['validator_action']=$chkV1Action["validator_1_status"];
                    $data['allQuestion'][$key]['validator_2_status']=$chkV1Action["validator_2_status"];
                    $data['allQuestion'][$key]['reverted']=$chkV1Action["reverted"];
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    //print_data($getQuestionMasterDetail);
                    $questionTotalComment=$remarkModel->where('Survey_ID',$survey)->where('QB_ID',$qid)->where('City_ID',$getCityId)->where('sector_id',$sectorId)->where('type',1)->countAllResults();
                    $questionTotalDocument=$remarkModel->where('Survey_ID',$survey)->where('QB_ID',$qid)->where('City_ID',$getCityId)->where('sector_id',$sectorId)->where('type',2)->countAllResults();
                    if(!empty($getQuestionMasterDetail)){
                        $data['allQuestion'][$key]['question_template']=$getQuestionMasterDetail["template_for_file"];
                        $data['allQuestion'][$key]['question_placeholder']=$getQuestionMasterDetail["question_placeholder"];
                        $data['allQuestion'][$key]['question_description']=$getQuestionMasterDetail["DetailedDescription"];
                        $data['allQuestion'][$key]['question_comment']=$questionTotalComment;
                        $data['allQuestion'][$key]['question_document']=$questionTotalDocument;
                        $data['allQuestion'][$key]['child_questions']=$getQuestionMasterDetail['child_questions'];
                        $data['allQuestion'][$key]['sub_question']=$getQuestionMasterDetail['sub_question'];
                        $data['allQuestion'][$key]['question_matrix_barcode']=$getQuestionMasterDetail['question_matrix_barcode'];
                        $data['allQuestion'][$key]['calculation_type']=$getQuestionMasterDetail['calculation_type'];
                    }else{
                        $data['allQuestion'][$key]['question_placeholder']="";
                        $data['allQuestion'][$key]['question_description']="";
                        $data['allQuestion'][$key]['question_comment']=0;
                        $data['allQuestion'][$key]['question_document']=0;
                        $data['allQuestion'][$key]['question_template']="";
                        $data['allQuestion'][$key]['child_questions']='';
                        $data['allQuestion'][$key]['sub_question']='';
                        $data['allQuestion'][$key]['question_matrix_barcode']='';
                        $data['allQuestion'][$key]['calculation_type']='';
                    }
            }
        }
        //print_data($data["allQuestion"]);
        $data["title"]='<h1>'.getSurveyName($survey).' / '.getCityNameByUserId($cityUserId).' - <span class="colr2">'.getSectorName($sectorId).'</span></h1>';   
        // print_data($data);    
        return view('backend/validator1/city_question',$data);
    } // End of the function


    public function add_priority_city(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $validatorPriorityCity=new \App\Models\Validator_priority_city();
        $response=['status' => 0, 'msg' => ''];
        $cityId=trim($this->request->getPost('city'));
        $cityAction=trim($this->request->getPost('action'));
        if($cityId!="" && $cityAction=="add"){
            $getData=$validatorJobCity->where('id',$cityId)->first();
            if(!empty($getData)){
                //print_data($getData);
                $saveData=array(
                    'job_id'=>$getData['job_id'],
                    'validator_user_id'=>$loginUserId,
                    'survey_id'=>$getData['survey_id'],
                    'sector_id'=>$getData['sector_id'],
                    'city_id'=>$getData['city_id'],
                    'status'=>0,
                    'added_on'=>date('Y-m-d H:i:s')
                );
                //print_data($saveData);
                $validatorPriorityCity->insert($saveData);
                $insertedId=$validatorPriorityCity->getInsertID();
                $response['msg']="City marked as priority";
                $response['inserted_id']=$insertedId;
                $response['action']=$cityAction;
                $response['status']=1;
            }
        }else{
            $getData=$validatorJobCity->where('id',$cityId)->first();
            if(!empty($getData)){
                $city=$getData['city_id'];
                $validatorPriorityCity->where('city_id ', $city)->where('validator_user_id', $loginUserId)->delete();
                $response['msg']="City removed from priority";
                $response['action']=$cityAction;
                $response['status']=1;
            }
        }
        echo json_encode($response); exit;
    } // End of the function

    public function approve_question(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $userModel=new \App\Models\Users();        
        $response=['status' => 0, 'msg' => ''];
        $userType=trim($this->request->getPost('user_type'));
        $q_survey=trim($this->request->getPost('q_survey'));
        $q_sector=trim($this->request->getPost('q_sector'));
        $question=trim($this->request->getPost('question'));
        $city_user=trim($this->request->getPost('city_user'));

        $parentQbId = trim($this->request->getPost('parent_qb_id'));
        $getUserDetail=$userModel->where('user_id',$city_user)->first();
        if(empty($getUserDetail)){
           $response['msg']="Invalid city";
           echo json_encode($response); exit; 
        }
        $getCityId=$getUserDetail["City_ID"];
        
        /* Check Validated */
        $chk_validate=$validatorJobCity->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->first();

        if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']!=2){
            $response['msg']="Validated & sent to validator-2. You will not able to change any content post send to validator-2.";
            echo json_encode($response); exit; 
        }else if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']==2){
            $validatorJobCity->set('sand_to_v2',0)->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->update();
        }
        /* End check validated */

        
        $SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$question);

        if($parentQbId!='' && $parentQbId > 0){
            $SurveyResultModel->where('parent_qb_id',$parentQbId);
        }
        $chk=$SurveyResultModel->first();
        
        $updateData=array(
            'validator_1_status'=>1
                        
        );

       
        if(!empty($chk)){
            if($chk['reverted']==2){
                $updateData['reverted'] =3;
                $updateData['validator_2_status']=0;
            }
            $getPrimaryKey=$chk['result_id'];
            $SurveyResultModel->update($getPrimaryKey,$updateData);

            if($parentQbId!='' && $parentQbId > 0){
                $getparentData = $SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('parent_qb_id',$parentQbId)->where('validator_1_status',3)->findAll();
                if(!empty($getparentData) && count($getparentData) > 0){
                    $updateParentData['validator_1_status']=3;
                }else{
                    $updateParentData['validator_1_status']=1;
                }
                $SurveyResultModel->set($updateParentData)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$parentQbId)->update();
            }
            

            $validatorJobCity->set('updated_on',date('Y-m-d H:i:s'))->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->update();
           

            $response['msg']="Approved successfully";
            $response['action']="Approve";
            $response['status']=1;
        }else{
            $response['msg']="Question is not attempted by city";
        }
        $response['userType']=$userType;
        $response['total_approved']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',1)->countAllResults();
        $response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();
        $response['total_reverted']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',3)->countAllResults();
        echo json_encode($response); exit;
    } // End of the function

    public function approve_all_question(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $userModel=new \App\Models\Users();        

        // print_data($this->request->getPost());
        $response=['status' => 0, 'msg' => ''];
        $userType=trim($this->request->getPost('user_type'));
        $q_survey=trim($this->request->getPost('q_survey'));
        $q_sector=trim($this->request->getPost('q_sector'));
        $question=$this->request->getPost('question');
        $city_user=trim($this->request->getPost('city_user'));
        $getUserDetail=$userModel->where('user_id',$city_user)->first();
        if(empty($getUserDetail)){
           $response['msg']="Invalid city";
           echo json_encode($response); exit; 
        }
        $getCityId=$getUserDetail["City_ID"];
        /* Check Validate */
            $chk_validate=$validatorJobCity->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->first();

            
            if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']!=2){
                $response['msg']="Validated & sent to validator-2. You will not able to change any content post send to validator-2.";
                echo json_encode($response); exit; 
            }else if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']==2){
                $validatorJobCity->set('sand_to_v2',0)->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->update();
            }
        /* End check validate*/
        $updateData=array(
            'validator_1_status'=>1            
        );

        /*$Result_validate=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('City_ID',$getCityId)->where('sector_id',$q_sector)->where('QB_ID',$question)->first();

        if($Result_validate['reverted']==2){
            $updateData['reverted'] =3;
            $updateData['validator_2_status'] =0;
        }*/


        //print_data($question);
        if(!empty($question)){
            foreach ($question as $key=>$getQuestionId){
                $chk=$SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$getQuestionId)->first();
                    if(!empty($chk) && $chk['reverted']==2){
                       $updateData['reverted']=3;
                       $updateData['validator_2_status']=0;
                    }
                if(!empty($chk) && $chk['parent_qb_id']==0){
                    $getPrimaryKey=$chk['result_id'];
                    if($chk['validator_1_status']!=1){
                      $SurveyResultModel->update($getPrimaryKey,$updateData);
                    }
                }else{
                   
                    $SurveyResultModel->set($updateData)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->update();
                }
                $validatorJobCity->set('updated_on',date('Y-m-d H:i:s'))->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_id',$getCityId)->where('sector_id',$q_sector)->update();
            }

            $response['msg']="Selected question approved successfully";
            $response['status']=1;    
        }else{
            $response['msg']="Please select a question";
        }
        $response['total_approved']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',1)->countAllResults();
        $response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();

        $response['total_reverted']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',3)->countAllResults();
        echo json_encode($response); exit;
    } // End of the function

    public function reject_question(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $userModel=new \App\Models\Users();        
        $response=['status' => 0, 'msg' => ''];
        $userType=trim($this->request->getPost('user_type'));
        $q_survey=trim($this->request->getPost('q_survey'));
        $q_sector=trim($this->request->getPost('q_sector'));
        $question=trim($this->request->getPost('question'));

        $rejectedByv2_reason = trim($this->request->getPost('rejectedByv2_reason'));

        $parentQbId=trim($this->request->getPost('parent_qb_id'));

        $city_user=trim($this->request->getPost('city_user'));
        $getUserDetail=$userModel->where('user_id',$city_user)->first();
        if(empty($getUserDetail)){
           $response['msg']="Invalid city";
           echo json_encode($response); exit; 
        }
        $getCityId=$getUserDetail["City_ID"];
        /* Check Validate */
                $chk_validate=$validatorJobCity->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->first();
                 
                if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']!=2){
                    $response['msg']="Validated & sent to validator-2. You will not able to change any content post send to validator-2.";
                    echo json_encode($response); exit; 
                }else if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']==2){
                    $validatorJobCity->set('sand_to_v2',0)->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->update();
                }
        /* End check validate*/
        $SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$question);
        if($parentQbId!='' && $parentQbId > 0){
            $SurveyResultModel->where('parent_qb_id',$parentQbId);
        }
        $chk=$SurveyResultModel->first();

        $updateData=array(
            'validator_1_status'=>2,
            'rejectedByv2_reason'=>$rejectedByv2_reason            
        );

        $SurveyResultModel->where('Survey_ID',$q_survey)->where('City_ID',$getCityId)->where('sector_id',$q_sector)->where('QB_ID',$question);

        if($parentQbId!='' && $parentQbId > 0){
            $SurveyResultModel->where('parent_qb_id',$parentQbId);
        }

        $Result_validate=$SurveyResultModel->first();

        if(!empty($chk)){

            if($Result_validate['reverted']==2){
                $updateData['reverted'] =3;
                $updateData['validator_2_status'] =0;
            }

            $getPrimaryKey=$chk['result_id'];
            $SurveyResultModel->update($getPrimaryKey,$updateData);
            
            if($parentQbId!='' && $parentQbId > 0){
                $getparentData = $SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('parent_qb_id',$parentQbId)->where('validator_1_status',3)->findAll();
                if(!empty($getparentData) && count($getparentData) > 0){
                    $updateParentData['validator_1_status']=3;
                }else{
                    $updateParentData['validator_1_status']=2;
                }
                $SurveyResultModel->set($updateParentData)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$parentQbId)->update();
            }

            $validatorJobCity->set('updated_on',date('Y-m-d H:i:s'))->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_id',$getCityId)->where('sector_id',$q_sector)->update();
            $response['msg']="Rejected successfully";
            $response['action']="Rejected";
            $response['status']=1;
        }else{
            $response['msg']="Question is not attempted by city!";
        }
        $response['userType']=$userType;
        //$response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();

        $response['total_approved']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',1)->countAllResults();

        $response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();

        $response['total_reverted']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',3)->countAllResults();
        echo json_encode($response); exit;
    } // End of the function

    public function reject_all_question(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $userModel=new \App\Models\Users();        
        $response=['status' => 0, 'msg' => ''];
        $userType=trim($this->request->getPost('user_type'));
        $q_survey=trim($this->request->getPost('q_survey'));
        $q_sector=trim($this->request->getPost('q_sector'));
        $question=$this->request->getPost('question');
        $city_user=trim($this->request->getPost('city_user'));

        $rejectedByv2_reason=trim($this->request->getPost('rejectedByv2_reason'));


        $getUserDetail=$userModel->where('user_id',$city_user)->first();
        if(empty($getUserDetail)){
           $response['msg']="Invalid city";
           echo json_encode($response); exit; 
        }
        $getCityId=$getUserDetail["City_ID"];
        $updateData=array(
            'validator_1_status'=>2,
            'rejectedByv2_reason'=>$rejectedByv2_reason
        );
        /* Check Validate */
            $chk_validate=$validatorJobCity->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->first();
            
            if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']!=2){
                $response['msg']="Validated & sent to validator-2. You will not able to change any content post send to validator-2.";
                echo json_encode($response); exit; 
            }else if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']==2){
                    $validatorJobCity->set('sand_to_v2',0)->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->update();
                }
            
        if(!empty($question)){
            foreach ($question as $key=>$getQuestionId){
                $chk=$SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$getQuestionId)->first();
                    if(!empty($chk) && $chk['reverted']==2){
                       $updateData['reverted']=3;
                       $updateData['validator_2_status']=0;
                    }

                if(!empty($chk) && $chk['parent_qb_id']==0){
                    $getPrimaryKey=$chk['result_id'];
                    if($chk['validator_1_status']!=2){
                      $SurveyResultModel->update($getPrimaryKey,$updateData);
                    }
                }else{
                    $SurveyResultModel->set($updateData)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->update();
                }

                $validatorJobCity->set('updated_on',date('Y-m-d H:i:s'))->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_id',$getCityId)->where('sector_id',$q_sector)->update();
            }
            $response['msg']="Selected question rejected successfully";
            $response['status']=1;    
        }else{
            $response['msg']="Please select a question";
        }

        //$response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();

        $response['total_approved']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',1)->countAllResults();

        $response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();

        $response['total_reverted']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',3)->countAllResults();
        echo json_encode($response); exit;
    } // End of the function

    public function validator_bookmark_question(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $userModel=new \App\Models\Users();
        $ValidatorBookmarkQuestionModel=new \App\Models\Validator_bookmark_question();        
        $response=['status' => 0, 'msg' => ''];
        $action=trim($this->request->getPost('action'));
        $survey=trim($this->request->getPost('survey_id'));
        $sector=trim($this->request->getPost('sector_id'));
        $question=$this->request->getPost('qb_id');
        $city_user_id=trim($this->request->getPost('city'));
        $chk=$ValidatorBookmarkQuestionModel->where('survey_id',$survey)->where('sector_id',$sector)->where('qb_id',$question)->where('validator_user_id',$loginUserId)->where('city_user_id',$city_user_id)->first();
        $getUserDetail=$userModel->where('user_id',$city_user_id)->first();
        if(empty($getUserDetail)){
           $response['msg']="Invalid city";
           echo json_encode($response); exit; 
        }
        $getCityId=$getUserDetail["City_ID"];
        /* Check Validate 
        $chk_validate=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('City_ID',$getCityId)->where('validator_1_status',0)->where('sector_id',$sector)->countAllResults();
        if(!$chk_validate){
            $response['msg']="Validated & sent to validator-2. You will not able to change any content post send to validator-2.";
            echo json_encode($response); exit; 

        }
        /* End check validate*/
        $saveData=array(
            'survey_id'=>$survey,
            'sector_id'=>$sector,
            'qb_id'=>$question,
            'validator_user_id'=>$loginUserId,
            'city_user_id'=>$city_user_id,
            'added_on'=>date('Y-m-d H:i:s')
        );
        if($action=="add"){
            if(empty($chk)){
                $ValidatorBookmarkQuestionModel->insert($saveData);
                $insertedId=$ValidatorBookmarkQuestionModel->getInsertID();
                $response['msg']="Question added to bookmark";
                $response['inserted_id']=$insertedId;
                $response['status']=1;
            }else{
                $response['msg']="Question already added in bookmark";
            }
        }else{
            //$ValidatorBookmarkQuestionModel->where('survey_id',$survey)->where('sector_id',$sector)->where('qb_id',$question)->where('validator_user_id',$loginUserId)->where('city_user_id',$city_user_id)->delete();
            $getData=$ValidatorBookmarkQuestionModel->where('survey_id',$survey)->where('sector_id',$sector)->where('qb_id',$question)->where('validator_user_id',$loginUserId)->where('city_user_id',$city_user_id)->first();
            if(!empty($getData)){
                $primaryKey=$getData["id"];
                $ValidatorBookmarkQuestionModel->where('id',$primaryKey)->delete();
            }
            $response['msg']="Question removed from bookmark successfully";
            $response['status']=1;
        }
        echo json_encode($response); exit;
    } // End of the function

    public function filter_validator_question(){
        $allQuestions=[];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel=new \App\Models\SurveyModel();
        $questionModel=new \App\Models\QuestionModel();
        $remarkModel=new \App\Models\Remark();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $SurveyResultModel=new \App\Models\Survey_result();
        $userModel=new \App\Models\Users();
        $ValidatorBookmarkQuestionModel=new \App\Models\Validator_bookmark_question();
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];        
        $selection=trim($this->request->getPost('selection'));
        $survey=trim($this->request->getPost('survey_id'));
        $sector=trim($this->request->getPost('sector_id'));
        $city_user_id=trim($this->request->getPost('city'));
        $getUserDetail=$userModel->where('user_id',$city_user_id)->first();
        
        $getCityId=$getUserDetail["City_ID"];
        $data["surveyId"]=$survey;
        $data["sectorId"]=$sector;
        $data["city"]=$getCityId;
        $data["getcityUserId"]=trim($city_user_id);
        $data["loginUserId"]=$loginUserId;
        $response=['status' => 0, 'msg' => ''];
        if($selection=="bookmark"){
            $getData=$ValidatorBookmarkQuestionModel->where('survey_id',$survey)->where('sector_id',$sector)->where('validator_user_id',$loginUserId)->where('city_user_id',$city_user_id)->findAll();
            if(!empty($getData)){
                foreach($getData as $key=>$value){
                    $ques=trim($value['qb_id']);
                    array_push($allQuestions,$ques);
                }
            }
           
            if(!empty($allQuestions)){
                $data["allQuestion"]=$surveyquestionMasterModel->whereIn('QB_ID',$allQuestions)->where('Sector_ID',$sector)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();    
            }
            
       }else if($selection=="approved"){
           
           $getQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$getCityId)->where('validator_1_status',1)->findAll();
           if(!empty($getQuestions)){
                foreach($getQuestions as $key=>$value){
                    $ques=trim($value['QB_ID']);
                    array_push($allQuestions,$ques);
                }
            }
            
            if(!empty($allQuestions)){
                $data["allQuestion"]=$surveyquestionMasterModel->whereIn('QB_ID',$allQuestions)->where('Sector_ID',$sector)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();    
            }

       }else if($selection=="rejected"){
        $getQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->findAll();
           if(!empty($getQuestions)){
                foreach($getQuestions as $key=>$value){
                    $ques=trim($value['QB_ID']);
                    array_push($allQuestions,$ques);
                }
            }
            //print_data($allQuestions);
            if(!empty($allQuestions)){
                $data["allQuestion"]=$surveyquestionMasterModel->whereIn('QB_ID',$allQuestions)->where('Sector_ID',$sector)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();    
            }
        
       }else if($selection=="revert"){
        $getQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$getCityId)->where('validator_1_status',3)->findAll();
           if(!empty($getQuestions)){
                foreach($getQuestions as $key=>$value){
                    $ques=trim($value['QB_ID']);
                    array_push($allQuestions,$ques);
                }
            }
            //print_data($allQuestions);
            if(!empty($allQuestions)){
                $data["allQuestion"]=$surveyquestionMasterModel->whereIn('QB_ID',$allQuestions)->where('Sector_ID',$sector)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();    
            }
        
       }else if($selection=="notAttempt"){
        $getQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$getCityId)->where('validator_1_status',0)->findAll();
           if(!empty($getQuestions)){
                foreach($getQuestions as $key=>$value){
                    $ques=trim($value['QB_ID']);
                    array_push($allQuestions,$ques);
                }
            }
            
            if(!empty($allQuestions)){
                $data["allQuestion"]=$surveyquestionMasterModel->whereIn('QB_ID',$allQuestions)->where('Sector_ID',$sector)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();    
            }
        
       }else{
        $data["allQuestion"]=$surveyquestionMasterModel->where('Sector_ID',$sector)->where('Survey_ID',$survey)->orderBy('sort_order','ASC')->findAll();
       }

       $chk_validate=$validatorJobCity->where('survey_id',$survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user_id)->where('sector_id',$sector)->first();

           $data["chkvalidated"]=$chk_validate['sand_to_v2']; 
           $data["v2_status"]=$chk_validate['v2_status'];    

       if(!empty($data["allQuestion"])){
            foreach($data['allQuestion'] as $key=>$questionDetail){
                    $qid=trim($questionDetail["QB_ID"]);
                    $chkV1Action=$SurveyResultModel->where('parent_qb_id',0)->select('validator_1_status,validator_2_status,reverted')->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$getCityId)->where('QB_ID',$qid)->first();
                    
                    $data['allQuestion'][$key]['validator_action']=$chkV1Action["validator_1_status"];
                    $data['allQuestion'][$key]['validator_2_status']=$chkV1Action["validator_2_status"];
                    $data['allQuestion'][$key]['reverted']=$chkV1Action["reverted"];

                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    
                    $questionTotalComment=$remarkModel->where('Survey_ID',$survey)->where('QB_ID',$qid)->where('City_ID',$getCityId)->where('sector_id',$sector)->where('type',1)->countAllResults();

                    $questionTotalDocument=$remarkModel->where('Survey_ID',$survey)->where('QB_ID',$qid)->where('City_ID',$getCityId)->where('sector_id',$sector)->where('type',2)->countAllResults();

                    if(!empty($getQuestionMasterDetail)){
                        $data['allQuestion'][$key]['question_template']=$getQuestionMasterDetail["template_for_file"];
                        $data['allQuestion'][$key]['question_placeholder']=$getQuestionMasterDetail["question_placeholder"];
                        $data['allQuestion'][$key]['question_description']=$getQuestionMasterDetail["DetailedDescription"];
                        $data['allQuestion'][$key]['question_comment']=$questionTotalComment;
                        $data['allQuestion'][$key]['question_document']=$questionTotalDocument;
                        $data['allQuestion'][$key]['child_questions']=$getQuestionMasterDetail['child_questions'];
                        $data['allQuestion'][$key]['sub_question']=$getQuestionMasterDetail['sub_question'];
                        $data['allQuestion'][$key]['question_matrix_barcode']=$getQuestionMasterDetail['question_matrix_barcode'];
                        $data['allQuestion'][$key]['calculation_type']=$getQuestionMasterDetail['calculation_type'];
                    }else{
                        $data['allQuestion'][$key]['question_placeholder']="";
                        $data['allQuestion'][$key]['question_description']="";
                        $data['allQuestion'][$key]['question_comment']=0;
                        $data['allQuestion'][$key]['question_document']=0;
                        $data['allQuestion'][$key]['question_template']="";
                        $data['allQuestion'][$key]['child_questions']='';
                        $data['allQuestion'][$key]['sub_question']='';
                        $data['allQuestion'][$key]['question_matrix_barcode']='';
                        $data['allQuestion'][$key]['calculation_type']='';
                    }
            }
        }
       
        $response['html']=view('backend/validator1/get_filter_question',$data);
        echo json_encode($response); exit;
    } // End of the function

    public function validator_revert_with_comment(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $ValidatorCommentModel=new \App\Models\Validator_comment();
        $userModel=new \App\Models\Users();        
        $response=['status' => 0, 'msg' => ''];
        $q_survey=trim($this->request->getPost('survey_id'));
        $q_sector=trim($this->request->getPost('sector_id'));
        $question=trim($this->request->getPost('question'));
        $city_user=trim($this->request->getPost('city_user'));

        $parentQbId=trim($this->request->getPost('parent_qb_id'));
        $parentOption ='';


        $comment=trim($this->request->getPost('get_comment'));
        $getUserDetail=$userModel->where('user_id',$city_user)->first();
        if(empty($getUserDetail)){
           $response['msg']="Invalid city";
           echo json_encode($response); exit; 
        }
        $getCityId=$getUserDetail["City_ID"];



        if($parentQbId!='' && $parentQbId > 0){
            $getparentDeails = $SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$parentQbId)->where('parent_qb_id',0)->first();
        }else{
            $getparentDeails =[];
        }
        if(!empty($getparentDeails) && $getparentDeails['Value'] !='' && $getparentDeails['Value']!=1){
            $parentOption = $getparentDeails['Value']; 
        }


        /* Check Validate */
            $chk_validate=$validatorJobCity->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->first();
            if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']!=2){
                $response['msg']="Validated & sent to validator-2. You will not able to change any content post send to validator-2.";
                echo json_encode($response); exit; 
            }else if($chk_validate['sand_to_v2']==1 && $chk_validate['v2_status']==2){
                    $validatorJobCity->set('sand_to_v2',0)->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->update();
                }
        $SurveyResultModel->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$question);

        if($parentQbId!='' && $parentQbId > 0){
            $SurveyResultModel->where('parent_qb_id',$parentQbId)->where('parent_option',$parentOption);
        }

        $chk=$SurveyResultModel->first();

        $updateData=array(
            'validator_1_status'=>3          
        );

        
        if(!empty($chk)){
            if($chk['reverted']==2){
                $updateData['reverted']=3;
                $updateData['validator_2_status']=0;
            }
            $getPrimaryKey=$chk['result_id'];

            $commentData=array(
                'question'=>$question,
                'survey_id'=>$q_survey,
                'sector_id'=>$q_sector,
                'city_id'=>$getCityId,
                'city_user_id'=>$city_user,
                'result_id'=>$getPrimaryKey,            
                'commented_by_user'=>$loginUserId,
                'comment'=>trim($comment),
                'cmt_date'=>date('Y-m-d H:i:s'),
                'status'=>0,
                'parent_qb_id'=>($parentQbId!='' && $parentQbId > 0)?$parentQbId:0
            );
                      
            $SurveyResultModel->update($getPrimaryKey,$updateData);

            if($parentQbId!='' && $parentQbId > 0){
                $updateParentData = $SurveyResultModel->set('validator_1_status',3)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('QB_ID',$parentQbId)->update();
            }
            $validatorJobCity->set('updated_on',date('Y-m-d H:i:s'))->where('survey_id',$q_survey)->where('validator_1_user_id',$loginUserId)->where('city_id',$getCityId)->where('sector_id',$q_sector)->update();

            $ValidatorCommentModel->insert($commentData);
            $response['msg']="Reverted with comment successfully";
            $response['action']="Revert with comment";
            $response['status']=1;
        }else{
            $response['msg']="Question is not attempted by city!";
        }

        $response['total_approved']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',1)->countAllResults();

        $response['total_rejected']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',2)->countAllResults();

        $response['total_reverted']=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$q_survey)->where('sector_id',$q_sector)->where('City_ID',$getCityId)->where('validator_1_status',3)->countAllResults();

        echo json_encode($response); exit;
    } // End of the function

    public function get_validator_comment(){
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $ValidatorCommentModel=new \App\Models\Validator_comment();
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $userModel=new \App\Models\Users();
        $comment_v2="";        
        $response=['status' => 0, 'msg' => ''];
        $q_survey=trim($this->request->getPost('survey_id'));
        $q_sector=trim($this->request->getPost('sector_id'));
        $question=trim($this->request->getPost('question'));
        $city_user=trim($this->request->getPost('city_user_id'));

        $parent_qb_id=trim($this->request->getPost('parent_qb_id'));



        $ValidatorCommentModel->where('survey_id',$q_survey)->where('sector_id',$q_sector)->where('city_user_id',$city_user)->where('question',$question)->where('commented_by_user',$loginUserId);
        if($parent_qb_id!='' && $parent_qb_id > 0){
            $ValidatorCommentModel->where('parent_qb_id',$parent_qb_id);
        }

        $getData=$ValidatorCommentModel->orderBy('id','DESC')->first();


        $getV2=$validatorJobCity->where('survey_id',$q_survey)->where('city_user_id',$city_user)->where('sector_id',$q_sector)->first();
        if(!empty($getV2)){
            $v1_user=$getV2["validator_1_user_id"];
            $v2_user=$getV2["validator_2_user_id"];
            $city=$getV2["city_user_id"];
        }

        $ValidatorCommentModel->select('comment,cmt_date');
        if($parent_qb_id!='' && $parent_qb_id > 0){
            $ValidatorCommentModel->where('parent_qb_id',$parent_qb_id);
        }
        $getV2Comment=$ValidatorCommentModel->where('survey_id',$q_survey)->where('sector_id',$q_sector)->where('question',$question)->where('city_user_id',$city)->where('commented_by_user',$v2_user)->orderBy('id','DESC')->first();

        if(!empty($getV2Comment)){
            $cmtDate=$getV2Comment["cmt_date"];
            $comment_v2=trim($getV2Comment["comment"]);
        }
        
        if(!empty($getData)){
            $comment=trim($getData["comment"]);
        }else{
            $comment="";

        }
        if(!empty($comment_v2)){
          $response["v2_comment"]='<div class="city-offic2"><div class="city-text1 ct-tx1"><h4><label>Validator-2</label><span>'.$cmtDate.'</span></h4><p>'.$comment_v2.'</p></div><div class="city-icon ct-ic1"><i class="bi bi-person-fill"></i><span>Validator-2</span></div></div>';
        }else{
          $response["v2_comment"]='';  
        }
        $response["comment"]=$comment;
        echo json_encode($response); exit;

    } // End of the function

    public function sentv2(){
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $response=['status' => 0, 'msg' => ''];
        $job=trim($this->request->getPost('job'));
        
        $survey_id=trim($this->request->getPost('survey_id'));
        $sector_id=trim($this->request->getPost('sector_id'));
        $city=trim($this->request->getPost('city'));

        
        $getTotal=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey_id)->where('City_ID',$city)->where('validator_1_status',0)->where('sector_id',$sector_id)->countAllResults();
        if(!$getTotal){
            $jobdata = $validatorJobCity->where('survey_id', $survey_id)->where('sector_id', $sector_id)->where('city_id', $city)->where('job_id', $job)->first();


            if($jobdata['v2_status']==2){
                $revert_cycle = $jobdata['revert_cycle'];;
                saveNotification($survey_id,$jobdata['validator_1_user_id'],$jobdata['validator_2_user_id'],5,$revert_cycle);
            }else{
                saveNotification($survey_id,$jobdata['validator_1_user_id'],$jobdata['validator_2_user_id'],2);
            }

            $validatorJobCity
            ->set('sand_to_v2',1)->set('v2_status',0)->set('updated_on',date('Y-m-d H:i:s'))
            ->where('survey_id', $survey_id)
            ->where('sector_id', $sector_id)
            ->where('city_id', $city)
            ->where('job_id', $job)
            ->update(); 
           $response["msg"]="Sent to validator2 successfully";
           $response["status"]=1; 
        }else{
            $response["msg"]="Please attempt all the question in this sector"; 
        }
       
        echo json_encode($response); exit;
    } 


    public function markAsReadNotification(){
        $logedInUserDetail=session('admin_detail');        
        $loginUserId=$logedInUserDetail['user_id'];
        $res = markAsReadNotification($loginUserId);
        if($res){
            echo json_encode(array('status'=>1,'data'=>$res));
        }else{
            echo json_encode(array('status'=>2,'data'=>[]));
        }
        exit;
    }

} // End of the class.
?>