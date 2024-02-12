<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;

class MyJobs extends BaseController{

    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }

    public function index(){
        $session = session();
        $SurveyResultModel=new \App\Models\Survey_result();
        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();

        $surveyListofJobs = $ValidatorJobCity->select('DISTINCT("survey_id")')->findAll();

        if(!empty($surveyListofJobs)){
            foreach($surveyListofJobs as $sLkey=>$survey){
                $surveyListofJobs[$sLkey]['survey_Name'] = getSurveyName($survey['survey_id']);
            }
        }
        $jobData = $ValidatorJobCity->select('DISTINCT ON("job_id") job_id,created_on,sector_id,survey_id,updated_on')->orderBy('job_id,updated_on','DESC')->findAll();

        if(!empty($jobData)){
            foreach($jobData as $key=>$job){
                $jobData[$key]['created_on'] = date('d-m-Y',strtotime($job['created_on']));
                $jobData[$key]['sector_Name'] = getSectorName($job['sector_id']);
                $jobData[$key]['survey_Name'] = getSurveyName($job['survey_id']);
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
        // print_data($jobData);
        $data['jobDetails'] =$jobData;
        $data['surveyList'] = $surveyListofJobs;
        return view('backend/admin/Myjobs',$data);
    }

    public function jobDataFilterAjax(){
        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();
        $SurveyResultModel=new \App\Models\Survey_result();
        $survey_id = $this->request->getPost('survey_id');
        $sector_id = $this->request->getPost('sector_id');
        $city_id = $this->request->getPost('city_id');
        // $validator_1 = $this->request->getPost('validator_1');
        // $validator_2 = $this->request->getPost('validator_2');

        $sectorDataArray=array();
        $sectorListHtml = '<option value="0">Please select</option>';

        $cityDataArray=array();
        $cityListHtml = '<option value="0">Please select</option>';

        // $validatorOneDataArray=array();
        // $validatorOneListHtml = '<option value="0">Please select</option>';
        // $validatorTwoDataArray=array();
        // $validatorTwoListHtml = '<option value="0">Please select</option>';

        if($survey_id > 0 && $survey_id!=''){
            $ValidatorJobCity->select('DISTINCT ON("job_id") job_id,created_on,sector_id,survey_id,updated_on')->where('survey_id',$survey_id);
            if($sector_id > 0 && $sector_id!=''){
                $ValidatorJobCity->where('sector_id',$sector_id);
            }
            if($city_id > 0 && $city_id!=''){
                $ValidatorJobCity->where('city_id',$city_id);
            }
            // if($validator_1 > 0 && $validator_1!=''){
            //     $ValidatorJobCity->where('validator_1_user_id',$validator_1);
            // }
            // if($validator_2 > 0 && $validator_2!=''){
            //     $ValidatorJobCity->where('validator_2_user_id',$validator_2);
            // }


            $jobData = $ValidatorJobCity->orderBy('job_id, updated_on','DESC')->findAll();
           
            if(!empty($jobData)){
                foreach($jobData as $key=>$job){
                    $jobData[$key]['created_on'] = date('d-m-Y',strtotime($job['created_on']));
                    $jobData[$key]['sector_Name'] = getSectorName($job['sector_id']);
                    $jobData[$key]['survey_Name'] = getSurveyName($job['survey_id']);
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

            $sectorList = $ValidatorJobCity->select('DISTINCT("sector_id")')->where('survey_id',$survey_id)->findAll();
            if(!empty($sectorList)){
                foreach($sectorList as $skey=>$sectr){
                    if($sector_id > 0 && $sector_id!='' && $sectr["sector_id"]==$sector_id){
                        $selected ='selected';
                    }else{
                        $selected='';
                    }
                    $sectorListHtml = $sectorListHtml.'<option value='.$sectr["sector_id"].' '.$selected.'>'.getSectorName($sectr['sector_id']).'</option>';
                }
            }

            $cityList = $ValidatorJobCity->select('DISTINCT("city_id")')->where('survey_id',$survey_id)->findAll();
            if(!empty($cityList)){
                foreach($cityList as $ckey=>$city){
                    if($city_id > 0 && $city_id!='' && $city["city_id"]==$city_id){
                        $selected ='selected';
                    }else{
                        $selected='';
                    }
                    $cityListHtml = $cityListHtml.'<option value='.$city["city_id"].' '.$selected.'>'.getCityNameByCity_id($city["city_id"]).'</option>';
                }
            }

        }else{
            $jobData = $ValidatorJobCity->select('DISTINCT("job_id"),created_on,sector_id,survey_id')->findAll();
            if(!empty($jobData)){
                foreach($jobData as $key=>$job){
                    $jobData[$key]['created_on'] = date('d-m-Y',strtotime($job['created_on']));
                    $jobData[$key]['sector_Name'] = getSectorName($job['sector_id']);
                    $jobData[$key]['survey_Name'] = getSurveyName($job['survey_id']);
                    $jobData[$key]['cityNameArray'] = array();
                    $cityData = $ValidatorJobCity->select('city_id')->where('job_id',$job['job_id'])->findAll();
                    if(!empty($cityData)){
                        foreach($cityData as $ckey=>$city){
                            array_push($jobData[$key]['cityNameArray'],getCityNameByCity_id($city['city_id']));
                        }
                    }
                }
            }
        }


        $data['jobDetails'] =$jobData; 
        $data['jobDetailsHtmlAjax'] = view('backend/ajax/MyJobsAjaxListData',$data);
        $data['sectorListHtml'] =$sectorListHtml; 
        $data['cityListHtml'] =$cityListHtml; 
        // $data['validatorOneListHtml'] =$validatorOneListHtml; 
        // $data['validatorTwoListHtml'] =$validatorTwoListHtml; 
        echo json_encode($data);
    }
    
}
?>