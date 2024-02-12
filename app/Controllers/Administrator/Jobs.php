<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;

class Jobs extends BaseController{

    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }

    public function index(){
        $session = session();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $SurveyResultModel=new \App\Models\Survey_result();
        $citySubmission=new \App\Models\City_submission();
        $Users=new \App\Models\Users();  
        $data['surevyListData'] = $SurveyModel->where('publish_status',2)->orderBy('published_on','DESC')->findAll();
        $data['validaor_1_list'] = $Users->where('role',2)->findAll();
        $data['validaor_2_list'] = $Users->where('role',3)->findAll();
        $getcitiesSubmittedSurevyList = $citySubmission->where('submission_status',1)->orderBy('submission_date','DESC')->findAll();
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
        return view('backend/admin/jobsData',$data);
    }


    public function getSectorListBySurveyId(){
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyResultModel=new \App\Models\Survey_result(); 
        $citySubmission=new \App\Models\City_submission();
        $survey_id = $this->request->getPost('survey_id');
        $sector_id = $this->request->getPost('sector_id');
        $result = getDataToCreateJob($survey_id,$sector_id);
        // print_data($result);
        $data['cityData'] = view('backend/ajax/CreateJobsFilterAjax',$result);
        $data['validatorOneListhtml']=$result['validatorOneListhtml'];
        $data['validatorTwoListhtml']=$result['validatorTwoListhtml'];
        $data['sectorListhtml'] = $result['sectorListhtml'];
        $data['cityListhtml'] = $result['cityListhtml'];        
        echo json_encode($data);
        exit;
    }

    public function saveJobs(){
        $Users=new \App\Models\Users();
        $ValidatorJobCity=new \App\Models\Validator_jobs_cities();
        $cities=array();
        $data=array('status'=>0,'msg'=>'Something went worng');
        $survey_id = $this->request->getPost('survey_id');
        $sector_id = $this->request->getPost('sector_id');
        $city_id = $this->request->getPost('city_id');
        $validator_1 = $this->request->getPost('validator_1');
        $validator_2 = $this->request->getPost('validator_2');

        $logedInUserDetail=session('admin_detail');
        $loginUserId=$logedInUserDetail['user_id'];


        if($survey_id == 0 || $survey_id==''){
            $data=array('status'=>0,'msg'=>'Please select survey');
            echo json_encode($data);
            exit;
        }
        if($sector_id == 0 || $sector_id==''){
            $data=array('status'=>0,'msg'=>'Please select sector');
            echo json_encode($data);
            exit;
        }

        if($city_id==''){
                $data=array('status'=>0,'msg'=>'Please select atleast one city');
                echo json_encode($data);
                exit;
        }else{
            $cities = explode(',',$city_id);
            if(empty($cities)){
                $data=array('status'=>0,'msg'=>'Please select atleast one city');
                echo json_encode($data);
                exit;
            }            
        }
        if($validator_1 == 0 && $validator_1==''){
            $data=array('status'=>0,'msg'=>'Please select validator 1');
            echo json_encode($data);
            exit;
        }
        if($validator_2 == 0 && $validator_2==''){
            $data=array('status'=>0,'msg'=>'Please select validator 2');
            echo json_encode($data);
            exit;
        }
        $jobDataArray=array();
        $jobId = date('ymdHis');
    
        if(!empty($cities)){
            foreach($cities as $key=>$city){
                $cityuserdata = $Users->where('City_ID',$city)->first();
                $validator_one_data = $Users->where('City_ID',$validator_1)->first();
                $validator_two_data = $Users->where('City_ID',$validator_2)->first();
                $dataToAdd=array(
                    'sector_id'=>$sector_id,
                    'city_id'=>$city,
                    'survey_id'=>$survey_id,
                    'status'=>1,
                    'created_on'=>date('Y-m-d H:i:s'),
                    'validator_1_user_id'=>$validator_one_data['user_id'],
                    'validator_2_user_id'=>$validator_two_data['user_id'],
                    'city_user_id'=>$cityuserdata['user_id'],
                    'job_id'=>$jobId,
                    'updated_on'=>date('Y-m-d H:i:s')
                );
                array_push($jobDataArray,$dataToAdd);
            }
        }

        if(!empty($jobDataArray)){
            $res = $ValidatorJobCity->insertBatch($jobDataArray);
        }else{
            $res=[];
        }
        if(!empty($res)){
            $notification = getCityDetailByCity_ID($validator_1);
            if(!empty($notification)){
                $sent_to_user_id = $notification['user_id'];
                saveNotification($survey_id,$loginUserId,$sent_to_user_id,1); 
            }
            $data=array('status'=>1,'msg'=>'Jobs created successfully');
        }else{
            $data=array('status'=>0,'msg'=>'Something went worng');
        }
        echo json_encode($data);
        exit;
    }


}
?>