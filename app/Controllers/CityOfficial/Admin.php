<?php
namespace App\Controllers\CityOfficial;
use App\Controllers\BaseController;
class Admin extends BaseController{


    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app"); 
        // $session=session();
        // $session= session_start();  
        // $session = \Config\Services::session();
        $this->db=db_connect();
    }

    
    public function index(){
       die("Fine here...");
    } // End of the function.


    public function sector_question(){        
        $logedInUserDetail=session('admin_detail');
        $getLoginUserRole=$logedInUserDetail['role'];
        if($getLoginUserRole!=4){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        $loginUserCity=$logedInUserDetail['City_ID'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $SurveyModel=new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $remarkModel=new \App\Models\Remark(); 
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $surveyId=$geturi[2];
        $sectorId=$geturi[3];
        

        $data["sectorName"]=getSectorName($sectorId);
        $getDetail=$SurveyModel->where('Survey_ID',$surveyId)->first();
        if(!empty($getDetail)){
            $data["surveyName"]=ucwords($getDetail["Survey_Name"]);
            $data["surveyEndDate"]=$getDetail["To_Date"];
            $data["surveyStartDate"]=$getDetail["From_Date"];
            if($getDetail["publish_status"]==2){
                $data["allQuestion"]=$surveyquestionMasterModel->where('Sector_ID', $sectorId)->where('Survey_ID',$surveyId)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();
            }
        }else{
                $data["surveyName"]="";
                $data["allQuestion"]=array();
        }
        if(!empty($data["allQuestion"])){
            foreach($data['allQuestion'] as $key=>$questionDetail){
                    $qid=trim($questionDetail["QB_ID"]);

                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();


                    $questionTotalComment=$remarkModel->where('Survey_ID',$surveyId)->where('QB_ID',$qid)->where('City_ID',$loginUserCity)->where('sector_id',$sectorId)->where('type',1)->countAllResults();


                    $questionTotalDocument=$remarkModel->where('Survey_ID',$surveyId)->where('QB_ID',$qid)->where('City_ID',$loginUserCity)->where('sector_id',$sectorId)->where('type',2)->countAllResults();


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
        //print_data($data["allQuestion"]);
        // if(empty($data["allQuestion"])){
        //     $url=base_url()."admin/dashboard";
        //     header("Location: $url"); exit();
        // }
        $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$surveyId)->where('sector_id',$sectorId)->where('City_ID',$loginUserCity)->where('Value !=',"")->findAll();
        $data['totalAnswered']=count($AnsweredQuestions); 
        $data['allsector']=$SectorModel->orderBy('Sector')->findall(); 
        // print_data($data);  
     	return view('backend/city_official/sector_question',$data);
    } // End of the function.


    public function cityOfficialSurveyAjaxData(){
        $response=['status'=>0, 'msg'=>''];
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $SurveyResultModel=new \App\Models\Survey_result();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $City_submissionModel=new \App\Models\City_submission();     
        $survey_id=trim($this->request->getPost('survey_id'));
        $data['city_official_selected_Survey']=$survey_id;
        /* Check Inactive */
        $chkSurveyStatus=$SurveyModel->where('Survey_ID',$survey_id)->where('active_inactive_status',1)->first();
        if(empty($chkSurveyStatus)){
            $response['msg']="Survey is inactive!";
            $response['status']=2;
            echo json_encode($response); exit();
        }
        /* End Check Inactive */


        $session=session();
        $sessiondata=['city_official_selected_Survey'=>$survey_id];
        $session->set($sessiondata);
        $data["surveyAllAssignQuestions"]=$surveyquestionMasterModel->where("Survey_ID",$survey_id)->findAll();
        $data["surveyAllAnsweredQuestions"]=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("Value !=","")->findAll();

        $chkSubmitStatus=$City_submissionModel->where('Survey_ID',$survey_id)->where('City_ID',$loginUserCityId)->first();
        if(!empty($chkSubmitStatus)){
          $getSubmitDate=$chkSubmitStatus["submission_date"];
          $data["submission_note"]='You have submitted on : '.$getSubmitDate;
        }else{
          $data["submission_note"]=''; 
        }

        $data["getReverted"]=$SurveyResultModel->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("validator_1_status !=",0)->where("validator_2_status",3)->findAll();

        $data["getRevertedSector"]=$SurveyResultModel->select('DISTINCT("Survey_ID"),sector_id')->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("validator_2_status",3)->where("validator_1_status !=",0)->findAll();

        $data['allSurveyList']=$SurveyModel->where('publish_status',2)->findAll();
        $surveyAllAssignQuestions=$surveyquestionMasterModel->where("Survey_ID",$survey_id)->orderBy('sort_order','ASC')->findAll();
        $surveyAllAnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where('Value !=',"")->findAll();
        if((count($surveyAllAssignQuestions)==count($surveyAllAnsweredQuestions)) && empty($chkSubmitStatus)){
           $data["button_html"]='<button type="button" class="btn btn-primary sub-p cityOfficialSubmit" id="">Submit</button>';
        }else{
           $data["button_html"]='<button type="button" class="btn btn-secoundry sub-p" disabled>Submit</button>';
        }
                 
        $data['survey_id']=$survey_id;
            $data['allsector']=$SectorModel->orderBy('Sector')->findall();
            $data['surveyDeatail']=$getDetail=$SurveyModel->where('Survey_ID',$survey_id)->where('publish_status',2)->first();
            
            $survey_start_date=$getDetail["From_Date"]; 
            $survey_end_date=$getDetail["To_Date"];
            $data["date_note"]='<b>Note : </b>Start Date : '.$survey_start_date." & End Date : ".$survey_end_date;
            if(!empty($getDetail)){    
                foreach($data['allsector'] as $key=>$sector){
                        $totalQuestions = $surveyquestionMasterModel->where('Survey_ID',$survey_id)->where('Sector_ID',$sector['Sector_ID'])->orderBy('sort_order','ASC')->findAll();
                        if(!empty($totalQuestions)){
                            $data['allsector'][$key]['QuestionsInSurvey'] = count($totalQuestions);
                        }else{
                            $data['allsector'][$key]['QuestionsInSurvey'] = 0;
                        }
                }
            }
            
            $getCurrentSurveyDetail=$SurveyModel->where('Survey_ID',$survey_id)->first();
            $todayDate=date("Y-m-d");
            $data["survey_notification"]="";
            if(!empty($getCurrentSurveyDetail)){
                $currentSurveyStartDate=$getCurrentSurveyDetail['From_Date'];
                $currentSurveyEndDate=$getCurrentSurveyDetail['To_Date'];
                if(strtotime($currentSurveyStartDate)>strtotime($todayDate)){
                    $data["survey_notification"]="Survey has not yet started";
                }else if(strtotime($todayDate)>strtotime($currentSurveyEndDate)){
                    $data["survey_notification"]="Survey has now ended";
                }
            }


            if(!empty($data['allsector'])){
                // print_data($data);
                $data['citySectorAjax_html'] = view('backend/ajax/cityOfficialDashboardSurveyAjax',$data);
                $data['status']=1;
                $data['msg']='';
            }else{
                $data['citySectorAjax_html'] = '';
                $data['status']=0;
                $data['msg']='No question found';
            }
        echo json_encode($data);
        exit;
    } // End of the function.


    public function city_reverted_dashboard(){

        $revertedSector=[];
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $surveyId=$geturi[2];
        //die("Survey Id :: ".$surveyId);        
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        if($loginUserRole!=4){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        $SurveyResultModel=new \App\Models\Survey_result();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();    
        $survey_id=$surveyId;
        $data["surveyAllAssignQuestions"]=$surveyquestionMasterModel->where("Survey_ID",$survey_id)->findAll();
        $data["surveyAllAnsweredQuestions"]=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("Value !=","")->findAll();
        
        $data["getReverted"]=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("validator_1_status !=",0)->where("validator_2_status",3)->findAll();
        //print_data($data["getReverted"]);

        $data["getRevertedSector"]=$SurveyResultModel->select('DISTINCT("Survey_ID"),sector_id')->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("validator_2_status",3)->where("validator_1_status !=",0)->findAll();



        if(empty($data["getRevertedSector"])){
            $url=base_url()."admin/dashboard";
            header("Location: $url"); exit();
        }

        if(!empty($data["getRevertedSector"])){
            foreach($data["getRevertedSector"] as $revertkey=>$getRevertedSectorDetail) {
                $s=$getRevertedSectorDetail['sector_id'];
                //die($s);
                array_push($revertedSector, $s);                
            }
        }

        $data['all_revertedSector']=$revertedSector;
        $data['allSurveyList']=$SurveyModel->where('publish_status',2)->findAll();
        $surveyAllAssignQuestions=$surveyquestionMasterModel->where("Survey_ID",$survey_id)->orderBy('sort_order','ASC')->findAll();
        $surveyAllAnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where('Value !=',"")->findAll();
        if(count($surveyAllAssignQuestions)==count($surveyAllAnsweredQuestions)){
         $data["button_html"]='<button type="button" class="btn btn-primary sub-p cityOfficialSubmit" id="">Submit</button>';
        }else{
         $data["button_html"]='<button type="button" class="btn btn-secoundry sub-p" disabled>Submit</button>';
        }
        //print_data($data['allSurveyList']);          
        $data['survey_id']=$survey_id;
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $data['surveyDeatail']=$getDetail=$SurveyModel->where('Survey_ID',$survey_id)->where('publish_status',2)->first();
        //print_data($getDetail);
        $survey_start_date=$getDetail["From_Date"]; 
        $survey_end_date=$getDetail["To_Date"];
        $data["date_note"]='<b>Note : </b>Start Date : '.$survey_start_date." & End Date : ".$survey_end_date;
        if(!empty($getDetail)){    
            foreach($data['allsector'] as $key=>$sector){
                    $data['allsector'][$key]['QuestionsRevertedCount']=0;
                    $sid=$sector['Sector_ID'];
                    if(in_array($sid,$revertedSector)){
                        $getQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$surveyId)->where('sector_id',$sid)->where('City_ID',$loginUserCityId)->where('validator_2_status',3)->findAll();
                        if(!empty($getQuestions)){
                            $data['allsector'][$key]['QuestionsRevertedCount']=count($getQuestions);
                        }else{
                            $data['allsector'][$key]['QuestionsRevertedCount']=0;
                        }
                    }
                    $totalQuestions = $surveyquestionMasterModel->where('Survey_ID',$survey_id)->where('Sector_ID',$sector['Sector_ID'])->orderBy('sort_order','ASC')->findAll();
                    if(!empty($totalQuestions)){
                        $data['allsector'][$key]['QuestionsInSurvey'] = count($totalQuestions);
                    }else{
                        $data['allsector'][$key]['QuestionsInSurvey'] = 0;
                    }
            }
        }
        //print_data($data['allsector']);
        return view('backend/city_official/revert/dashboard',$data);
    } // End of the function.

    public function sector_revert_question(){
        $revertedSector=[];
        $allQuestions=[];
        $logedInUserDetail=session('admin_detail');
        $loginUserRole=$logedInUserDetail['role'];
        if($loginUserRole!=4){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];        
        $SurveyResultModel=new \App\Models\Survey_result();
        $SurveyModel=new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $remarkModel=new \App\Models\Remark(); 
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $surveyId=$geturi[2];
        $sectorId=$geturi[3];
        $data["selctedSurvey"]=$surveyId;
        //die("Sector Id : ".$sectorId." Survey Id :: ".$surveyId);
        $data["getRevertedSector"]=$SurveyResultModel->select('DISTINCT("Survey_ID"),sector_id')->where('parent_qb_id',0)->where("Survey_ID",$surveyId)->where("City_ID",$loginUserCity)->where("validator_2_status",3)->findAll();

        if(!empty($data["getRevertedSector"])){
            foreach($data["getRevertedSector"] as $revertkey=>$getRevertedSectorDetail) {
                $s=$getRevertedSectorDetail['sector_id'];
                //die($s);
                array_push($revertedSector, $s);                
            }
        }

        $data['all_revertedSector']=$revertedSector;
        $data["surveyName"]="";
        $data["sectorName"]=getSectorName($sectorId);
        $getDetail=$SurveyModel->where('Survey_ID',$surveyId)->first();
        if(!empty($getDetail)){
            $data["surveyName"]=ucwords($getDetail["Survey_Name"]);
            $data["surveyEndDate"]=$getDetail["To_Date"];
            $data["surveyStartDate"]=$getDetail["From_Date"];
        }
        $getQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$surveyId)->where('sector_id',$sectorId)->where('City_ID',$loginUserCity)->where('validator_2_status',3)->findAll();
           if(!empty($getQuestions)){
                foreach($getQuestions as $key=>$value){
                    $ques=trim($value['QB_ID']);
                    array_push($allQuestions,$ques);
                }
            }
            //print_data($allQuestions);
            if(!empty($allQuestions)){
                $data["allQuestion"]=$surveyquestionMasterModel->whereIn('QB_ID',$allQuestions)->where('Sector_ID',$sectorId)->where('Survey_ID',$surveyId)->orderBy('sort_order','ASC')->findAll();
            }else{
                $data["allQuestion"]=array();    
            }
            if(!empty($data["allQuestion"])){
            foreach($data['allQuestion'] as $key=>$questionDetail){
                    $qid=trim($questionDetail["QB_ID"]);
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    //print_data($getQuestionMasterDetail);
                    $questionTotalComment=$remarkModel->where('Survey_ID',$surveyId)->where('QB_ID',$qid)->where('City_ID',$loginUserCity)->where('sector_id',$sectorId)->where('type',1)->countAllResults();
                    $questionTotalDocument=$remarkModel->where('Survey_ID',$surveyId)->where('QB_ID',$qid)->where('City_ID',$loginUserCity)->where('sector_id',$sectorId)->where('type',2)->countAllResults();
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
        if(empty($data["allQuestion"])){
           $url=base_url()."admin/dashboard";
           header("Location: $url"); exit(); 
        }
        $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$surveyId)->where('sector_id',$sectorId)->where('City_ID',$loginUserCity)->where('validator_2_status',3)->where('Value !=',"")->findAll();
        $data['totalAnswered']=count($AnsweredQuestions); 
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();  
        // print_data($data);    
        return view('backend/city_official/revert/sector_question',$data);
    } // End of the function.


} // End of the class.
?> 

