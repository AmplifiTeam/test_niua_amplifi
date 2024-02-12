<?php
namespace Config;
$routes = Services::routes();
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
//$routes->set404Override();
$routes->set404Override(function() {
    return view('page_not_found');
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Administrator\Admin::login');
$routes->get('login', 'Administrator\Admin::login');
$routes->post('save-survey-form', 'Frontend::save_survey_form');
$routes->post('admin/addQuestionToSurvey','Administrator\Admin::addQuestionToSurvey');
$routes->post('admin/removeSigleQuestion','Administrator\Admin::removeSigleQuestion');
$routes->post('admin/removeMultipleQuestion','Administrator\Admin::removeMultipleQuestion');
$routes->post('admin/addNewSurvey','Administrator\Admin::addNewSurvey');
$routes->post('admin/surveyDetailsDataAjax','Administrator\Admin::surveyDetailsDataAjax');
$routes->post('admin/addMultipleQuestion','Administrator\Admin::addMultipleQuestion');
$routes->post('admin/cityOfficialSurveyAjaxData','CityOfficial\Admin::cityOfficialSurveyAjaxData');
$routes->post('admin/getSuffleSectorQuestionData','Administrator\Admin::getSuffleSectorQuestionData');
$routes->post('admin/update_sort_order','Administrator\Admin::update_sort_order');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
/*##########   Admin Routes  ###################*/
$routes->group('admin', static function ($routes) {
        $routes->post('getSectorQuestion', 'Administrator\Admin::getSectorQuestion', ["filter" => "isLogedIn"]);
        $routes->post('searchSectorQuestion', 'Administrator\Admin::searchSectorQuestion', ["filter" => "isLogedIn"]);   
        $routes->get('/', 'Administrator\Admin::login');
        $routes->get('logout', 'Administrator\Admin::logout');
        $routes->post('validate-login', 'Administrator\Admin::validatelogin');
        $routes->get('dashboard', 'Administrator\Admin::dashboard', ["filter" => "isLogedIn"]);
        $routes->get('registered-users', 'Administrator\Admin::registered_users', ["filter" => "isLogedIn"]); 
        $routes->post('user-delete', 'Administrator\Admin::user_delete', ["filter" => "isLogedIn"]);     
        $routes->get('datatable', 'Administrator\Admin::datatable', ["filter" => "isLogedIn"]);
        $routes->get('form', 'Administrator\Admin::form', ["filter" => "isLogedIn"]);
        $routes->get('create-question', 'Administrator\QuestionMaster::index', ["filter" => "isLogedIn"]);
        $routes->get('view-question', 'Administrator\QuestionMaster::all_question', ["filter" => "isLogedIn"]);  
        $routes->get('question-detail/(:num)', 'Administrator\QuestionMaster::question_detail', ["filter" => "isLogedIn"]);
        $routes->get('edit-question/(:num)', 'Administrator\QuestionMaster::edit_question', ["filter" => "isLogedIn"]);
        $routes->get('edit-question/', 'Administrator\QuestionMaster::all_question', ["filter" => "isLogedIn"]);
        $routes->get('copy-question/(:num)', 'Administrator\QuestionMaster::copy_question', ["filter" => "isLogedIn"]);
        $routes->get("update-question-detail/(:num)","Administrator\QuestionMaster::update_question_detail",["filter" => "isLogedIn"]);
        $routes->get("update-question-detail","Administrator\QuestionMaster::all_question",["filter" => "isLogedIn"]);
        $routes->post("updateQuestionDetail","Administrator\QuestionMaster::updateQuestionDetail",["filter" => "isLogedIn"]);
        $routes->get('copy-question/', 'Administrator\QuestionMaster::all_question', ["filter" => "isLogedIn"]);
        $routes->get('question-detail/', 'Administrator\QuestionMaster::all_question', ["filter" => "isLogedIn"]);
        $routes->post('save-question', 'Administrator\QuestionMaster::save_question', ["filter" => "isLogedIn"]);
        $routes->post('get-question-detail', 'Administrator\QuestionMaster::get_question_detail', ["filter" => "isLogedIn"]);
        $routes->post('question-delete', 'Administrator\QuestionMaster::question_delete', ["filter" => "isLogedIn"]);
        $routes->post('edit-questions', 'Administrator\QuestionMaster::question_edit', ["filter" => "isLogedIn"]);
        $routes->post('save-copy-questions', 'Administrator\QuestionMaster::save_copy_question', ["filter" => "isLogedIn"]);
        $routes->post('option-delete', 'Administrator\QuestionMaster::delete_option', ["filter" => "isLogedIn"]);  
        $routes->post('addNewSector', 'Administrator\Admin::addNewSector', ["filter" => "isLogedIn"]);
        $routes->get('follow', 'Administrator\QuestionMaster::followquestion', ["filter" => "isLogedIn"]);  
        $routes->get('view-survey', 'Administrator\QuestionMaster::view_survey', ["filter" => "isLogedIn"]);
        $routes->get('edit-survey/(:num)', 'Administrator\QuestionMaster::edit_survey', ["filter" => "isLogedIn"]);
        $routes->get('edit-sector/(:num)', 'Administrator\Admin::editSector', ["filter" => "isLogedIn"]);
        $routes->addRedirect('edit-sector/', 'admin/view-sector');
        $routes->post('update-sector-detail', 'Administrator\Admin::update_sector_detail', ["filter" => "isLogedIn"]); 
        $routes->post('update-survey', 'Administrator\QuestionMaster::update_survey_detail', ["filter" => "isLogedIn"]);
        $routes->get('view-sector', 'Administrator\QuestionMaster::view_sector', ["filter" => "isLogedIn"]);
        $routes->post('removeSigleOption', 'Administrator\QuestionMaster::removeSigleOption', ["filter" => "isLogedIn"]);
        $routes->post('question-answer', 'Administrator\SurveyResultMgt::index', ["filter" => "isLogedIn"]);
        $routes->post('calculated-question-answer', 'Administrator\SurveyResultMgt::calculated_question_answer', ["filter" => "isLogedIn"]);
        $routes->post('child-question-answer', 'Administrator\SurveyResultMgt::child_question_answer', ["filter" => "isLogedIn"]);
        $routes->post('child_question_previous_option_delete', 'Administrator\SurveyResultMgt::child_question_previous_option_delete', ["filter" => "isLogedIn"]);
        $routes->post('upload-file', 'Administrator\SurveyResultMgt::upload_file', ["filter" => "isLogedIn"]);
        $routes->post('barcode-questionmatrix-upload-file', 'Administrator\SurveyResultMgt::barcode_questionmatrix_upload_file', ["filter" => "isLogedIn"]);
        $routes->get('sector-question/(:num)/(:num)', 'CityOfficial\Admin::sector_question', ["filter" => "isLogedIn"]);  
        $routes->post('city-submission', 'Administrator\SurveyResultMgt::city_submission', ["filter" => "isLogedIn"]);
        $routes->post('add-remark', 'Administrator\SurveyResultMgt::add_remark', ["filter" => "isLogedIn"]);
        $routes->post('get-question-remark', 'Administrator\SurveyResultMgt::get_question_remark', ["filter" => "isLogedIn"]);  
        $routes->post('get-question-documents', 'Administrator\SurveyResultMgt::get_question_documents', ["filter" => "isLogedIn"]);
        $routes->post('save-question-document', 'Administrator\SurveyResultMgt::save_question_document', ["filter" => "isLogedIn"]);
        $routes->post('delete-question-document', 'Administrator\SurveyResultMgt::delete_question_document', ["filter" => "isLogedIn"]);
        $routes->addRedirect('sector-question/', 'admin/dashboard');
        $routes->addRedirect('sector-question/(:num)', 'admin/dashboard');
        $routes->addRedirect('sector-question', 'admin/dashboard');
        $routes->post('save-survey', 'Administrator\Admin::save_survey', ["filter" => "isLogedIn"]);
        $routes->post('publish-survey', 'Administrator\Admin::publish_survey', ["filter" => "isLogedIn"]);
        $routes->post('survey-filter-question', 'Administrator\SurveyResultMgt::survey_filter_question', ["filter" => "isLogedIn"]);
        $routes->get('download-survey-question/(:num)', 'Administrator\Admin::download_survey_question', ["filter" => "isLogedIn"]);
        $routes->get('user-master', 'Administrator\UserMaster::user_master', ["filter" => "isLogedIn"]);
        $routes->post('add-user', 'Administrator\UserMaster::add_user', ["filter" => "isLogedIn"]);
        $routes->get('user-fetch/(:num)', 'Administrator\UserMaster::user_fetch', ["filter" => "isLogedIn"]);
        $routes->get('user-list', 'Administrator\UserMaster::user_list', ["filter" => "isLogedIn"]);
        $routes->post('edit-user', 'Administrator\UserMaster::edit_user', ["filter" => "isLogedIn"]);
        $routes->post('add-bookmark-question', 'Administrator\SurveyResultMgt::add_bookmark_question', ["filter" => "isLogedIn"]);
        $routes->get('job', 'Administrator\Jobs::index', ["filter" => "isLogedIn"]);
        $routes->post('job/getSectorListBySurveyId', 'Administrator\Jobs::getSectorListBySurveyId', ["filter" => "isLogedIn"]);
        $routes->post('job/saveJobs', 'Administrator\Jobs::saveJobs', ["filter" => "isLogedIn"]);
        $routes->get('myjobs', 'Administrator\MyJobs::index', ["filter" => "isLogedIn"]);
        $routes->post('job/jobDataFilterAjax', 'Administrator\MyJobs::jobDataFilterAjax', ["filter" => "isLogedIn"]);
        $routes->get('city-status','Administrator\AdminCityStatus::index', ["filter" => "isLogedIn"]);
        $routes->post('getSurveyCityListData','Administrator\AdminCityStatus::getSurveyCityListData', ["filter" => "isLogedIn"]);
        $routes->get('validators-status/(:num)', 'Administrator\AdminCityStatus::validators_status_on_city', ["filter" => "isLogedIn"]);
        $routes->post('get-kpi-list', 'Validator1\Validator::get_kpi_list', ["filter" => "isLogedIn"]);
        $routes->get('city-questions/(:num)/(:num)/(:num)', 'Validator1\Validator::city_questions', ["filter" => "isLogedIn"]);
        $routes->addRedirect('city-questions/(:num)/(:num)', 'admin/dashboard');
        $routes->addRedirect('city-questions/(:num)', 'admin/dashboard');
        $routes->get('download-excel/(:num)/(:num)', 'Administrator\UserMaster::download_excel', ["filter" => "isLogedIn"]);
        $routes->post('add-priority-city', 'Validator1\Validator::add_priority_city', ["filter" => "isLogedIn"]);
        $routes->post('validator-approve', 'Validator1\Validator::approve_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-approve-all', 'Validator1\Validator::approve_all_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-reject', 'Validator1\Validator::reject_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-reject-all', 'Validator1\Validator::reject_all_question', ["filter" => "isLogedIn"]);  
        $routes->post('validator-bookmark-question', 'Validator1\Validator::validator_bookmark_question', ["filter" => "isLogedIn"]);
        $routes->post('filter-validator-question', 'Validator1\Validator::filter_validator_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-revert-with-comment', 'Validator1\Validator::validator_revert_with_comment', ["filter" => "isLogedIn"]);
        $routes->post('get-validator-comment', 'Validator1\Validator::get_validator_comment', ["filter" => "isLogedIn"]);
        $routes->post('sent-v2', 'Validator1\Validator::sentv2', ["filter" => "isLogedIn"]);  
        $routes->post('validate-question-documents', 'Administrator\SurveyResultMgt::get_question_documents_for_validator', ["filter" => "isLogedIn"]);
        $routes->post('validate-question-remark', 'Administrator\SurveyResultMgt::validate_question_remark_for_validator', ["filter" => "isLogedIn"]);
        $routes->post('get-kpi-list2', 'Validator2\Validator2::get_kpi_list', ["filter" => "isLogedIn"]);
        $routes->get('city-questions2/(:num)/(:num)/(:num)', 'Validator2\Validator2::city_questions', ["filter" => "isLogedIn"]);
        $routes->addRedirect('city-questions2/(:num)/(:num)', 'admin/dashboard');
        $routes->addRedirect('city-questions2/(:num)', 'admin/dashboard');
        $routes->get('download-excel2/(:num)/(:num)', 'Administrator\UserMaster::download_excel', ["filter" => "isLogedIn"]);
        $routes->post('add-priority-city2', 'Validator2\Validator2::add_priority_city', ["filter" => "isLogedIn"]);
        $routes->post('validator-approve2', 'Validator2\Validator2::approve_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-approve-all2', 'Validator2\Validator2::approve_all_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-reject2', 'Validator2\Validator2::reject_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-reject-all2', 'Validator2\Validator2::reject_all_question', ["filter" => "isLogedIn"]);  
        $routes->post('validator-bookmark-question2', 'Validator2\Validator2::validator_bookmark_question', ["filter" => "isLogedIn"]);
        $routes->post('filter-validator-question2', 'Validator2\Validator2::filter_validator_question', ["filter" => "isLogedIn"]);
        $routes->post('validator-revert-with-comment2', 'Validator2\Validator2::validator_revert_with_comment', ["filter" => "isLogedIn"]);
        $routes->post('validator-final-action', 'Validator2\Validator2::validator_final_action', ["filter" => "isLogedIn"]);
        $routes->get('download123', 'Administrator\UserMaster::pipeline_filter1', ["filter" => "isLogedIn"]);
        $routes->get('city-reverted-dashboard/(:num)', 'CityOfficial\Admin::city_reverted_dashboard', ["filter" => "isLogedIn"]);
        $routes->addRedirect('city-reverted-dashboard/', 'admin/dashboard');
        $routes->get('sector-revert-question/(:num)/(:num)', 'CityOfficial\Admin::sector_revert_question', ["filter" => "isLogedIn"]);
        $routes->addRedirect('sector-revert-question/(:num)', 'admin/dashboard');
        $routes->addRedirect('sector-revert-question/', 'admin/dashboard');  
        $routes->post('get-validator2-comment', 'Validator2\Validator2::get_validator2_comment', ["filter" => "isLogedIn"]);
        $routes->post('get-validator1-comment', 'Validator2\Validator2::get_validator1_comment', ["filter" => "isLogedIn"]);
        $routes->post('re-submit', 'Administrator\SurveyResultMgt::re_submit', ["filter" => "isLogedIn"]);
        $routes->post('markAsReadNotification', 'Validator1\Validator::markAsReadNotification', ["filter" => "isLogedIn"]);
        $routes->get('data-pipeline', 'Administrator\Pipeline::data_pipeline', ["filter" => "isLogedIn"]);
        $routes->post('pipeline-filter', 'Administrator\Pipeline::pipeline_filter', ["filter" => "isLogedIn"]);
        $routes->post('publishToDashboard', 'Administrator\Pipeline::publishToDashboard', ["filter" => "isLogedIn"]);
        $routes->get('download_myJobsData_excel/(:num)/(:num)/(:num)','Administrator\UserMaster::download_myJobsData_excel', ["filter" => "isLogedIn"]);
        $routes->get('download_ConsolodatedData_excel/(:num)/(:num)/(:num)','Administrator\UserMaster::download_ConsolodatedData_excel', ["filter" => "isLogedIn"]);  
        $routes->get('download_cityStatusData_excel/(:num)','Administrator\UserMaster::download_cityStatusData_excel', ["filter" => "isLogedIn"]);
        $routes->get('downLoadSurveyResultDataExcel/(:num)','Administrator\UserMaster::downLoadSurveyResultDataExcel', ["filter" => "isLogedIn"]);
        $routes->addRedirect('downLoadSurveyResultDataExcel/', 'admin/dashboard');


        $routes->post('showSelectedQuestionOrder','Administrator\UserMaster::showSelectedQuestionOrder', ["filter" => "isLogedIn"]);


        //API
        $routes->get('surveyResultDataApi/(:num)/(:hash)','Administrator\UserMaster::downLoadSurveyResultDataAPI');
        $routes->addRedirect('surveyResultDataApi/(:num)', 'login');




        $routes->get('pushUser','Administrator\Pipeline::pushCityOfficialUserFromExcel');

 
});
