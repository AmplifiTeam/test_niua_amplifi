<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;
class AdminCityStatus extends BaseController{
    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }
    public function index(){
    	$SurveyModel = new \App\Models\SurveyModel();
        $data['surveyList'] = $SurveyModel->where('publish_status',2)->orderBy('published_on','DESC')->findAll();
        return view('backend/admin/AdminCityStatus',$data);
    }

    public function getSurveyCityListData(){
    	$surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $SurveyResultModel=new \App\Models\Survey_result();
        $citySubmission=new \App\Models\City_submission();
        $Users=new \App\Models\Users();
    	$survey_id = $this->request->getPost('survey_id');
    	$cityList['cityList'] = $Users->where('role',4)->findAll();
        // print_data($cityList['cityList']);

        $surveyAllQuestions = $surveyquestionMasterModel->where("Survey_ID",$survey_id)->countAllResults();
        
        if(!empty($cityList['cityList'])){
            foreach($cityList['cityList'] as $ckey=>$city){
                
                $surveyAllAnsweredQuestions=$SurveyResultModel->where('parent_qb_id',0)->where("Survey_ID",$survey_id)->where("City_ID",$city['City_ID'])->where("Value !=","")->countAllResults();

                // $submissionData = $citySubmission->where('Survey_ID',$survey_id)->where('City_ID',$city['City_ID'])->first();
                // if(!empty($submissionData)){
                //     $cityList['cityList'][$ckey]['is_submitted'] = "Submitted";
                // }else{
                //     $cityList['cityList'][$ckey]['is_submitted'] = "Not submitted";
                // }
                
                $cityList['cityList'][$ckey]['surveyAnsweredQuest'] = $surveyAllAnsweredQuestions;
                $cityList['cityList'][$ckey]['surveyAllQuestions'] = $surveyAllQuestions;
            }
        }
    	$data['cityListHtml'] = view('backend/ajax/AdminCityStatusAjax',$cityList);

    	echo json_encode($data);
    	exit;
    }

    public function validators_status_on_city(){

        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $SurveyResultModel=new \App\Models\Survey_result();
        $UsersModel=new \App\Models\Users();
        $questionModel=new \App\Models\QuestionModel();
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $jobId=$geturi[2];

        $jobData = $ValidatorJobCity->where('job_id',$jobId)->first();
       
        if(!empty($jobData)){
            $jobData['v1_name'] = getCityNameByUserId($jobData['validator_1_user_id']);
            $jobData['v2_name'] = getCityNameByUserId($jobData['validator_2_user_id']);
        }else{
            $jobData['v1_name'] = '';
            $jobData['v2_name'] = '';
        }

        $cityListData = $ValidatorJobCity->where('job_id',$jobId)->findAll();

        if(!empty($cityListData)){
            foreach($cityListData as $clkey=>$cityData){
                // print_data($cityData);
                $cityName = getCityNameByCity_id($cityData['city_id']);
                $cityListData[$clkey]['city_Name'] = $cityName;

                $sectorName = getSectorName($cityData['sector_id']);
                $cityListData[$clkey]['sector_Name'] = $sectorName;

                        $questionList = $surveyquestionMasterModel->where('Survey_ID',$cityData['survey_id'])->where('Sector_ID',$cityData['sector_id'])->findAll();

                        $revertToCityByV1 = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('validator_1_status',3)->countAllResults();
                        $rejectedByV1 = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('validator_1_status',2)->countAllResults();
                        $approvedByV1 = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('validator_1_status',1)->countAllResults();

                        $revertToCityByV2 = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('validator_2_status',3)->countAllResults();
                        $rejectedByV2 = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('validator_2_status',2)->countAllResults();
                        $approvedByV2 = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('validator_2_status',1)->countAllResults();



                        $allQuestionCount = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->countAllResults();

                            $cityListData[$clkey]['revertToCityByV1']=$revertToCityByV1;
                            $cityListData[$clkey]['rejectedByV1']=$rejectedByV1;
                            $cityListData[$clkey]['approvedByV1']=$approvedByV1;
                            $cityListData[$clkey]['revertToCityByV2']=$revertToCityByV2;
                            $cityListData[$clkey]['rejectedByV2']=$rejectedByV2;
                            $cityListData[$clkey]['approvedByV2']=$approvedByV2;
                            $cityListData[$clkey]['allQuestionCount']=$allQuestionCount;

                if(!empty($questionList)){
                    foreach($questionList as $Qkey=>$questionData){
                        $resultDetails = $SurveyResultModel->where('parent_qb_id',0)->where('Survey_ID',$cityData['survey_id'])->where('sector_id',$cityData['sector_id'])->where('City_ID',$cityData['city_id'])->where('QB_ID',$questionData['QB_ID'])->first();
                            $questionList[$Qkey]['Value']=$resultDetails['Value'];
                            $questionList[$Qkey]['validator_1_status']=$resultDetails['validator_1_status'];
                            $questionList[$Qkey]['validator_2_status']=$resultDetails['validator_2_status'];

                            $Qdata = $questionModel->where('QB_ID',$questionData['QB_ID'])->first();
                            $questionList[$Qkey]['question_placeholder'] = $Qdata['question_placeholder'];
                            $questionList[$Qkey]['child_questions'] = $Qdata['child_questions'];
                            $questionList[$Qkey]['sub_question'] = $Qdata['sub_question'];
                            $questionList[$Qkey]['question_matrix_barcode'] = $Qdata['question_matrix_barcode'];
                            $questionList[$Qkey]['calculation_type'] = $Qdata['calculation_type'];
                    }
                    $cityListData[$clkey]['questionList'] = $questionList;
                }
            }
        }else{
            return redirect()->to('admin/myjobs');
        }
        // print_data($cityListData);

        $data['cityListData']=$cityListData;
        $data['jobData'] = $jobData;
        return view('backend/admin/ValidatorProgressStatus',$data);
    }


    
}
?>