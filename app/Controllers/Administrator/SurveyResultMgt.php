<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;
class SurveyResultMgt extends BaseController{

    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }

    public function index(){
		$logedInUserDetail=session('admin_detail');
		//print_data($logedInUserDetail);
		$loginUserCity=$logedInUserDetail['City_ID'];
		$db= \Config\Database::connect(); 
		$response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel(); 
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $qestion_answer=trim($this->request->getPost('ans'));
        $getCycle=trim($this->request->getPost('cycle'));
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$qestion_survey)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$qestion_survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getCycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }
        $questionDetail=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,framework_id,template_for_file')->where('QB_ID',$qestion_id)->first();
        //print_data($questionDetail);
        if($qestion_sector=="" && $qestion_survey=="" && $qestion_id==""){
			$response['msg'] = "Please provide all the details";
			echo json_encode($response); exit;
        }
        /* Check Require File */
        $remarkModel=new \App\Models\Remark();
        $chkRequireFile=$questionModel->where('QB_ID',$qestion_id)->where('concent_of_upload_file',1)->first();
        if(!empty($chkRequireFile)){
            $chkUserUploadDoc=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->findAll();
            if(count($chkUserUploadDoc)==0){
                $response['msg']="Document is required for completing this question!";
                echo json_encode($response); exit();
            }
        }
        if(!empty($questionDetail)){
            if(!empty($questionDetail["template_for_file"])){
                $chkUserUploadDoc=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->findAll();
                if(count($chkUserUploadDoc)==0){
                    $response['msg']="Template document is required, before attempt this quesion!";
                    echo json_encode($response); exit();
                }
            }
        }
        /* End Check Require File */

        $chkAnswer=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->first();
        

        if(!empty($questionDetail)){
        	$frameworkId=$questionDetail["framework_id"];
        }else{
        	$frameworkId=0;
        }
        $answerSaveDetail=array(
            'Survey_ID'=>$qestion_survey,
        	'Framework_ID'=>$frameworkId,
        	'QB_ID'=>$qestion_id,
        	'Date_filled'=>date('Y-m-d'),
        	'Value'=>$qestion_answer,
        	'City_ID'=>$loginUserCity,
        	'sector_id'=>$qestion_sector,
            'answer_date'=>date('Y-m-d H:i:s')
        );

        
       
        if(empty($chkAnswer)){
            //print_data($answerSaveDetail);
    		$SurveyResultModel->insert($answerSaveDetail);
    		$insertedId = $SurveyResultModel->getInsertID();
    		$response['msg'] = "Saved as draft";
    		$response['inserted_id'] = $insertedId;
    		$response['status'] = 1;
        }else{
            $pid=$chkAnswer["result_id"];
            //die('Primary Key :: '.$pid);
            $answerUpdateDetail=array(
            'Date_filled'=>date('Y-m-d'),
            'Value'=>$qestion_answer,
            'answer_date'=>date('Y-m-d H:i:s')
            );

            if($getCycle=="revert"){
                $answerUpdateDetail['reverted']=2;
            }

            $SurveyResultModel->update($pid,$answerUpdateDetail);
            $response['msg'] = "Updated as draft";
            $response['inserted_id'] = $pid;
            $response['status'] = 1;
        }
        $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->where('Value !=',"")->findAll();
        $response['totalAnswered']=count($AnsweredQuestions);
		echo json_encode($response); exit;
    } // End of the function.

    public function calculated_question_answer(){
        //die("sss calculated_question_answer");
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel(); 
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $qestion_answer=trim($this->request->getPost('ans'));
        $getCycle=trim($this->request->getPost('cycle'));        
        $input1=trim($this->request->getPost('input1'));
        $input2=trim($this->request->getPost('input2'));
        $operation=trim($this->request->getPost('operation'));
        //die('QB-Id :: '.$qestion_id.', Sector :: '.$qestion_sector.', Survey :: '.$qestion_survey.', Operation :: '.$operation.', input1 :: '.$input1.', input2 :: '.$input2.', Answer :: '.$qestion_answer);
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$qestion_survey)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$qestion_survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getCycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }
        $chkAnswer=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->first();

        $questionDetail=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,framework_id,template_for_file')->where('QB_ID',$qestion_id)->first();
        if(!empty($questionDetail)){
            $frameworkId=$questionDetail["framework_id"];
        }else{
            $frameworkId=0;
        }
        $answerSaveDetail=array(
            'Survey_ID'=>$qestion_survey,
            'Framework_ID'=>$frameworkId,
            'QB_ID'=>$qestion_id,
            'Date_filled'=>date('Y-m-d'),
            'Value'=>$qestion_answer,
            'City_ID'=>$loginUserCity,
            'sector_id'=>$qestion_sector,
            'calculation_value1'=>$input1,
            'calculation_operation'=>$operation,
            'calculation_value2'=>$input2,
            'answer_date'=>date('Y-m-d H:i:s')
        );
        //print_data($answerSaveDetail);
        if(empty($chkAnswer)){
            //print_data($answerSaveDetail);
            $SurveyResultModel->insert($answerSaveDetail);
            $insertedId = $SurveyResultModel->getInsertID();
            $response['msg'] = "Saved as draft";
            $response['inserted_id'] = $insertedId;
            $response['status'] = 1;
        }else{
            $pid=$chkAnswer["result_id"];
            //die('Primary Key :: '.$pid);
            $answerUpdateDetail=array(
            'Date_filled'=>date('Y-m-d'),
            'Value'=>$qestion_answer,
            'calculation_value1'=>$input1,
            'calculation_value2'=>$input2,
            'answer_date'=>date('Y-m-d H:i:s')
            );
            if($getCycle=="revert"){
                $answerUpdateDetail['reverted']=2;
            }
            $SurveyResultModel->update($pid,$answerUpdateDetail);
            $response['msg'] = "Updated as draft";
            $response['inserted_id'] = $pid;
            $response['status'] = 1;
        }
        $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->where('Value !=',"")->findAll();
        $response['totalAnswered']=count($AnsweredQuestions);
        echo json_encode($response); exit;       
    } // End of the function.


    public function child_question_previous_option_delete(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $questionModel=new \App\Models\QuestionModel(); 
        $SurveyModel = new \App\Models\SurveyModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $qestion_answer=trim($this->request->getPost('ans'));
        $getCycle=trim($this->request->getPost('cycle')); 
        $getOption=trim($this->request->getPost('option'));
        $chk=$SurveyResultModel->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->where('parent_qb_id',$qestion_id)->findAll();

        if(count($chk)>0){
         $deletePrevious=$SurveyResultModel->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->where('parent_qb_id',$qestion_id)->delete();
        }
        //echo $SurveyResultModel->getLastQuery();
        //print_data($getPreviousData);
        $response['status'] = 1;
        $response['msg']="Previous selection removed";
        echo json_encode($response);
        exit();        
    } // End of the function.



    //Store Child Question Answer
    public function child_question_answer(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $questionModel=new \App\Models\QuestionModel(); 
        $SurveyModel = new \App\Models\SurveyModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $parent_qb_id=trim($this->request->getPost('parent_qb_id'));
        $qestion_answer=trim($this->request->getPost('ans'));
        $getCycle=trim($this->request->getPost('cycle')); 
        $getOption=trim($this->request->getPost('option'));
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$qestion_survey)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$qestion_survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getCycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }
        $questionDetail=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,framework_id,template_for_file,sub_question,child_questions')->where('QB_ID',$qestion_id)->first();
        //print_data($questionDetail);

        if($qestion_sector=="" && $qestion_survey=="" && $qestion_id==""){
            $response['msg'] = "Please provide all the details";
            echo json_encode($response); exit;
        }
        /* Check Require File */
        $remarkModel=new \App\Models\Remark();
        $chkRequireFile=$questionModel->where('QB_ID',$qestion_id)->where('concent_of_upload_file',1)->first();
        if(!empty($chkRequireFile)){
            $chkUserUploadDoc=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->findAll();
            if(count($chkUserUploadDoc)==0){
                $response['msg']="Document is required for completing this quesion!";
                echo json_encode($response); exit();
            }
        }
        if(!empty($questionDetail)){
            if(!empty($questionDetail["template_for_file"])){
                $chkUserUploadDoc=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->findAll();
                if(count($chkUserUploadDoc)==0){
                    $response['msg']="Template document is required, before attempt this quesion!";
                    echo json_encode($response); exit();
                }
            }
        }
        /* End Check Require File */
        if(!empty($questionDetail)){
            $frameworkId=$questionDetail["framework_id"];
        }else{
            $frameworkId=0;
        }


        if($getOption!=""){
            $chkAnswer=$SurveyResultModel->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('parent_qb_id',$parent_qb_id)->where('parent_option',$getOption)->first();
        }else{
            $parentQuestionSaveDetail=array(
                'Survey_ID'=>$qestion_survey,
                'Framework_ID'=>$frameworkId,
                'QB_ID'=>$parent_qb_id,
                'Date_filled'=>date('Y-m-d'),
                'Value'=>1,
                'City_ID'=>$loginUserCity,
                'sector_id'=>$qestion_sector,
                'answer_date'=>date('Y-m-d H:i:s')
            );

            $chkAnswer=$SurveyResultModel->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('parent_qb_id',$parent_qb_id)->first();

            $chkParentAnswer=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$parent_qb_id)->where('City_ID',$loginUserCity)->first();
            //if(empty($chkParentAnswer)){
            //if($allSubQuestion==$getAllChildQuestionsAnswered){
                 if(empty($chkParentAnswer)){
                   $SurveyResultModel->insert($parentQuestionSaveDetail);
                 }   
            //}

        }
        
        $answerSaveDetail=array(
            'Survey_ID'=>$qestion_survey,
            'Framework_ID'=>$frameworkId,
            'parent_qb_id'=>$parent_qb_id,
            'QB_ID'=>$qestion_id,
            'Date_filled'=>date('Y-m-d'),
            'Value'=>$qestion_answer,
            'City_ID'=>$loginUserCity,
            'sector_id'=>$qestion_sector,
            'answer_date'=>date('Y-m-d H:i:s')
        );
        if($getOption!=""){
            $answerSaveDetail["parent_option"]=$getOption;
        }       
       
        if(empty($chkAnswer)){
            //print_data($answerSaveDetail);
            $SurveyResultModel->insert($answerSaveDetail);
            $insertedId = $SurveyResultModel->getInsertID();
            $response['msg'] = "Saved as draft";
            $response['inserted_id'] = $insertedId;
            $response['status'] = 1;
        }else{
            $pid=$chkAnswer["result_id"];
            //die('Primary Key :: '.$pid);
            $answerUpdateDetail=array(
            'Date_filled'=>date('Y-m-d'),
            'Value'=>$qestion_answer,
            'answer_date'=>date('Y-m-d H:i:s')
            );

            if($getCycle=="revert"){
                $answerUpdateDetail['reverted']=2;
            }

            $SurveyResultModel->update($pid,$answerUpdateDetail);
            $response['msg'] = "Updated as draft";
            $response['inserted_id'] = $pid;
            $response['status'] = 1;
        }
        $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->where('Value !=',"")->findAll();
        $response['totalAnswered']=count($AnsweredQuestions);
        echo json_encode($response); exit;
    } // End of the function.


    public function barcode_questionmatrix_upload_file(){
        $get_validation =  \Config\Services::validation();
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status' => 0, 'msg'=>'', 'inserted_id'=>'', 'validation'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $UomOptionModel=new \App\Models\Uom_option();
        $questionModel=new \App\Models\QuestionModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $City_submissionModel=new \App\Models\City_submission();
        $qestion_sector=trim($this->request->getPost('sector'));
        $qestion_survey=trim($this->request->getPost('survey'));
        $qestion_id=trim($this->request->getPost('questionId'));
        $uploadedFile=$this->request->getFile('uploadedFile');
        $getCycle=trim($this->request->getPost('cycle')); 
        $type=trim($this->request->getPost('type'));
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$qestion_survey)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$qestion_survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getCycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }
        
        //print_data($uploadedFile);
        $receivedFileExt=$uploadedFile->getClientExtension();
        if($type=="barcode"){
            if($receivedFileExt!="pdf" && $receivedFileExt!="png" && $receivedFileExt!="jpg" && $receivedFileExt!="jpeg"){
                $response['msg']="Only pdf, png, jpg & jpeg file allowded!";
                echo json_encode($response); exit();
            }
        }
        if($type=="questionMatrix"){
            if($receivedFileExt!="xls" && $receivedFileExt!="xlsx"){
                $response['msg']="Only excel file allowded";
                echo json_encode($response); exit();
            }
        }

        //die("SSS");
        /* #################### Server Side Validation ###########################*/
        $fileSizevalidation=$this->validate([
            'uploadedFile'=>[
            'label'=>'Uploaded File',
            'rules' => 'max_size[uploadedFile,10000]', // 10 MB
            'errors'=>['max_size'=>'Please upload a file less then 10 MB!']
        ]]);
        if(!$fileSizevalidation){
            if($get_validation->getError('uploadedFile')){
                $response['msg']=$get_validation->getError('uploadedFile');
            }
            echo json_encode($response); exit();
        }

        $questionDetail=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,framework_id')->where('QB_ID',$qestion_id)->first();
        //print_data($questionDetail);
        if(!empty($questionDetail)){
            $frameworkId=$questionDetail["framework_id"];
        }else{
            $frameworkId=0;
        }
        $chkAnswer=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->first();

        if(empty($chkAnswer)){
                //Upload file on server...
                $randomFileName=$uploadedFile->getRandomName();
                $uploadedFile->move('assets/uploads/', $randomFileName);  
                $answerSaveDetail=array(
                'Survey_ID'=>$qestion_survey,
                'Framework_ID'=>$frameworkId,
                'QB_ID'=>$qestion_id,
                'Date_filled'=>date('Y-m-d'),
                'Value'=>$randomFileName,
                'City_ID'=>$loginUserCity,
                'sector_id'=>$qestion_sector,
                'answer_date'=>date('Y-m-d H:i:s')
                );                
                $SurveyResultModel->insert($answerSaveDetail);
                $insertedId = $SurveyResultModel->getInsertID();
                $response['msg'] = "Saved as draft";
                $response['inserted_id'] = $insertedId;
                $response['status'] = 1;
            }else{
                $pid=$chkAnswer["result_id"];
                //die('Primary Key :: '.$pid);
                $answerUpdateDetail=array(
                'Date_filled'=>date('Y-m-d'),
                'Value'=>$randomFileName,
                'answer_date'=>date('Y-m-d H:i:s')
                );

                if($getCycle=="revert"){
                    $answerUpdateDetail['reverted']=2;
                }
                $SurveyResultModel->update($pid,$answerUpdateDetail);
                $response['msg'] = "Updated as draft";
                $response['inserted_id'] = $pid;
                $response['status'] = 1;
            }
            $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->findAll();
            $response['totalAnswered']=count($AnsweredQuestions);
            echo json_encode($response); exit();
    } // End of the function.

    public function upload_file(){
        $get_validation =  \Config\Services::validation();
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status' => 0, 'msg'=>'', 'inserted_id'=>'', 'validation'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $UomOptionModel=new \App\Models\Uom_option();
        $questionModel=new \App\Models\QuestionModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $City_submissionModel=new \App\Models\City_submission();
        $qestion_sector=trim($this->request->getPost('sector'));
        $qestion_survey=trim($this->request->getPost('survey'));
        $qestion_id=trim($this->request->getPost('questionId'));
        $uploadedFile=$this->request->getFile('uploadedFile');
        $getCycle=trim($this->request->getPost('cycle'));
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$qestion_survey)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$qestion_survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getCycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }
        
        //print_data($uploadedFile);
        $receivedFileExt=$uploadedFile->getClientExtension();
        //die("SSS");
        /* #################### Server Side Validation ###########################*/
        $fileSizevalidation=$this->validate([
            'uploadedFile'=>[
            'label'=>'Uploaded File',
            'rules' => 'max_size[uploadedFile,10000]', // 10 MB
            'errors'=>['max_size'=>'Please upload a file less then 10 MB!']
        ]]);
        if(!$fileSizevalidation){
            if($get_validation->getError('uploadedFile')){
                $response['msg']=$get_validation->getError('uploadedFile');
            }
            echo json_encode($response); exit();
        }

        $questionDetail=$questionModel->select('QB_ID,Sector_ID,Description,UOM_ID,framework_id')->where('QB_ID',$qestion_id)->first();
        //print_data($questionDetail);
        if(!empty($questionDetail)){
            $frameworkId=$questionDetail["framework_id"];
        }else{
            $frameworkId=0;
        }
        $chkAnswer=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->first();


        //echo $receivedFileExt; 
        //print_data($uploadedFile);
        $getExt=$UomOptionModel->where('qb_id',$qestion_id)->first();
        //print_data($getExt);
        $allExt="";
        if(!empty($getExt)){
            $allExt=trim($getExt["file_extension"]).",".strtolower($getExt["file_extension"]);
            $response['allExt']=$allExt;
        }
        // Check extension...
        if(str_contains($allExt, $receivedFileExt)){
            //Upload file on server...
            $randomFileName=$uploadedFile->getRandomName();
            $uploadedFile->move('assets/uploads/', $randomFileName);            
            if(empty($chkAnswer)){
                $answerSaveDetail=array(
                'Survey_ID'=>$qestion_survey,
                'Framework_ID'=>$frameworkId,
                'QB_ID'=>$qestion_id,
                'Date_filled'=>date('Y-m-d'),
                'Value'=>$randomFileName,
                'City_ID'=>$loginUserCity,
                'sector_id'=>$qestion_sector,
                'answer_date'=>date('Y-m-d H:i:s')
                );

                
                $SurveyResultModel->insert($answerSaveDetail);
                $insertedId = $SurveyResultModel->getInsertID();
                $response['msg'] = "Saved as draft";
                $response['inserted_id'] = $insertedId;
                $response['status'] = 1;
            }else{
                $pid=$chkAnswer["result_id"];
                //die('Primary Key :: '.$pid);
                $answerUpdateDetail=array(
                'Date_filled'=>date('Y-m-d'),
                'Value'=>$randomFileName,
                'answer_date'=>date('Y-m-d H:i:s')
                );

                if($getCycle=="revert"){
                    $answerUpdateDetail['reverted']=2;
                }
                $SurveyResultModel->update($pid,$answerUpdateDetail);
                $response['msg'] = "Updated as draft";
                $response['inserted_id'] = $pid;
                $response['status'] = 1;
            }
        }else{
            $response['msg']="Invalid file, please upload a valid file";
            echo json_encode($response); exit();
        }
        $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$qestion_survey)->where('sector_id',$qestion_sector)->where('City_ID',$loginUserCity)->findAll();
        $response['totalAnswered']=count($AnsweredQuestions);
        echo json_encode($response); exit();
    } // End of the function.

    public function city_submission(){
        $response=['status'=>0, 'msg'=>''];
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
        $surveyId=trim($this->request->getPost('Survey_ID'));
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$surveyId)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$surveyId)->where('City_ID',$loginUserCityId)->first();
        if(!empty($chk)){
            $response['msg'] = "Survey already submitted!";
            echo json_encode($response); exit();
        }
        //die("Survey :: ".$surveyId);
        $survey_all_sub_child_question=0;
        $surveyAllAssignQuestions=$surveyquestionMasterModel->where("Survey_ID",$surveyId)->findAll();
        if(!empty($surveyAllAssignQuestions)){
            foreach($surveyAllAssignQuestions as $key=>$value){
                $qbId=trim($value['QB_ID']);
                $uom_Id=trim($value['UOM_ID']);
                if($uom_Id==43){
                    
                    $getAllChildQuestions=$questionModel->where('QB_ID',$qbId)->first();
                        if(!empty($getAllChildQuestions)){
                            $getSubQuestion=$getAllChildQuestions['sub_question']; // Parent Child Question...
                            if(!empty($getSubQuestion)){
                                $allSubQuestion=$questionModel->whereIn('QB_ID',json_decode($getSubQuestion))->countAllResults();
                                $survey_all_sub_child_question=$survey_all_sub_child_question+$allSubQuestion;
                            }                   
                        }
                        
                    }else if($uom_Id==42){ // For parent Child Conditional

                            $getActiveOption=$SurveyResultModel->where('Survey_ID',$surveyId)->where('City_ID',$loginUserCityId)->where('parent_qb_id',$qbId)->orderBy('result_id', 'DESC')->first();
                            if(!empty($getActiveOption)){
                            $questionOption=$getActiveOption['parent_option'];
                            }else{
                             $questionOption="";   
                            }
                        // echo "Selected option :: ".$questionOption; //die();
                        $getAllChildQuestions=$questionModel->where('QB_ID',$qbId)->first();
                        if(!empty($getAllChildQuestions) && !empty($getActiveOption)){
                           
                            $getChildSubQuestion=$getAllChildQuestions['child_questions'];
                            if($getChildSubQuestion!=""){
                            $getChildSubQuestion=json_decode($getAllChildQuestions['child_questions']);
                            
                                foreach($getChildSubQuestion as $key222=>$getChildQuestionValue){
                                   
                                    if(trim($key222)==trim($questionOption)){
                                        //  echo $questionOption.' == == '.$key222." <br>";
                                        //echo count($getChildQuestionValue).'<br>';
                                        $survey_all_sub_child_question=$survey_all_sub_child_question+count($getChildQuestionValue);
                                    }                    
                                }
                            }
                            
                    }else{
                        $getChildSubQuestion=$getAllChildQuestions['child_questions'];
                        if($getChildSubQuestion!=""){
                        $getChildSubQuestion=json_decode($getAllChildQuestions['child_questions']);
                        //print_r($getChildSubQuestion);
                        foreach($getChildSubQuestion as $key333=>$getChildQuestionValue){
                        // echo $key333;
                        if(!empty($getChildQuestionValue)){
                        $survey_all_sub_child_question=$survey_all_sub_child_question+count($getChildQuestionValue);
                        }                    
                        }
                        }
                    }
                    
                }
        }
        }        
        $surveyAllAnsweredQuestions=$SurveyResultModel->where("Survey_ID",$surveyId)->where("City_ID",$loginUserCityId)->where('Value !=',"")->findAll();        
        $submissionDetail=array(
        'Survey_ID'=>$surveyId,
        'City_ID'=>$loginUserCityId,
        'submission_status'=>1, // 1-Submitted, 0-Not Submitted
        'submission_date'=>date('Y-m-d H:i:s')
        );
        $totalSurveyQues=count($surveyAllAssignQuestions)+$survey_all_sub_child_question;

        /*echo "SurveyQ ::".count($surveyAllAssignQuestions)."<====>";
        echo "SubQ ::".$survey_all_sub_child_question."<====>";
        echo "Total ::".$totalSurveyQues."<====>";
        echo "Attempt ::".count($surveyAllAnsweredQuestions);
        print_data($submissionDetail);*/
        //if(count($surveyAllAssignQuestions)==count($surveyAllAnsweredQuestions)){
        if($totalSurveyQues==count($surveyAllAnsweredQuestions)){
            $City_submissionModel->insert($submissionDetail);
            $insertedId = $City_submissionModel->getInsertID();
            $response['msg'] = "Thank you!";
            $response['inserted_id'] = $insertedId;
            $response['status'] = 1;  
        }else{
            $response['msg']="Please attempt all the questions, make sure you have to attempt all sub-questions also!";
        }
        echo json_encode($response); exit();
    } // End of the function.


    public function re_submit(){
        $validatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $City_submissionModel=new \App\Models\City_submission();
        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City'];
        $loginUserRole=$logedInUserDetail['role'];
        $loginUserCityId=$logedInUserDetail['City_ID'];
        $loginUserId=$logedInUserDetail['user_id'];
        $response=['status' => 0, 'msg' => ''];
        $survey_id=trim($this->request->getPost('survey_id'));
        $jobIds=array();
        if($survey_id!=""){
        /*################## Check All Question Attempt ################# */
              $survey_all_sub_child_question=0;
              $surveyAllAssignQuestions=$surveyquestionMasterModel->where("Survey_ID",$survey_id)->findAll();
              if(!empty($surveyAllAssignQuestions)){
              foreach($surveyAllAssignQuestions as $key=>$value){
                $qbId=trim($value['QB_ID']);
                $uom_Id=trim($value['UOM_ID']);
                if($uom_Id==43){
                    
                    $getAllChildQuestions=$questionModel->where('QB_ID',$qbId)->first();
                        if(!empty($getAllChildQuestions)){
                            $getSubQuestion=$getAllChildQuestions['sub_question']; // Parent Child Question...
                            if(!empty($getSubQuestion)){
                                $allSubQuestion=$questionModel->whereIn('QB_ID',json_decode($getSubQuestion))->countAllResults();
                                $survey_all_sub_child_question=$survey_all_sub_child_question+$allSubQuestion;
                            }                   
                        }
                        
                    }else if($uom_Id==42){ // For parent Child Conditional

                            $getActiveOption=$SurveyResultModel->where('Survey_ID',$survey_id)->where('City_ID',$loginUserCityId)->where('parent_qb_id',$qbId)->orderBy('result_id', 'DESC')->first();
                            if(!empty($getActiveOption)){
                            $questionOption=$getActiveOption['parent_option'];
                            }else{
                             $questionOption="";   
                            }
                        // echo "Selected option :: ".$questionOption; //die();
                        $getAllChildQuestions=$questionModel->where('QB_ID',$qbId)->first();
                        if(!empty($getAllChildQuestions) && !empty($getActiveOption)){
                           
                            $getChildSubQuestion=$getAllChildQuestions['child_questions'];
                            if($getChildSubQuestion!=""){
                            $getChildSubQuestion=json_decode($getAllChildQuestions['child_questions']);
                            
                                foreach($getChildSubQuestion as $key222=>$getChildQuestionValue){
                                   
                                    if(trim($key222)==trim($questionOption)){
                                        
                                        $survey_all_sub_child_question=$survey_all_sub_child_question+count($getChildQuestionValue);
                                    }                    
                                }
                            }
                            
                    }else{
                        $getChildSubQuestion=$getAllChildQuestions['child_questions'];
                        if($getChildSubQuestion!=""){
                        $getChildSubQuestion=json_decode($getAllChildQuestions['child_questions']);
                        //print_r($getChildSubQuestion);
                        foreach($getChildSubQuestion as $key333=>$getChildQuestionValue){
                        // echo $key333;
                        if(!empty($getChildQuestionValue)){
                        $survey_all_sub_child_question=$survey_all_sub_child_question+count($getChildQuestionValue);
                        }                    
                        }
                        }
                    }
                    
                }
        }
        }
        $surveyAllAnsweredQuestions=$SurveyResultModel->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where('Value !=',"")->findAll();
        $totalSurveyQues=count($surveyAllAssignQuestions)+$survey_all_sub_child_question;
        if($totalSurveyQues!=count($surveyAllAnsweredQuestions)){
            $response['msg']="Please attempt all the questions, make sure you have to attempt all sub-questions also!";
            echo json_encode($response); exit;
        }
        /* ###################### End Check All Question Attempted ################### */
              $getReverted=$SurveyResultModel->where("Survey_ID",$survey_id)->where("City_ID",$loginUserCityId)->where("validator_1_status !=",0)->where("validator_2_status",3)->whereIn("reverted",[1,2])->findAll();
         
              if(!empty($getReverted)){
                foreach($getReverted as $key=>$value){
                    $getjobId = $validatorJobCity->where('survey_id',$survey_id)->where('city_user_id',$loginUserId)->where('sector_id',$value['sector_id'])->first();
                    if(!empty($getjobId)){
                        array_push($jobIds,$getjobId['id']);
                    }

                    $question=$value["QB_ID"];
                    $parentQbId=$value["parent_qb_id"];
                    $parentOption=$value["parent_option"];
                    $updateData=array(
                        'validator_1_status'=>0,
                        'reverted'=>2            
                    );
                    $SurveyResultModel->set($updateData)->where('sector_id',$value['sector_id'])->where('City_ID',$loginUserCityId)->where('Survey_ID',$survey_id)->where('QB_ID',$question)->orWhere('parent_qb_id',$question)->where('validator_2_status',3)->where('validator_1_status !=',0)->update();
                }
                
                if(!empty($jobIds)){
                    $jobIdsData = array_unique($jobIds);
                    foreach($jobIdsData as $jkey=>$job){
                        $jobdataCheck = $validatorJobCity->where('id',$job)->first();
                        if(!empty($jobdataCheck)){
                            $revert_cycle=0;
                            if($jobdataCheck['revert_cycle'] > 0){
                                $revert_cycle = $jobdataCheck['revert_cycle'];
                            }
                            saveNotification($survey_id,$loginUserId,$jobdataCheck['validator_1_user_id'],4,$revert_cycle);
                        }
                    }
                }
                $response["msg"]="Resubmitted successfully";
                $response["status"]=1;
              }else{
                $response["msg"]="Invalid request";
              }  
        }
        echo json_encode($response); exit;
    } // End of the function


    /* Question Remark */
    public function add_remark(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyModel = new \App\Models\SurveyModel();
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $qestion_remark=trim($this->request->getPost('rem'));
        $getCycle=trim($this->request->getPost('cycle'));
        /* Check Survey Start Date and End Date */
        $today=date("Y-m-d");
        $surveyDeatail=$SurveyModel->where('Survey_ID',$qestion_survey)->first();
        if(!empty($surveyDeatail)){
            $surveyStartDate=$surveyDeatail['From_Date'];
            $surveyEndDate=$surveyDeatail['To_Date'];
            if(strtotime($today) > strtotime($surveyEndDate)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();
            }else if(strtotime($surveyStartDate) > strtotime($today)){
                $response['msg']="Invalid request!";
                echo json_encode($response); exit();

            }
        }
        /* Check Survey Start Date and End Date */
        $chk=$City_submissionModel->where('Survey_ID',$qestion_survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getCycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }
        /* End Validation */
        $chk=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->first();
        if($qestion_remark!=""){
            $remarkSaveDetail=array(
            'Survey_ID'=>$qestion_survey,
            'QB_ID'=>$qestion_id,
            'city_remark'=>$qestion_remark,
            'document'=>'',
            'doc_original_name'=>'',
            'City_ID'=>$loginUserCity,
            'sector_id'=>$qestion_sector,
            'type'=>1,
            'ramark_date'=>date('Y-m-d H:i:s')
            );
            //print_data($remarkSaveDetail);
            if(empty($chk)){
            $remarkModel->insert($remarkSaveDetail);
            $insertedId = $remarkModel->getInsertID();
            $response['msg'] = "Remark saved successfully";
            $response['inserted_id'] = $insertedId;
            $response['status'] = 1;
            }else{
                $remarkId=$chk["id"];
                $remarkUpdateDetail=array(
                'city_remark'=>$qestion_remark,
                'ramark_date'=>date('Y-m-d H:i:s')
                ); 
                $remarkModel->update($remarkId,$remarkUpdateDetail);
                $response['msg'] = "Remark updated successfully";
                $response['inserted_id'] = $remarkId;
                $response['status'] = 1; 
            }
        }else{
            $response['msg'] = "Please fill all the questions!";
        }
        echo json_encode($response); exit();
    } // End of the function

    public function get_question_remark(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $chk=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',1)->first();
        if(!empty($chk)){
            $response["remark"]=trim($chk["city_remark"]);
        }else{
            $response["remark"]="";
        }
         echo json_encode($response); exit();
    } // End of the function.

    public function validate_question_remark_for_validator(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $userModel=new \App\Models\Users();
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $city_user_id=trim($this->request->getPost('city_user_id'));

        $getUserDetail=$userModel->where('user_id',$city_user_id)->first();
        //print_data($getUserDetail);
        $getCityId=$getUserDetail["City_ID"];

        $chk=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$getCityId)->where('sector_id',$qestion_sector)->where('type',1)->first();
        if(!empty($chk)){
            $response["remark"]=$chk["city_remark"];
        }else{
            $response["remark"]="";
        }
         echo json_encode($response); exit();
    } // End of the function.

    
    public function get_question_documents(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $data['allDocuments']=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->orderBy('id','DESC')->findAll();
        // print_data($data['allDocuments']);
        $html=view('backend/ajax/question_document_list_ajax',$data);
        $response['html']=$html;    
        $response['qb_id']=$qestion_id;    
        $response['survey_id']=$qestion_survey;    
        $response['sector_id']=$qestion_sector;       
        echo json_encode($response); exit();
    } // End of the function.

    public function get_question_documents_for_validator(){
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $userModel=new \App\Models\Users();
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $city_user_id=trim($this->request->getPost('city_user_id'));
        //die($city_user_id);
        $getUserDetail=$userModel->where('user_id',$city_user_id)->first();
        //print_data($getUserDetail);
        $getCityId=$getUserDetail["City_ID"];
        $data['allDocuments']=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$getCityId)->where('sector_id',$qestion_sector)->where('type',2)->orderBy('id','DESC')->findAll();
        // print_data($data['allDocuments']);
        $html=view('backend/ajax/question_document_list_ajax',$data);
        $response['html']=$html;    
        $response['qb_id']=$qestion_id;    
        $response['survey_id']=$qestion_survey;    
        $response['sector_id']=$qestion_sector;       
        echo json_encode($response); exit();
    } // End of the function.


    public function save_question_document(){
        $get_validation =  \Config\Services::validation();

        $logedInUserDetail=session('admin_detail');
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $uploadedFile=$this->request->getFile('qdoc_file');
        $tempfileName=$uploadedFile->getClientName();
        //echo $tempfileName;
        //print_data($uploadedFile);
        $receivedFileExt=$uploadedFile->getClientExtension();
        $allowdedExt=["pdf","PDF","xlsx","XLSX","docx","docx", "shp", "SHP"];
        /* #################### Server Side Validation ###########################*/
        //Check Ext...
        //die("Received Ext :: ".$receivedFileExt);
        if(!in_array($receivedFileExt, $allowdedExt)){
            $response['msg']="Only pdf, doc, xls, xlsx & shape allowded!";
            echo json_encode($response); exit();
        }

        $fileSizevalidation=$this->validate([
            'qdoc_file'=>[
            'label'=>'Uploaded File',
            'rules' => 'max_size[qdoc_file,10000]', // 10 MB
            'errors'=>['max_size'=>'Please upload a file less then 10 MB!']
        ]]);
        if(!$fileSizevalidation){
            if($get_validation->getError('qdoc_file')){
                $response['msg']=$get_validation->getError('qdoc_file');
            }
            echo json_encode($response); exit();
        }

        $chkRequireFile=$questionModel->where('QB_ID',$qestion_id)->where('concent_of_upload_file',1)->first();
        if(!empty($chkRequireFile)){
            $response['reQuiredFile'] = 1;
        }else{
            $response['reQuiredFile'] = 0;
        }

        //Check max upload...
        $check_max_upload=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->findAll();
        if(count($check_max_upload) >= 4){
            
            $response['msg']="Only 4 documents allowded!";
            echo json_encode($response); exit();
        }
        

        //Upload file on server...
        $randomFileName=$uploadedFile->getRandomName();
        $uploadedFile->move('assets/uploads/question_documents/', $randomFileName); 
        $docSaveDetail=array(
        'Survey_ID'=>$qestion_survey,
        'QB_ID'=>$qestion_id,
        'city_remark'=>"",
        'document'=>$randomFileName,
        'doc_original_name'=>$tempfileName,
        'City_ID'=>$loginUserCity,
        'sector_id'=>$qestion_sector,
        'type'=>2,
        'ramark_date'=>date('Y-m-d H:i:s')
        );
        //print_data($docSaveDetail);
        $remarkModel->insert($docSaveDetail);
        $insertedId = $remarkModel->getInsertID();
        $response['msg'] = "Question document saved successfully";
        $response['inserted_id'] = $insertedId;
        $response['status'] = 1;

        $data['allDocuments']=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->orderBy('id','DESC')->findAll();
        //print_data($allDocuments);
        $response['totalFilesCount']=count($data['allDocuments']);
        $html=view('backend/ajax/question_document_list_ajax',$data);
        $response['html']=$html;
        echo json_encode($response); exit();
    } // End of the function.

    public function delete_question_document(){
        $City_submissionModel=new \App\Models\City_submission(); 
        $get_validation =  \Config\Services::validation();
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>'']; 
        $remarkModel=new \App\Models\Remark();  
        $id=trim($this->request->getPost('id'));
        //die('Document Id :: '.$id);        
        $survey=trim($this->request->getPost('survey_id'));
        $getcycle=trim($this->request->getPost('cycle'));

        //die("Survey :: ".$survey);
        $chk=$City_submissionModel->where('Survey_ID',$survey)->where('City_ID',$loginUserCity)->first();
        if(!empty($chk) && $getcycle=="first"){
            $response['msg']="You have already submitted!";
            echo json_encode($response); exit();
        }



        if($id!=""){
            //Return Remaining Document...
            $getData=$remarkModel->where('id',$id)->first();
            //print_data($getData);
            if(!empty($getData)){
                $qestion_survey=$getData["Survey_ID"];
                $qestion_id=$getData["QB_ID"];
                $qestion_sector=$getData["sector_id"];
                $doc=$getData["document"];
                $data['allDocuments']=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qestion_id)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->orderBy('id','DESC')->where('id !=',$id)->findAll();

                $remarkModel->where('id ', $id)->delete();
                //unlink("assets/uploads/question_documents/".$doc); // Delete Document.
            }else{
                $data['allDocuments']=array();
            }
            //print_data($allDocuments);


            $html=view('backend/ajax/question_document_list_ajax',$data);
            $response['html']=$html;
            $response['msg'] = "Question document deleted successfully";
            $response['deleted_id'] = $id;
            $response['status'] = 1;
        }else{
            $data['allDocuments']=array();
        }        

        $response['totalFilesCount'] = count($data['allDocuments']);
        echo json_encode($response); exit();
    } // End of the function


    public function add_bookmark_question(){
        $get_validation=  \Config\Services::validation();
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        // $SurveyResultModel=new \App\Models\Survey_result();
        // $City_submissionModel=new \App\Models\City_submission();  
        // $remarkModel=new \App\Models\Remark();  
        // $questionModel=new \App\Models\QuestionModel();
        $Question_bookmarkModel=new \App\Models\Question_bookmark();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $qestion_id=trim($this->request->getPost('qb_id'));
        $action=trim($this->request->getPost('action'));
        $chk=$Question_bookmarkModel->where('survey_id ', $qestion_survey)->where('sector_id ', $qestion_sector)->where('qb_id ', $qestion_id)->where('city_id ', $loginUserCity)->first();
        $bookmarkDetail=array(
        'survey_id'=>$qestion_survey,
        'sector_id'=>$qestion_sector,
        'qb_id'=>$qestion_id,
        'city_id'=>$loginUserCity,
        'added_on'=>date('Y-m-d H:i:s')
        );
        //print_data($bookmarkDetail);
        if($action=="add"){
            if(empty($chk)){
                $Question_bookmarkModel->insert($bookmarkDetail);
                $insertedId=$Question_bookmarkModel->getInsertID();
                $response['msg']="Question bookmarked successfully";
                $response['inserted_id']=$insertedId;
                $response['status']=1;
           }else{
                $response['msg']="Question already added in bookmark";
           }
        }else{
            $Question_bookmarkModel->where('survey_id ', $qestion_survey)->where('sector_id ', $qestion_sector)->where('qb_id ', $qestion_id)->where('city_id ', $loginUserCity)->delete();
            $response['msg']="Question removed from bookmark successfully";
            $response['status']=1;
        }
        echo json_encode($response); exit();
    } // End of the function


    public function survey_filter_question(){
        $questionArr=[];
        $get_validation=  \Config\Services::validation();
        $logedInUserDetail=session('admin_detail');
        //print_data($logedInUserDetail);
        $loginUserCity=$logedInUserDetail['City_ID'];
        $db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>'', 'html'=>''];
        $SurveyResultModel=new \App\Models\Survey_result();
        $City_submissionModel=new \App\Models\City_submission();  
        $remarkModel=new \App\Models\Remark();  
        $questionModel=new \App\Models\QuestionModel();
        $Question_bookmarkModel=new \App\Models\Question_bookmark();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $qestion_sector=trim($this->request->getPost('sector_id'));
        $qestion_survey=trim($this->request->getPost('survey_id'));
        $filter=trim($this->request->getPost('getfilter'));
        $data["surveyId"]=$qestion_survey;
        $data["sectorId"]=$qestion_sector;
        //die($filter);
        $data["allQuestion"]=array();
        if(trim($filter)=="bookmark"){
            $getBookMarkQuestions=$Question_bookmarkModel->where('survey_id', $qestion_survey)->where('sector_id', $qestion_sector)->where('city_id', $loginUserCity)->findAll();
            if(!empty($getBookMarkQuestions)){
                foreach($getBookMarkQuestions as $key2=>$get_questionDetail){
                  array_push($questionArr, $get_questionDetail["qb_id"]);
                } 
            }
            //print_r($questionArr);
            //print_data($getBookMarkQuestions);
            if(!empty($questionArr)){
                $data["allQuestion"]=$questionModel->whereIn('QB_ID',$questionArr)->findAll();
            }
           //print_data($data["allQuestion"]);
           $response['html']=view('backend/ajax/survey_filter_question_ajax',$data);
        }else if(trim($filter)=="all"){
            $data["allQuestion"]=$surveyquestionMasterModel->where('Sector_ID', trim($qestion_sector))->where('Survey_ID',trim($qestion_survey))->findAll();
            if(!empty($data["allQuestion"])){
            foreach($data['allQuestion'] as $key=>$questionDetail){
                    $qid=trim($questionDetail["QB_ID"]);
                    $getQuestionMasterDetail=$questionModel->where('QB_ID',$qid)->first();
                    $questionTotalComment=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qid)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',1)->countAllResults();


                    $questionTotalDocument=$remarkModel->where('Survey_ID',$qestion_survey)->where('QB_ID',$qid)->where('City_ID',$loginUserCity)->where('sector_id',$qestion_sector)->where('type',2)->countAllResults();

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
                        $data['allQuestion'][$key]['question_template']="";
                        $data['allQuestion'][$key]['question_placeholder']="";
                        $data['allQuestion'][$key]['question_description']="";
                        $data['allQuestion'][$key]['question_comment']=0;
                        $data['allQuestion'][$key]['question_document']=0;                        
                        $data['allQuestion'][$key]['child_questions']='';
                        $data['allQuestion'][$key]['sub_question']='';
                        $data['allQuestion'][$key]['question_matrix_barcode']='';
                        $data['allQuestion'][$key]['calculation_type']='';
                    }
            }
            }
            //print_data($data["allQuestion"]);
           $response['html']=view('backend/ajax/survey_filter_question_ajax',$data);
           $response["filter"]=trim($filter); 
        }else if(trim($filter)=="completed"){
            $response['html']=view('backend/ajax/survey_filter_question_ajax',$data);
           $response["filter"]=trim($filter); 
        }else if(trim($filter)=="pending"){
            $response['html']=view('backend/ajax/survey_filter_question_ajax',$data);
           $response["filter"]=trim($filter); 
        }
        echo json_encode($response); exit();
    } // End of the function


} // End of the class.
?>