<?php
function print_data( $data = array() ){
    echo "<pre>",htmlspecialchars(print_r($data,true)),"</pre>";exit;
}


function checkseoPage($productId){
    $SeoModel=new \App\Models\Admin\Seo();
    $checkpage=$SeoModel->where('product_id', $productId)->where('is_deleted', 1)->first();
    if(empty($checkpage)){
        return 0;
    }else{
        return 1;
    }
} // End of the function.

function checkseoBlogPage($blogId){
    $SeoModel=new \App\Models\Admin\Seo();
    $checkpage=$SeoModel->where('blog_id', $blogId)->where('is_deleted', 1)->first();
    if(empty($checkpage)){
        return 0;
    }else{
        return 1;
    }
} // End of the function.

function getProductName($productId){
    //die("Product :: ".$productId);
    $ProductModel=new \App\Models\Product();
    $checkpage=$ProductModel->where('product_id', $productId)->where('is_deleted', 1)->first();
    if(!empty($checkpage)){
        echo ucwords($checkpage['product_name']);
    }else{
        echo "--";
    }
} // End of the function.

function getBlogName($blogId){
    //die("Product :: ".$blogId);
    $BlogModel=new \App\Models\Admin\Blog();
    $checkBlog=$BlogModel->where('blog_id', $blogId)->where('is_deleted', 1)->first();
    if(!empty($checkBlog)){
        echo ucwords($checkBlog['title']);
    }else{
        echo "--";
    }
} // End of the function.

function getCategoryName($catId){
    //die("Category :: ".$catId);
    $CategoryModel=new \App\Models\Category();
    $getCategoryName=$CategoryModel->where('category_id', $catId)->where('is_deleted', 1)->first();
    if(!empty($getCategoryName)){
        echo ucwords($getCategoryName['category_name']);
    }else{
        echo "--";
    }
} // End of the function.

function getCategorySlug($catId){
    //die("Category :: ".$catId);
    $CategoryModel=new \App\Models\Category();
    $getCategoryName=$CategoryModel->where('category_id', $catId)->where('is_deleted', 1)->first();
    if(!empty($getCategoryName)){
        return $getCategoryName['category_slug'];
    }else{
        return "--";
    }
} // End of the function.

function getStateName($stateId){
    //die("State :: ".$stateId);
    $StateModel=new \App\Models\State();
    $getstateName=$StateModel->where('state_id', $stateId)->where('status', 1)->first();
    if(!empty($getstateName)){
        return $getstateName['state_title'];
    }else{
        return "";
    }
} // End of the function.

function checkBlogExist($blogId){
    //die("Product :: ".$blogId);
    $BlogModel=new \App\Models\Admin\Blog();
    $checkBlog=$BlogModel->where('blog_id', $blogId)->where('is_deleted', 1)->first();
    if(empty($checkBlog)){
        return 0;
    }else{
        return 1;
    }
} // End of the function.


function checkProductExist($productId){
    //die("Product :: ".$productId);
    $ProductModel=new \App\Models\Product();
    $checkpage=$ProductModel->where('product_id', $productId)->where('is_deleted', 1)->first();
    if(empty($checkpage)){
        return 0;
    }else{
        return 1;
    }
} // End of the function.


function getPopularSearch(){
    $SearchModel=new \App\Models\Search();
    $popularSearch=$SearchModel->select('search_keyword,count(search_keyword) as total')->where('status',1)->groupBy('search_keyword')->orderBy('total', 'DESC')->findAll(4);
    //print_data($popularSearch); 
    return $popularSearch;   
} // End of the function.

function getProductDetailSimilarProducts($productId,$productCategory){
    $ProductModel=new \App\Models\Product();
    $allProduct=$ProductModel->where('is_deleted', 1)->where('category_id', $productCategory)->where('product_id !=', $productId)->findAll();    
    return $allProduct;
}


function sandgrid_email($data){
    ob_start();
    $url= base_url('sand_grid/sendmail.php');
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
    $res=curl_exec($handle); 
    //echo $res; exit;
    //$info = curl_getinfo($handle);
    //echo "<pre>";print_r($info);exit;
    curl_close($handle);
    ob_clean();
    ob_end_clean();
    return $res;    
}


function getSectorName($sectorId){
    $SectorModel=new \App\Models\SectorModel();
    $getSectorName=$SectorModel->where('Sector_ID', $sectorId)->first();
    if(!empty($getSectorName)){
        return $getSectorName['Sector'];
    }else{
        return "";
    }
} // End of the function.

function getFrameworkName($frameworkId){
    $frameworkModel = new \App\Models\Admin\Framework();
    $getFrameworkName=$frameworkModel->where('Framework_ID', $frameworkId)->first();
    if(!empty($getFrameworkName)){
        return $getFrameworkName['Framework'];
    }else{
        return "";
    }
} // End of the function.

function getFrameworkDetail($frameworkId){
    $frameworkModel = new \App\Models\Admin\Framework();
    $getFrameworkData=$frameworkModel->where('Framework_ID', $frameworkId)->first();
    return $getFrameworkData;
} // End of the function.

function getQuestionUnitOfMeasurement($uId){
    $uomModel=new \App\Models\Uom();
    $getData=$uomModel->where('UOM_ID', $uId)->first();
    return $getData;
} // End of the function.



function checkQuestionStatus($survey_ID,$qb_ID){
    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $data = $surveyquestionMasterModel->where('Survey_ID',$survey_ID)->where('QB_ID',$qb_ID)->first();
    if(!empty($data)){
        return 1;
    }else{
        return 0;
    }   
}


function getQuestionAllOptions($qbid){
    $UomOptionModel=new \App\Models\Uom_option();
    $options=$UomOptionModel->where('qb_id',$qbid)->findAll();
    return $options;
} // End of the function

function getSectorTotalAnswered($survey_id,$sid,$loginUserCity){
    $SurveyResultModel=new \App\Models\Survey_result();
    $answeredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey_id)->where('sector_id',$sid)->where('City_ID',$loginUserCity)->where('Value !=',"")->countAllResults();
    return $answeredQuestions;
} // End of the function.


function getSurveySubmissionStatus($survey_id,$loginUserCity){
    $City_submissionModel=new \App\Models\City_submission();
    $chk=$City_submissionModel->where('Survey_ID',$survey_id)->where('City_ID',$loginUserCity)->first();
    return $chk;
} // End of the function.


function getAnswer($surveyId,$sectorId,$qbId,$loginUserCity, $parent_qbid=0,$parent_option=''){
    $SurveyResultModel=new \App\Models\Survey_result();
   $SurveyResultModel->where('Survey_ID',$surveyId)->where('City_ID',$loginUserCity)->where('QB_ID',$qbId)->where('sector_id',$sectorId);
   if($parent_qbid > 0){
        $SurveyResultModel->where('parent_qb_id',$parent_qbid);
   }
   if($parent_option !='' ){
        $SurveyResultModel->where('parent_option',$parent_option);
   }
    $getData=$SurveyResultModel->first();
    return $getData;
} // End of the function.

function checkBookmark($surveyId,$sectorId,$qbId,$loginUserCity){
    $Question_bookmarkModel=new \App\Models\Question_bookmark();
    $getData=$Question_bookmarkModel->where('survey_id',$surveyId)->where('city_id',$loginUserCity)->where('qb_id',$qbId)->where('sector_id',$sectorId)->first();
    return $getData;
} // End of the function.




function getUOMName($uId){
    if($uId > 0){
    $uomModel=new \App\Models\Uom();
    $getData=$uomModel->where('UOM_ID', $uId)->first();
    return $getData['UOM'];
    }else{
        return '';
    }
}

function getSurveyName($sId){
    if($sId > 0){
    $SurveyModel = new \App\Models\SurveyModel();
    $getData=$SurveyModel->where('Survey_ID', $sId)->first();
    return $getData['Survey_Name'];
    }else{
        return '';
    }
}

function getCityNameByUserId($user_id){
    if($user_id > 0){
    $Users=new \App\Models\Users();
    $getData=$Users->where('user_id', $user_id)->first();
    return $getData['City'];
    }else{
        return '';
    }
}

function getCityDetailByCity_ID($City_ID){
    if($City_ID > 0){
    $Users=new \App\Models\Users();
    $getData=$Users->where('City_ID', $City_ID)->first();
        return $getData;
    }else{
        return [];
    }
}

function getCityNameByCity_id($city_id){
    if($city_id > 0){
    $Users=new \App\Models\Users();
    $getData=$Users->where('City_ID', $city_id)->first();
    return $getData['City'];
    }else{
        return '';
    }
}


function getDataToCreateJob($survey_id=0,$sectorId=0){

    $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    $SectorModel=new \App\Models\SectorModel();
    $SurveyResultModel=new \App\Models\Survey_result(); 
    $citySubmission=new \App\Models\City_submission();
    $Users=new \App\Models\Users();
    $UsersSector=new \App\Models\Validator_sector();
    $sectorListhtml ='<option value="0">Please select</option>';
    $cityListhtml ='';
    $validatorOneListhtml ='<option value="0">Please select</option>';
    $validatorTwoListhtml ='<option value="0">Please select</option>';
    if($survey_id > 0){

            $getcitiesSubmittedSurevyList = $citySubmission->where('submission_status',1)->where('Survey_ID',$survey_id)->findAll();

            foreach($getcitiesSubmittedSurevyList as $cskey=>$submissionDetail){

                if($sectorId>0 && $sectorId!='' && isJobsCreated($submissionDetail['Survey_ID'],$sectorId,$submissionDetail['City_ID'])){

                    unset($getcitiesSubmittedSurevyList[$cskey]);

                }

            }

            $sectorListOfSurvey = $surveyquestionMasterModel->select('DISTINCT("Sector_ID")')->where('Survey_ID',$survey_id)->findAll();

                if(!empty($sectorListOfSurvey)){

                    foreach($sectorListOfSurvey as $slsKey=>$sector_id){

                        $sectorName = $SectorModel->where('Sector_ID',$sector_id['Sector_ID'])->first();

                        if(!empty($sectorName)){

                            $sectorListOfSurvey[$slsKey]['Sector'] = $sectorName['Sector'];

                        }else{

                            $sectorListOfSurvey[$slsKey]['Sector'] = 'N/A';

                        }
                        if($sectorId > 0 && $sectorId!='' && $sector_id['Sector_ID']== $sectorId){

                            $selected='selected';

                        }else{

                            $selected='';

                        }

                        $sectorListhtml = $sectorListhtml."<option value=".$sector_id['Sector_ID']." ".$selected.">".$sectorName['Sector']."</option>";
                    }
                }
            if(!empty($getcitiesSubmittedSurevyList)){

                foreach($getcitiesSubmittedSurevyList as $cskey=>$submissionDetail){

                    $getcitiesSubmittedSurevyList[$cskey]['sectorList'] = array();

                    $cityNameDeatils = $Users->select('City')->where('City_ID',$submissionDetail['City_ID'])->first();

                    $cityListhtml = $cityListhtml."<option value=".$submissionDetail['City_ID'].">".$cityNameDeatils['City']."</option>";

                    $getcitiesSubmittedSurevyList[$cskey]['City'] = $cityNameDeatils['City'];

                    $getcitiesSubmittedSurevyList[$cskey]['Survey_Name'] = getSurveyName($submissionDetail['Survey_ID']);

                    $getcitiesSubmittedSurevyList[$cskey]['sectorList'] = $sectorListOfSurvey;

                }
            }
            $data['surveyDetails'] = $getcitiesSubmittedSurevyList;

            $data['sectorListhtml'] = $sectorListhtml;

            $data['cityListhtml'] = $cityListhtml;

    }else{
        $getcitiesSubmittedSurevyList = $citySubmission->where('submission_status',1)->findAll();

        if(!empty($getcitiesSubmittedSurevyList)){

            foreach($getcitiesSubmittedSurevyList as $cskey=>$submissionDetail){

                $getcitiesSubmittedSurevyList[$cskey]['sectorList'] = array();

                $cityNameDeatils = $Users->select('City')->where('City_ID',$submissionDetail['City_ID'])->first();

                $sectorListOfSurvey = $surveyquestionMasterModel->select('DISTINCT("Sector_ID")')->where('Survey_ID',$submissionDetail['Survey_ID'])->findAll();

                $getcitiesSubmittedSurevyList[$cskey]['City'] = $cityNameDeatils['City'];

                $getcitiesSubmittedSurevyList[$cskey]['Survey_Name'] = getSurveyName($submissionDetail['Survey_ID']);

                if(!empty($sectorListOfSurvey)){

                    foreach($sectorListOfSurvey as $slsKey=>$sector_id){

                        $sectorName = $SectorModel->where('Sector_ID',$sector_id['Sector_ID'])->first();

                        if(!empty($sectorName)){

                            $sectorListOfSurvey[$slsKey]['Sector'] = $sectorName['Sector'];

                        }else{

                            $sectorListOfSurvey[$slsKey]['Sector'] = 'N/A';

                        }
                    }
                }
                $getcitiesSubmittedSurevyList[$cskey]['sectorList'] = $sectorListOfSurvey;
            }
        }
        $data['surveyDetails'] = $getcitiesSubmittedSurevyList;

        $data['sectorListhtml'] = $sectorListhtml;
        
        $data['cityListhtml'] = $cityListhtml;
    }
    if($sectorId > 0 && $sectorId!=''){
        $validatores = $UsersSector->where('sector_id',$sectorId)->findAll();
        if(!empty($validatores)){
            foreach($validatores as $vkey=>$validator){
                $validatorone = $Users->where('role',2)->where('user_id',$validator['user_id'])->first();
                if(!empty($validatorone)){
                    $validatorOneListhtml=$validatorOneListhtml."<option value=".$validatorone['City_ID'].">".$validatorone['City']."</option>";
                }
                $validatortwo = $Users->where('role',3)->where('user_id',$validator['user_id'])->first();
                if(!empty($validatortwo)){
                    $validatorTwoListhtml = $validatorTwoListhtml."<option value=".$validatortwo['City_ID'].">".$validatortwo['City']."</option>";
                }
            }
        }
        $data['validatorOneListhtml']=$validatorOneListhtml;
        $data['validatorTwoListhtml']=$validatorTwoListhtml;
    }else{
        $validatorone = $Users->where('role',2)->findAll();
        $validatortne = $Users->where('role',3)->findAll();
        if(!empty($validatorone)){
          foreach($validatorone as $vkey=>$vOne){
            $validatorOneListhtml=$validatorOneListhtml."<option value=".$vOne['City_ID'].">".$vOne['City']."</option>";
          }
        }
        if(!empty($validatortne)){
          foreach($validatortne as $vkey=>$vTwo){
            $validatorTwoListhtml = $validatorTwoListhtml."<option value=".$vTwo['City_ID'].">".$vTwo['City']."</option>";
          }
        }
        $data['validatorOneListhtml']=$validatorOneListhtml;
        $data['validatorTwoListhtml']=$validatorTwoListhtml;
    }

    return $data;
}



function isJobsCreated($survey_id=0,$sector_id=0,$city_id=0){

    $ValidatorJobCity=new \App\Models\Validator_jobs_cities();

    $getJobData = $ValidatorJobCity->where('survey_id',$survey_id)->where('sector_id',$sector_id)->where('city_id',$city_id)->first();

    if(!empty($getJobData)){
        return 1;
    }else{
        return 0;
    }

}


 function getSurveySectorQuestions($surveyId,$sectorId){
   $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel(); 
   $totalQuestions = $surveyquestionMasterModel->where('Survey_ID',$surveyId)->where('Sector_ID',$sectorId)->orderBy('sort_order','ASC')->findAll();
   return $totalQuestions;
 }


 function checkValidatorPriorityCity($jobId,$survey,$validator,$city){
    $validatorPriorityCity=new \App\Models\Validator_priority_city();
    $getData=$validatorPriorityCity->where('job_id',$jobId)->where('survey_id',$survey)->where('city_id',$city)->where('validator_user_id',$validator)->countAllResults();
    return $getData;
 }


 function getSurveySectorQuestions222($survey,$sector){
  $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
  $allQuestion=$surveyquestionMasterModel->where('Sector_ID', $sector)->where('Survey_ID',$survey)->countAllResults();
  return $allQuestion;  
 }



 function getCityAttemptedQuestions($survey,$sector,$city){
    $SurveyResultModel=new \App\Models\Survey_result();
    $AnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$city)->where('Value !=',"")->countAllResults();
    return $AnsweredQuestions;
 }

 function checkValidatorBookmark($surveyId,$sectorId,$qbId,$getcityUserId,$loginUserId){
    $ValidatorBookmarkQuestionModel=new \App\Models\Validator_bookmark_question();
    $getData=$ValidatorBookmarkQuestionModel->where('survey_id',$surveyId)->where('sector_id',$sectorId)->where('qb_id',$qbId)->where('validator_user_id',$loginUserId)->where('city_user_id',$getcityUserId)->first();
    return $getData;
 }

  function getValidatedQuestionsInSector($survey,$sector,$city,$i){
    $SurveyResultModel=new \App\Models\Survey_result();
    //$status=array("");
    $getAll=$SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$survey)->where('sector_id',$sector)->where('City_ID',$city)->whereIn('validator_'.$i.'_status',['1','2','3'])->countAllResults();
    return $getAll;
 }


 function getCityRemarksAndDocumentDetail($survey_id,$sector_id,$qbId,$city_id){
    $Remark=new \App\Models\Remark();
    $res = $Remark->where('Survey_ID',$survey_id)->where('sector_id',$sector_id)->where('QB_ID',$qbId)->where('City_ID',$city_id)->first();

    if(!empty($res)){
        $data = $res;
    }else{
        $data = [];
    }
    return $data;
 }


 function getQuestionDetail($qbid){
    $questionModel=new \App\Models\QuestionModel();
    $detail = $questionModel->where('QB_ID',$qbid)->first();
    return $detail;
 }

 function saveNotification($surveyId,$sent_by_user_id,$sent_to_user_id,$action_taken,$revert_cycle=0){
    $notification=new \App\Models\Notification();
    $msg = '';

    $surveyName = getSurveyName($surveyId);

    $cityName = getCityNameByUserId($sent_by_user_id);

    $addCycleInMsg='';
    if($revert_cycle > 0){
        $addCycleInMsg = 'for cycle '.$revert_cycle;
    }
    if($action_taken == 1){
        $msg = 'A new job has been assigned in '.$surveyName ;
    }else if($action_taken == 2){
        $msg = 'A new job has been sent by v1 '.$surveyName ;
    }else if($action_taken == 3){
        $msg = 'Validator 2 has reverted a few questions to cities in '.$surveyName ;
    }else if($action_taken == 4){
        $msg = $cityName.' has reverted on few questions in '.$surveyName.' '.$addCycleInMsg ;
    }else if($action_taken == 5){
        $msg = 'V1 has validated and resent jobs in '.$surveyName.' '.$addCycleInMsg ;
    }
    $notificationData = array(
        'Survey_ID'=>$surveyId,
        'msg'=>$msg,
        'created_on'=>date('Y-m-d H:i:s'),
        'sent_by_user_id'=>$sent_by_user_id,
        'sent_to_user_id'=>$sent_to_user_id,
        'action_taken'=>$action_taken
    );
    $res = $notification->insert($notificationData);
    return $res;
 }


 function getNotification($loggedInUser){
    $notification=new \App\Models\Notification();
    $res = $notification->where('sent_to_user_id',$loggedInUser)->where('is_read',0)->orderBy('notification_id','desc')->findAll();
    return $res;
 }

 function markAsReadNotification($loggedInUser){
    $notification=new \App\Models\Notification();
    $res = $notification->set('is_read',1)->where('sent_to_user_id',$loggedInUser)->update();
    return $res;
 }
 
?>

