<?php
namespace App\Controllers\Administrator;
use App\Controllers\BaseController;
class QuestionMaster extends BaseController{

    public  function __construct(){
        helper(['form', 'url', 'text']);
        helper("app");
        $this->db=db_connect();
    }

    public function index(){
        /* Check Valid User */
        $getLogedInUserDetail=session('admin_detail');
        $getLoginUserRole=$getLogedInUserDetail['role'];
        if($getLoginUserRole!=5){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        $child_question_options="";
    	$questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $uomModel = new \App\Models\Uom();
        $frameworkModel = new \App\Models\Admin\Framework();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $data['allframework']=$frameworkModel->orderBy('Framework')->findall();
        //print_data($data['allframework']);
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $data['allinputs']=$uomModel->orderBy('UOM')->orderBy('UOM')->findall();
    	$logedInUserDetail=session('admin_detail');
    	if($logedInUserDetail['role']!=5){
    		$url=base_url()."admin/dashboard";
            header("Location: $url"); exit();
    	}
        $data['child_questions']=$questionModel->where('is_child_question','yes')->orderBy('QB_ID','DESC')->findAll();
        //print_data($data["child_questions"]);

        if(!empty($data["child_questions"])){
            foreach($data["child_questions"] as $key=>$value) {
                $child_question_options.="<option value='".$value['QB_ID']."' onclick='addChildQuestionToList(".$value['QB_ID'].")'>".$value['Description']."</option>";
            }
        }
        $data['all_child_question_options']=$child_question_options;
        //print_data($data['all_child_question_options']);
    	return view('backend/question_bank/create_question',$data);
    } // End of the function.

    
    public function all_question(){
        /* Check Valid User */
        $getLogedInUserDetail=session('admin_detail');
        $getLoginUserRole=$getLogedInUserDetail['role'];
        if($getLoginUserRole!=5){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        $UomOptionModel=new \App\Models\Uom_option();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $uomModel = new \App\Models\Uom();
        $frameworkModel = new \App\Models\Admin\Framework();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    	$logedInUserDetail=session('admin_detail');
    	if($logedInUserDetail['role']!=5){
    		$url=base_url()."admin/dashboard";
            header("Location: $url"); exit();
    	}
        $data["allquestions"]=$questionModel->where('created_at !=',NULL)->orderBy('QB_ID','DESC')->findAll();
        //print_data($data["allquestions"]);
    	return view('backend/question_bank/question_list',$data);
    } // End of the function.

    public function save_question(){
        /* Check Valid User */
        $getLogedInUserDetail=session('admin_detail');
        $getLoginUserRole=$getLogedInUserDetail['role'];
        if($getLoginUserRole!=5){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
        //die("Fine here...");
        $CalculatedSubQuest=[]; 
        $subQuest=[];
        $get_questionMatrixFileRandomName="";
        $get_barcodeFileRandomName="";   	
    	$UomOptionModel=new \App\Models\Uom_option();
    	$questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $uomModel = new \App\Models\Uom();
        $frameworkModel = new \App\Models\Admin\Framework();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
    	$db= \Config\Database::connect(); 
        $response=['status'=>0, 'msg'=>''];
        $allOptions=array();
        $qestion_sector = (int)$this->request->getPost('qestion_sector');
        $qestion_framework = trim($this->request->getPost('qestion_framework'));
        $question_title = trim($this->request->getPost('question_title'));
        $question_note = trim($this->request->getPost('question_note'));
        $question_instruction = trim($this->request->getPost('question_instruction'));
        $inputTypeSelector = trim($this->request->getPost('inputTypeSelector'));
        $question_placeholder = trim($this->request->getPost('question_placeholder'));
        $fileUploadconcent = $this->request->getPost('fileUploadconcent');
        // $template = $this->request->getFile('template');
        $qestion_year=trim($this->request->getPost('question_year'));
        $qestion_source=trim($this->request->getPost('question_source'));
        $question_supporting_document=trim($this->request->getPost('question_supporting_document'));
        $questionTypeSelection=trim($this->request->getPost('questionTypeSelection'));
        // print_data($this->request->getPost());    

        if($questionTypeSelection=="yes"){
           $fileUploadconcent=0; 
        }        
       $get_template='';
       if($inputTypeSelector==30){
        $template = $this->request->getFile('template');
        $get_template = $template->getRandomName();
       }
       
      
        $saveotherId=$qestion_framework;    
        // print_r($get_template);die;
        /*################Validation#################*/
        if(empty($qestion_sector)){
            $errorMsg['fieldName'] = 'qestion_sector';
            $errorMsg['errorMsgFieldName'] = 'err_qestion_sector';
            $errorMsg['errorMsg'] = "Please select a sector!";
            $response['validation'] = $errorMsg;
            echo json_encode($response);
            exit();
        }

        if(empty($qestion_framework)){
            $errorMsg['fieldName'] = 'qestion_framework';
            $errorMsg['errorMsgFieldName'] = 'err_qestion_framework';
            $errorMsg['errorMsg'] = "Please select a framework!";
            $response['validation'] = $errorMsg;
            echo json_encode($response);
            exit();
        }

        if(empty($question_title)){
            $errorMsg['fieldName'] = 'question_title';
            $errorMsg['errorMsgFieldName'] = 'err_question_title';
            $errorMsg['errorMsg'] = "Please enter question!";
            $response['validation'] = $errorMsg;
            echo json_encode($response);
            exit();
        }

        if(empty($inputTypeSelector)){
            $errorMsg['fieldName'] = 'inputTypeSelector';
            $errorMsg['errorMsgFieldName'] = 'err_inputTypeSelector';
            $errorMsg['errorMsg'] = "Please select a type!";
            $response['validation'] = $errorMsg;
            echo json_encode($response);
            exit();
        }
        /*####################### Question Already Exists ##############################*/
        if ($qestion_framework != 'Others') {
            $scheckQuestion=$questionModel->where('framework_id', $qestion_framework)->where('Sector_ID', $qestion_sector)->where('UOM_ID', $inputTypeSelector)->where('Description', $question_title)->first();
            if(!empty($scheckQuestion)) {
                $errorMsg['fieldName'] = 'question_title';
                $errorMsg['errorMsgFieldName'] = 'err_question_title';
                $errorMsg['errorMsg'] = "Question already exists!";
                $response['validation'] = $errorMsg;
                echo json_encode($response);
                exit();
            }
        }else{
            $other_framework = $this->request->getPost('other');
            $scheckFramework=$frameworkModel->where('Framework', $other_framework)->first();
            if(!empty($scheckFramework)) {
                $errorMsg['fieldName'] = 'qestion_framework';
                $errorMsg['errorMsgFieldName'] = 'err_qestion_framework';
                $errorMsg['errorMsg'] = "Framework already exists!";
                $response['validation'] = $errorMsg;
                echo json_encode($response);
                exit();
            }
        }

        if($inputTypeSelector==39){            
            $get_barcode_file=$this->request->getFile('barcode_file');
            if($get_barcode_file==""){
                $errorMsg['fieldName']='barcode_file';
                $errorMsg['errorMsgFieldName']='err_barcode_file';
                $errorMsg['errorMsg']="Please select a file!";
                $response['validation']=$errorMsg;
                $response["status"]=2;
                echo json_encode($response);
                exit();
            }
            $barcodeFileExt=$get_barcode_file->getClientExtension();
            $get_barcodeFileRandomName=$get_barcode_file->getRandomName();
            //echo $barcodeFileExt;
            if($barcodeFileExt!="pdf" && $barcodeFileExt!="png" && $barcodeFileExt!="jpg" && $barcodeFileExt!="jpeg"){
                $errorMsg['fieldName']='barcode_file';
                $errorMsg['errorMsgFieldName']='err_barcode_file';
                $errorMsg['errorMsg']="Only pdf,png,jpg & jpeg file allowded!";
                $response['validation']=$errorMsg;
                $response["status"]=2;
                echo json_encode($response);
                exit();
            }
            //Upload...
            $get_barcode_file->move('assets/uploads/', $get_barcodeFileRandomName);
        }


        if($inputTypeSelector==41){            
            $getQuestion_matrix_file=$this->request->getFile('question_matrix_file');            
            if($getQuestion_matrix_file==""){
                    $errorMsg['fieldName']='question_matrix_file';
                    $errorMsg['errorMsgFieldName']='err_question_matrix_file';
                    $errorMsg['errorMsg']="Please select a excel file!";
                    $response['validation']=$errorMsg;
                    $response["status"]=2;
                    echo json_encode($response);
                    exit();
            }
            $questionMatrixFileExt=$getQuestion_matrix_file->getClientExtension();
            $get_questionMatrixFileRandomName=$getQuestion_matrix_file->getRandomName();
            //echo $questionMatrixFileExt;

            if($questionMatrixFileExt!="xls" && $questionMatrixFileExt!="xlsx"){
                    $errorMsg['fieldName']='question_matrix_file';
                    $errorMsg['errorMsgFieldName']='err_question_matrix_file';
                    $errorMsg['errorMsg']="Only excel file allowded!";
                    $response['validation']=$errorMsg;
                    $response["status"]=2;
                    echo json_encode($response);
                    exit();
            }
            //Upload...
            $getQuestion_matrix_file->move('assets/uploads/', $get_questionMatrixFileRandomName);
        }

        //die("Fine here input41");

        if($inputTypeSelector==42){
            $SameChildQuestionArr=[];
            $ParentChildQuestionArr=array();
                $ParentChildQuestionOption=$this->request->getPost('ParentChildQuestionOption');
                //print_data($ParentChildQuestionOption);
                if(!empty($ParentChildQuestionOption)){
                    foreach($ParentChildQuestionOption as $key23=>$getParentChildQuestionOptions){
                        if($getParentChildQuestionOptions==""){
                                $errorMsg['fieldName']='';
                                $errorMsg['errorMsgFieldName']='more_ParentChildQuestion_row_err';
                                $errorMsg['errorMsg']="Please enter an option!";
                                $response['validation']=$errorMsg;
                                $response["status"]=2;
                                echo json_encode($response);
                                exit();
                        }
                        $oname="option_".$key23."_child_question";
                        $optQues=trim($this->request->getPost($oname));
                        /* New condition */
                        if($optQues!=""){
                          $makeOptionQuestionArr=explode(',',$optQues);
                          if(!empty($makeOptionQuestionArr)){
                            foreach($makeOptionQuestionArr as $makeOptionQuestionArrkey=>$makeOptionQuestionArrValue){
                                if(!in_array($makeOptionQuestionArrValue, $SameChildQuestionArr)){
                                   array_push($SameChildQuestionArr,$makeOptionQuestionArrValue);
                                }else{
                                    $errorMsg['errorMsg']="Same child question can not added in multiple options!";
                                    $response['validation']=$errorMsg;
                                    $response["status"]=2;
                                    echo json_encode($response);
                                    exit();                                   
                                }
                            }
                          }                          
                        }
                        /* End New condition */
                        if($optQues!=""){
                            $ParentChildQuestionArr[$getParentChildQuestionOptions]=explode(',',$optQues);
                        }else{
                            $ParentChildQuestionArr[$getParentChildQuestionOptions]=[];
                        }
                    }
                    //print_data($ParentChildQuestionArr);
                    $jsonChildQuestions=json_encode($ParentChildQuestionArr);
                }
                 
        }
        //print_data($SameChildQuestionArr);

        if($inputTypeSelector==43){            
            $sub_questionList=$this->request->getPost('sub_question');
            if($sub_questionList==""){
                $errorMsg['fieldName']='SubQuestionList';
                $errorMsg['errorMsgFieldName']='err_SubQuestionList';
                $errorMsg['errorMsg']="Please select atleast one question!";
                $response['validation']=$errorMsg;
                $response["status"]=2;
                echo json_encode($response);
                exit();
            }else{
               $subQuest=explode(',',$sub_questionList); 
            }
            //print_r($subQuest);
        }        
        //echo $jsonChildQuestions;
        //print_data($jsonChildQuestions);
        //print_data($_POST);
        //die("Fine here...");
        
        if($inputTypeSelector==44){            
            $CalculatedQuestionOption=trim($this->request->getPost('CalculatedQuestionOption'));
            $CalculatedQuestionList=$this->request->getPost('calculated_sub_question');            
            if($CalculatedQuestionList==""){
                $errorMsg['fieldName']='CalculatedQuestionList';
                $errorMsg['errorMsgFieldName']='err_CalculatedQuestionList';
                $errorMsg['errorMsg']="Please select atleast one question!";
                $response['validation']=$errorMsg;
                $response["status"]=2;
                echo json_encode($response);
                exit();
            }else{
               $CalculatedSubQuest=explode(',',$CalculatedQuestionList);
               //print_data(count($CalculatedSubQuest));
               if(count($CalculatedSubQuest)!=2){
                    $errorMsg['fieldName']='CalculatedQuestionList';
                    $errorMsg['errorMsgFieldName']='err_CalculatedQuestionList';
                    $errorMsg['errorMsg']="Please select only two question!";
                    $response['validation']=$errorMsg;
                    $response["status"]=2;
                    echo json_encode($response);
                    exit();
               }
               //Check UOM
               if(!empty($CalculatedSubQuest)){
                foreach($CalculatedSubQuest as $calculatedQueskey => $calculatedQuesValue) {
                    $getQuestionIds=trim($calculatedQuesValue);
                    $getSingleQuestionDetail=getQuestionDetail($calculatedQuesValue);
                    if($getSingleQuestionDetail["UOM_ID"]!=1){
                        $errorMsg['fieldName']='CalculatedQuestionList';
                        $errorMsg['errorMsgFieldName']='err_CalculatedQuestionList';
                        $errorMsg['errorMsg']="Please select only number(Integer) type question!";
                        $response['validation']=$errorMsg;
                        $response["status"]=2;
                        echo json_encode($response);
                        exit();
                    }
                }
               } 
            }
        }
        $getMaxQbid=$questionModel->select('max("QB_ID") AS qid')->first();
        //echo $getMaxQbid["qid"]+1;
        //print_data($getMaxQbid);
        $qbid=$getMaxQbid["qid"]+1;
        if ($qestion_framework == 'Others') {
            $other_framework = $this->request->getPost('other');
            $otherdata=array(
                'Framework'=>$other_framework,
                'Description'=>$other_framework
            );
           
            $saveotherId=$frameworkModel->insert($otherdata);     
        }
        $questionSaveDetail=array(
            'is_child_question'=>$questionTypeSelection,
            'framework_id'=>(int)$saveotherId,
        	'Qb_Code'=>"Qb_Code",
        	'Description'=>$question_title,
        	'question_placeholder'=>$question_placeholder,
        	'Parent_QB_ID'=>0,
        	'ResponseType'=>0,
        	'Sector_ID'=>$qestion_sector,
            'UOM_ID'=>$inputTypeSelector,
        	'ShowinFilter'=>0,
        	'QualifiedForNormalization'=>"false",
        	'IncludeAsDenominator'=>"false",
        	'Data_Source'=>$qestion_source,
        	'Reference_Period'=>$qestion_year,
        	'SDGMapping'=>"",
        	'Scoring'=>"",
        	'DetailedDescription'=>$question_note,
        	'Supporting_Document'=>$question_supporting_document,
            'concent_of_upload_file'=>$fileUploadconcent,
            'template_for_file'=>$get_template,
            'created_at'=>date('Y-m-d H:i:s')
        );
         
        if(!empty($get_template)){
           $template->move('assets/uploads/templateFiles', $get_template);
        }

        if($inputTypeSelector==42){
            $questionSaveDetail['child_questions']=$jsonChildQuestions;
        }

        if($inputTypeSelector==43){
            if(!empty($subQuest)){
                $questionSaveDetail['sub_question']=json_encode($subQuest);
            }
        }
        if($inputTypeSelector==44){
            $questionSaveDetail['calculation_type']=$CalculatedQuestionOption;
            if(!empty($CalculatedSubQuest)){
                $questionSaveDetail['sub_question']=json_encode($CalculatedSubQuest);
            }
        }
        

        if($inputTypeSelector==41){
            if($get_questionMatrixFileRandomName!=""){
              $questionSaveDetail['question_matrix_barcode']=$get_questionMatrixFileRandomName;
            }
        }

        if($inputTypeSelector==39){
            if($get_barcodeFileRandomName!=""){
              $questionSaveDetail['question_matrix_barcode']=$get_barcodeFileRandomName;
            }
        }

        if(($inputTypeSelector=="8" || $inputTypeSelector=="1"  || $inputTypeSelector=="17") && $questionTypeSelection=="yes"){
            $get_uom_other_detail=trim($this->request->getPost('uom_other_detail'));
            $questionSaveDetail['sub_question_uom_detail']=$get_uom_other_detail;
        }

        
        //print_data($questionSaveDetail);
        //$insertedQuestionId=1;
        //die("Fine here...");

        $saveQuestion=$questionModel->insert($questionSaveDetail);
        $insertedQuestionId=$questionModel->getInsertID();

            if($inputTypeSelector==42){
            $childAllOptions=array();
            $ParentChildQuestionOption=$this->request->getPost('ParentChildQuestionOption');
            if(!empty($ParentChildQuestionOption)){
                foreach($ParentChildQuestionOption as $key233=>$getParentChildQuestionOptions){
                    $childOptios=array(
                    'qb_id'=>$insertedQuestionId,
                    'sector_id'=>$qestion_sector,
                    'framework_id'=>$saveotherId,
                    'options'=>trim($getParentChildQuestionOptions),
                    'range_min_value'=>"",
                    'range_max_value'=>"",
                    'file_extension'=>""
                    );
                    array_push($childAllOptions,$childOptios);
                }
            }
                if(!empty($childAllOptions)){
                   $UomOptionModel->insertBatch($childAllOptions);
                }
            }

        if($inputTypeSelector==8 || $inputTypeSelector==25 || $inputTypeSelector==36){ //Radio & Checkbox
                $allOptions=array();
                $option=$this->request->getPost('option');
                if(!empty($option)){
                    foreach($option as $getOptions){
                        $opt=array(
                         'qb_id'=>$insertedQuestionId,
                         'sector_id'=>$qestion_sector,
                         'framework_id'=>$saveotherId,
                         'options'=>trim($getOptions),
                         'range_min_value'=>"",
                         'range_max_value'=>"",
                         'file_extension'=>""
                        );
                        array_push($allOptions,$opt);
                    }
                }
                if(!empty($allOptions)){
                   $UomOptionModel->insertBatch($allOptions);
                }
        }

       if($inputTypeSelector==35){   //Range Input Mgt
                $range_min_val=$this->request->getPost('range_min_val');
                $range_max_val=$this->request->getPost('range_max_val');
                        $opt=array(
                        'qb_id'=>$insertedQuestionId,
                        'sector_id'=>trim($qestion_sector),
                        'framework_id'=>trim($qestion_framework),
                        'options'=>"",
                        'range_min_value'=>$range_min_val,
                        'range_max_value'=>$range_max_val,
                        'file_extension'=>""
                        );
                        $UomOptionModel->insert($opt);
       }

        if($inputTypeSelector==30){ //Input Type File Mgt
            $PDF = $this->request->getPost('PDF');
            $JPG = $this->request->getPost('JPG');
            $PNG = $this->request->getPost('PNG');
            $WEBP = $this->request->getPost('WEBP');
            $JPEG = $this->request->getPost('JPEG');
            $GIF = $this->request->getPost('GIF');
            $xlsx = $this->request->getPost('xlsx');
            $doc = $this->request->getPost('doc');
            $CSV = $this->request->getPost('CSV');

            $extension=array(
            '0'=>$PDF,
            '1'=>$JPG,
            '2'=>$PNG,
            '3'=>$WEBP,
            '4'=>$JPEG,            
            '5'=>$GIF,
            '6'=>$xlsx,            
            '7'=>$doc,
            '8'=>$CSV
            );
            $length=sizeof($extension);
            $file=array();
            for($i=0; $i<$length; $i++){
                if(!empty($extension[$i])){
                    $file[$i]=$extension[$i];
                }
            }
            $fileExt=implode(",", $file);
            $opt=array(
            'qb_id'=>$insertedQuestionId,
            'sector_id'=>(int)$qestion_sector,
            'framework_id'=>(int)$saveotherId,
            'options'=>"",
            'range_min_value'=>"",
            'range_max_value'=>"",
            'file_extension'=>$fileExt
            );
            $UomOptionModel->insert($opt);                          
    }


    if($inputTypeSelector==28){ //Input Type Audio Mgt
        $MP3 = $this->request->getPost('MP3');
        $AAC = $this->request->getPost('AAC');
        $M4A = $this->request->getPost('M4A');
        $MP4 = $this->request->getPost('MP4');
        $WAV = $this->request->getPost('WAV');
        $WMA = $this->request->getPost('WMA');

        $extensionaudio=array(
        '0'=>$MP3,
        '1'=>$AAC,
        '2'=>$M4A,
        '3'=>$MP4,
        '4'=>$WAV,            
        '5'=>$WMA
        );
        $length=sizeof($extensionaudio);
        $audio=array();
        for($i=0; $i<$length; $i++){
            if(!empty($extensionaudio[$i])){
                $audio[$i]=$extensionaudio[$i];
            }
        }
        $fileExtAudio=implode(",", $audio);
        $opt=array(
            'qb_id'=>$insertedQuestionId,
            'sector_id'=>trim($qestion_sector),
            'framework_id'=>(int)$saveotherId,
            'options'=>"",
            'range_min_value'=>"",
            'range_max_value'=>"",
            'file_extension'=>$fileExtAudio
            );
        $UomOptionModel->insert($opt);
    }

     if($inputTypeSelector==29){ //Input Type Video Mgt
        $MP4 = $this->request->getPost('MP4');
            $MOV = $this->request->getPost('MOV');
            $AVI = $this->request->getPost('AVI');
            $FLV = $this->request->getPost('FLV');
            $MKV = $this->request->getPost('MKV');
            $WMV = $this->request->getPost('WMV');
            $WEBM = $this->request->getPost('WEBM');
            $MPEG_4 = $this->request->getPost('MPEG-4');

            $extensionvideo=array(
            '0'=>$MP4,
            '1'=>$MOV,
            '2'=>$AVI,
            '3'=>$FLV,
            '4'=>$MKV,            
            '5'=>$WMV,
            '6'=>$WEBM,            
            '7'=>$MPEG_4
            );
            $length=sizeof($extensionvideo);
            $video=array();
            for($i=0; $i<$length; $i++){
                if(!empty($extensionvideo[$i])){
                    $video[$i]=$extensionvideo[$i];
                }
            }
          $fileExtVideo=implode(",", $video);
          $opt=array(
            'qb_id'=>$insertedQuestionId,
            'sector_id'=>trim($qestion_sector),
            'framework_id'=>(int)$saveotherId,
            'options'=>"",
            'range_min_value'=>"",
            'range_max_value'=>"",
            'file_extension'=>$fileExtVideo
            );
          $UomOptionModel->insert($opt);
     }
    //print_data($allOptions);
    $response['msg']="Question created successfully";
    $response['inserted_id']=$insertedQuestionId;
    $response['status'] = 1;
    echo json_encode($response);
    exit();
    } // End of the function.

    public function edit_question(){
        /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
        $UomOptionModel=new \App\Models\Uom_option();
        $questionModel=new \App\Models\QuestionModel();
        $SectorModel=new \App\Models\SectorModel();
        $SurveyModel = new \App\Models\SurveyModel();
        $uomModel = new \App\Models\Uom();
        $frameworkModel = new \App\Models\Admin\Framework();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $uri = service('uri');
        $geturi = $uri->getSegments();
        $questionId = $geturi[2];
        //echo "Question Id : ".$questionId; die;
        $data["question"]=$questionModel->where('QB_ID',$questionId)->first();
        //print_data($data["question"]);
        $data['alloptions']=$UomOptionModel->where('qb_id',$questionId)->findall();
        $data['allsector']=$SectorModel->orderBy('Sector')->findall();
        $data['allinputs']=$uomModel->orderBy('UOM')->findall();
        $data['allframework']=$frameworkModel->orderBy('Framework')->findall();
        return view('backend/question_bank/edit_question',$data);
    } // End of the function.


    
    public function removeSigleOption(){
        $response = ['status' => 0, 'data' => '', 'msg' => ''];
        $UomOptionModel=new \App\Models\Uom_option();
        $opt_id=$this->request->getPost('option_id');
        //die("Option Id ::: ".$opt_id);
        if($opt_id!=""){
          $UomOptionModel->where('id', $opt_id)->delete();
          $response['msg'] = "Option removed successfully";
          $response['status'] = 1;
        }
        echo json_encode($response);
        exit;
    } // End of the function.


    public function view_survey(){
        $today=date("Y-m-d");
        /* Check Valid User */
        $getLogedInUserDetail=session('admin_detail');
        $getLoginUserRole=$getLogedInUserDetail['role'];
        if($getLoginUserRole!=5){
          $url=base_url()."/admin/dashboard";
          header("Location: $url"); exit();            
        }
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
        $logedInUserDetail=session('admin_detail');
        if($logedInUserDetail['role']!=5){
            $url=base_url()."admin/dashboard";
            header("Location: $url"); exit();
        }
        $data["allsurvey"]=$SurveyModel->orderBy('Survey_ID','DESC')->findAll();
        /*############################ Publish Btn Enable Disable #############################*/
        if(!empty($data["allsurvey"])){
            foreach($data["allsurvey"] as $key=>$value){
                $data["allsurvey"][$key]["showPublishBtn"]=0;
                $getsurvey=trim($value["Survey_ID"]);
                //echo $getsurvey."<======>";
                $chkSurvey=$SurveyModel->where('Survey_ID',$getsurvey)->where('publish_status',2)->where('is_uof',1)->first();
                $getAllCityOfficialsWhoSubmitted=$City_submissionModel->where('Survey_ID',$getsurvey)->where('submission_status',1)->findAll();
                if(!empty($chkSurvey)){
                $surveyEndDate=$chkSurvey["To_Date"];
                if(strtotime($today)>strtotime($surveyEndDate)){ //Condition1
                        $getSurveyAllSectors=$surveyquestionMasterModel->select('DISTINCT("Sector_ID"),Survey_ID')->where('Survey_ID',$getsurvey)->findAll();
                        $getSurveyAllJobs=$ValidatorJobCity->where('survey_id',$getsurvey)->findAll();
                        $getSurveyAllJobsSubmittedByV2=$ValidatorJobCity->where('survey_id',$getsurvey)->where('v2_status',1)->findAll();
                        $requiredJobs=count($getSurveyAllSectors)*count($getAllCityOfficialsWhoSubmitted);
                        if($getSurveyAllJobs=$requiredJobs){ //Condition2
                            if($getSurveyAllJobs=$getSurveyAllJobsSubmittedByV2){ //Condition3
                                $data["allsurvey"][$key]["showPublishBtn"]=1;
                            }
                        }
                }
            }
        }
        }

        //print_data($data["allsurvey"]);
        return view('backend/admin/survey_list',$data);
    } // End of the function.


    
    public function edit_survey(){
        /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
        $SurveyModel = new \App\Models\SurveyModel();
        $logedInUserDetail=session('admin_detail');
        if($logedInUserDetail['role']!=5){
            $url=base_url()."admin/dashboard";
            header("Location: $url"); exit();
        }
        $uri=service('uri');
        $geturi=$uri->getSegments();
        $surveyId=$geturi[2];
        //echo "Survey Id : ".$surveyId; die;
        $data["survey"]=$SurveyModel->where('Survey_ID',$surveyId)->first();
        if(empty($data["survey"])){
            $url=base_url()."admin/view-survey";
            header("Location: $url"); exit();  
        }
        //print_data($data["allsurvey"]);
        return view('backend/admin/survey_edit',$data);
    } // End of the function.

    
    public function update_survey_detail(){
        /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
        $response=['status'=>0, 'msg'=>''];
        $SurveyModel=new \App\Models\SurveyModel();
        $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
        $QuestionForNewAddedSurvey = array();
        $sid=trim($this->request->getPost('sid'));
        $chk=$SurveyModel->where("Survey_ID",$sid)->first();
        $Survey_Name=trim($this->request->getPost('survey_name'));
        $Description=trim($this->request->getPost('description'));
        $From_Date=trim($this->request->getPost('survey_start_date'));
        $To_Date=trim($this->request->getPost('survey_end_date'));
        //$old_to_date=trim($this->request->getPost('old_end_dt'));
        $old_to_date=($this->request->getPost('old_end_dt')) ? date('d-m-Y', strtotime($this->request->getPost('old_end_dt'))):'';
        //echo $To_Date." ::: ".$old_to_date; die();
        $survey_active_inactive=trim($this->request->getPost('survey_active_inactive'));
        if(strtotime($To_Date)<strtotime($old_to_date)){
            $errorMsg['fieldName'] = 'survey_end_date';
            $errorMsg['errorMsgFieldName'] = 'err_survey_end_date';
            $errorMsg['errorMsg'] = "Please select another date, end date can not be less then previous end date!";
            $response['validation'] = $errorMsg;
            echo json_encode($response);
            exit();
        }
        //die("sss");
        //print_data($chk);
        /*if(!empty($chk)){
            if($chk['publish_status']==2){
                $errorMsg['fieldName'] = 'survey_name';
                $errorMsg['errorMsgFieldName'] = 'err_survey_name';
                $errorMsg['errorMsg'] = "Survey is published!";
                $response['validation'] = $errorMsg;
                echo json_encode($response);
                exit();
            }
        }*/
       
        if($Survey_Name!='' && $Description!='' && $From_Date!='' && $To_Date!=''){
            $surveyPublishStatus=$chk["publish_status"];
            $dataToUpdateSurvey=array(
                'active_inactive_status'=>$survey_active_inactive,
                // 'Description'=>$Description,
                // 'From_Date'=>date('Y-m-d',strtotime($From_Date)),
                'To_Date'=>date('Y-m-d',strtotime($To_Date))
            );
            if($surveyPublishStatus!=2){
               $dataToUpdateSurvey["Survey_Name"]=$Survey_Name;
            }
            //print_data($dataToUpdateSurvey);
            $SurveyModel->update($sid,$dataToUpdateSurvey);
            $data['status']=1;
            $data['msg']='Survey detail updated successfully';
        }else{
            $data['msg']='Please fill all the details!';
        }
        echo json_encode($data);  exit;          
    } // End of the function.


    

    public function view_sector(){
        $SectorModel = new \App\Models\SectorModel();
        $logedInUserDetail=session('admin_detail');
        if($logedInUserDetail['role']!=5){
            $url=base_url()."admin/dashboard";
            header("Location: $url"); exit();
        }
        $data["allsector"]=$SectorModel->orderBy('Sector_ID','DESC')->findAll();
        
        return view('backend/admin/sector_list',$data);
    } // End of the function.


    public function get_question_detail(){
       $questionModel=new \App\Models\QuestionModel();
       $uomModel=new \App\Models\Uom();
       $response=['status'=>0, 'msg'=>'','detail'=>''];
       $question=trim($this->request->getPost('question'));
       //die($question);
       if($question!=""){
          $getDetail=$questionModel->where('QB_ID',$question)->first();
          if(!empty($getDetail)){
            $getData=$uomModel->where('UOM_ID', $getDetail["UOM_ID"])->first();
            if($getDetail["is_child_question"]=="no"){
              $response['detail']='<tr><td>'.$getDetail['Reference_Period'].'</td><td>'.$getDetail['Data_Source'].'</td><td>'.$getData['UOM'].'</td><td>'.$getDetail['DetailedDescription'].'</td><td>'.$getDetail['Supporting_Document'].'</td></tr>';
            }else{
               $response['detail']='<tr><td>'.$getDetail['Reference_Period'].'</td><td>'.$getDetail['Data_Source'].'</td><td>'.$getDetail['sub_question_uom_detail'].'</td><td>'.$getDetail['DetailedDescription'].'</td><td>'.$getDetail['Supporting_Document'].'</td></tr>';
            }
          }
       }
       echo json_encode($response); exit;  
    } // End of the function.

    public function update_question_detail(){
        /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
            $UomOptionModel=new \App\Models\Uom_option();
            $questionModel=new \App\Models\QuestionModel();
            $SectorModel=new \App\Models\SectorModel();
            $SurveyModel = new \App\Models\SurveyModel();
            $uomModel = new \App\Models\Uom();
            $frameworkModel = new \App\Models\Admin\Framework();
            $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
            $uri = service('uri');
            $geturi = $uri->getSegments();
            $questionId = $geturi[2];
            //echo "Question Id : ".$questionId; die;
            $data["question"]=$questionModel->where('QB_ID',$questionId)->first();
            //print_data($data["question"]);
            $data['alloptions']=$UomOptionModel->where('qb_id',$questionId)->findall();
            $data['allsector']=$SectorModel->orderBy('Sector')->findall();
            $data['allinputs']=$uomModel->orderBy('UOM')->findall();
            $data['allframework']=$frameworkModel->orderBy('Framework')->findall();
            return view('backend/question_bank/update_question_detail',$data);
        } // End of the function.

        
        public function updateQuestionDetail(){
            /* Check Valid User */
            $getLogedInUserDetail=session('admin_detail');
            $getLoginUserRole=$getLogedInUserDetail['role'];
            if($getLoginUserRole!=5){
              $url=base_url()."/admin/dashboard";
              header("Location: $url"); exit();            
            }
            $UomOptionModel=new \App\Models\Uom_option();
            $questionModel=new \App\Models\QuestionModel();
            $SectorModel=new \App\Models\SectorModel();
            $SurveyModel = new \App\Models\SurveyModel();
            $uomModel = new \App\Models\Uom();
            $frameworkModel = new \App\Models\Admin\Framework();
            $surveyquestionMasterModel=new \App\Models\SurveyQuestionMasterModel();
            $questionId = trim($this->request->getPost('questionId'));
            $question_title = trim($this->request->getPost('question_title'));
            $question_note = trim($this->request->getPost('question_note'));
            $question_placeholder = trim($this->request->getPost('question_placeholder'));
            $qestion_year=trim($this->request->getPost('question_year'));
            $qestion_source=trim($this->request->getPost('question_source'));
            $question_supporting_document=trim($this->request->getPost('question_supporting_document'));
            $get_uom_other_detail=trim($this->request->getPost('uom_other_detail'));
            $qestion_sector = (int)$this->request->getPost('qestion_sector');
            $qestion_framework = trim($this->request->getPost('qestion_framework'));
            $inputTypeSelector = trim($this->request->getPost('inputTypeSelector'));

            $scheckQuestion=$questionModel->where('framework_id', $qestion_framework)->where('Sector_ID', $qestion_sector)->where('UOM_ID', $inputTypeSelector)->where('lower("Description")', strtolower($question_title))->first();

            if(!empty($scheckQuestion)){
                $currentQuestionTitle=$scheckQuestion["Description"];
                if($currentQuestionTitle!=$question_title){
                        if(!empty($scheckQuestion)){
                            $response['msg']="Question already exists!";
                            echo json_encode($response);
                            exit();
                        }
                }                
            }

            $questionUpdateDetail=array(
                'Description'=>$question_title,
                'Data_Source'=>$qestion_source,
                'Reference_Period'=>$qestion_year,
                'DetailedDescription'=>$question_note,
                'Supporting_Document'=>$question_supporting_document,
                'sub_question_uom_detail'=>$get_uom_other_detail
            );
            //print_data($questionUpdateDetail);
            $questionModel->update($questionId,$questionUpdateDetail);
            $response['msg']="Question updated successfully";
            $response['updatedId']=$questionId;
            $response['status'] = 1;
            echo json_encode($response);  exit();            
        } // End of the function.

} // End of the class.
?>