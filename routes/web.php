<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CovisController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TermPolicyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/terms-and-policy', function() {
    return view('terms-and-policy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/test', [CovisController::class, 'deletecustomer']);
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/update-mode', [CovisController::class, 'update_mode_customer'])->name('update-mode');
    // AJAX
    Route::get('/get-branch/{param}', [App\Http\Controllers\CovisController::class, 'getBranch']);
    Route::get('/get-region/{param}', [App\Http\Controllers\CovisController::class, 'getRegion']);
    Route::get('/get-cities/{param}', [App\Http\Controllers\CovisController::class, 'getCities']);
    Route::get('/get-districts/{param}', [App\Http\Controllers\CovisController::class, 'getDistricts']);
    
    Route::get('/list-customer-json', [CovisController::class, 'customer_list_json']);
    Route::get('/list-request-json', [CovisController::class, 'list_request_customer']);
    Route::get('/transaction-complete-json',[CovisController::class, 'transaction_complete_json']);
    Route::get('/transaction-revision-json',[CovisController::class, 'transaction_revision_json']);

    // Settings
    Route::get('/setting-company', [SettingController::class, 'company_index'])->name('setting-company');
    Route::get('/setting-department', [SettingController::class, 'department_index'])->name('setting-department');
    Route::get('/setting-job-position', [SettingController::class, 'job_position_index'])->name('setting-job-position');
    Route::post('/setting-job-position-store', [SettingController::class, 'job_position_store'])->name('setting-job-position-store');
    Route::post('/setting-department-store', [SettingController::class, 'department_store'])->name('setting-department-store');
    Route::post('/setting-company-store', [SettingController::class, 'company_store'])->name('setting-company-store');
    Route::post('/setting-project-store', [SettingController::class, 'project_store'])->name('setting-project-store');
    Route::post('/setting-branch-store', [SettingController::class, 'branch_store'])->name('setting-branch-store');
    Route::post('/setting-region-store', [SettingController::class, 'region_store'])->name('setting-region-store');
    Route::post('/setting-type-store', [SettingController::class, 'collateral_type_store'])->name('setting-type-store');
    Route::post('/priority-store', [SettingController::class, 'collateral_priority_store'])->name('priority-store');
    Route::post('/collateral-classes-store', [SettingController::class, 'collateral_classes_store'])->name('collateral-classes-store');
    Route::post('/covis-condition-store', [SettingController::class, 'collateral_condition_store'])->name('covis-condition-store');
    Route::post('/setting-covis-used-store', [SettingController::class, 'collateral_used_for_store'])->name('setting-covis-used-for-store');
    Route::post('/setting-road-access-store', [SettingController::class, 'collateral_road_access_store'])->name('setting-road-access-store');
    Route::post('/user-store', [SettingController::class, 'user_store'])->name('user-store');
    Route::get('/set-user-edit/{id}', [SettingController::class, 'set_user_edit'])->name('set-user-edit');

    // Delete
    Route::get('/setting/delete/company/{id}', [SettingController::class, 'company_delete'])->name('delete-company');
    Route::get('/setting/delete/department/{id}', [SettingController::class, 'department_delete'])->name('delete-department');
    Route::get('/setting/delete/project/{id}', [SettingController::class, 'project_delete'])->name('delete-project');
    Route::get('/setting/delete/branch/{id}', [SettingController::class, 'branch_delete'])->name('delete-branch');
    Route::get('/setting/delete/region/{id}', [SettingController::class, 'region_delete'])->name('delete-region');
    Route::get('/setting/delete/clasess/{id}', [SettingController::class, 'collateral_classes_delete'])->name('delete-clasess');
    Route::get('/setting/delete/type/{id}', [SettingController::class, 'collateral_type_delete'])->name('delete-type');
    Route::get('/setting/delete/priority/{id}', [SettingController::class, 'collateral_priority_delete'])->name('delete-priority');
    Route::get('/setting/delete/condition/{id}', [SettingController::class, 'collateral_condition_delete'])->name('delete-condition');
    Route::get('/setting/delete/used-for/{id}', [SettingController::class, 'collateral_used_for_delete'])->name('delete-used-for');
    Route::get('/setting/delete/road-access/{id}', [SettingController::class, 'collateral_road_access_delete'])->name('delete-road-access');
    Route::get('/setting/delete/user-role/{id}', [SettingController::class, 'collateral_user_role_delete'])->name('user-role-delete');


    // edit

    Route::get('/setting/edit/company/{id}', [SettingController::class, 'company_edit'])->name('company-edit');
    Route::post('/setting/update/company/{id}', [SettingController::class, 'company_update'])->name('company-update');
    Route::get('/setting/edit/department/{id}', [SettingController::class, 'department_edit'])->name('department-edit');
    Route::post('/setting/update/department/{id}', [SettingController::class, 'department_update'])->name('department-update');
    Route::get('/setting/edit/project-client/{id}', [SettingController::class, 'project_edit'])->name('project-edit');
    Route::post('/setting/edit/project-update/{id}', [SettingController::class, 'project_update'])->name('project-update');
    Route::get('/setting/edit/branch/{id}', [SettingController::class, 'branch_edit'])->name('branch-edit');
    Route::post('/setting/edit/branch-update/{id}', [SettingController::class, 'branch_update'])->name('branch-update');
    Route::get('/setting/edit/region/{id}', [SettingController::class, 'region_edit'])->name('region-edit');
    Route::post('/setting/edit/region-update/{id}', [SettingController::class, 'region_update'])->name('region-update');
    Route::get('/setting/edit/classes/{id}', [SettingController::class, 'collateral_classes_edit'])->name('classes-edit');
    Route::post('/setting/edit/classes-update/{id}', [SettingController::class, 'collateral_classes_update'])->name('classes-update');
    Route::get('/setting/edit/type/{id}', [SettingController::class, 'collateral_type_edit'])->name('type-edit');
    Route::post('/setting/edit/type-update/{id}', [SettingController::class, 'collateral_type_update'])->name('type-update');
    Route::get('/setting/edit/priority/{id}', [SettingController::class, 'collateral_priority_edit'])->name('priority-edit');
    Route::post('/setting/edit/priority-update/{id}', [SettingController::class, 'collateral_priority_update'])->name('priority-update');
    Route::get('/setting/edit/condition/{id}', [SettingController::class, 'collateral_condition_edit'])->name('condition-edit');
    Route::post('/setting/edit/condition-update/{id}', [SettingController::class, 'collateral_condition_update'])->name('condition-update');
    Route::get('/setting/edit/role/{id}', [SettingController::class, 'role_edit'])->name('role-edit');
    Route::post('/setting/update/role/{id}', [SettingController::class, 'role_update'])->name('role-update');
    Route::get('/setting/edit/used-for/{id}', [SettingController::class, 'collateral_used_for_edit'])->name('used-for-edit');
    Route::post('/setting/update/used-for/{id}', [SettingController::class, 'collateral_used_for_update'])->name('used-for-update');
    Route::get('/setting/edit/road-access/{id}', [SettingController::class, 'collateral_road_access_edit'])->name('road-access-edit');
    Route::post('/setting/update/road-access/{id}', [SettingController::class, 'collateral_road_access_update'])->name('road-access-update');
    Route::get('/setting/edit/setting-user-list/{id}', [SettingController::class, 'set_user_edit'])->name('set-user-edit');
    Route::post('/setting/update/setting-user-list/{id}', [SettingController::class, 'set_user_update'])->name('set-user-update');

    Route::get('/setting/edit/job-position/{id}', [SettingController::class, 'job_position_edit'])->name('job-position-edit');
    Route::post('/setting/update/job-position/{id}', [SettingController::class, 'job_position_update'])->name('job-position-update');

    Route::get('/setting-project-client', [SettingController::class, 'project_index'])->name('setting-project-client');
    Route::get('/setting-branch', [SettingController::class, 'branch_index'])->name('setting-branch');
    Route::get('/setting-region', [SettingController::class, 'region_index'])->name('setting-region');

    Route::get('/setting-covis-class', [SettingController::class, 'collateral_classes_index'])->name('setting-covis-class');
    Route::post('/store-covis-class', [SettingController::class, 'collateral_classes_store']);
    Route::get('/setting-covis-type', [SettingController::class, 'collateral_type_index'])->name('setting-covis-type');
    Route::get('/setting-covis-priority', [SettingController::class, 'collateral_priority_index'])->name('setting-covis-priority');
    Route::get('/setting-covis-condition', [SettingController::class, 'collateral_condition_index'])->name('setting-covis-condition');
    Route::get('/setting-covis-used-for', [SettingController::class, 'collateral_used_for_index'])->name('setting-covis-used-for');
    Route::get('/setting-covis-road-access', [SettingController::class, 'collateral_road_access_index'])->name('setting-road-access');
    Route::get('/setting-user', [SettingController::class, 'user_index'])->name('setting-user');
    Route::get('/setting-user-role', [SettingController::class, 'user_role_index'])->name('setting-user-role');
    Route::post('/setting-user-role-store', [SettingController::class, 'user_role_store'])->name('setting-user-role-store');

    // active & inactive user list setting
    Route::get('/setting-user/inactive/{id}', [SettingController::class, 'user_inactive'])->name('user-inactive');
    Route::get('/setting-user/active/{id}', [SettingController::class, 'user_active'])->name('user-active');

    // active & inactive company listing
    Route::get('/setting-company/inactive/{id}', [SettingController::class, 'company_inactive'])->name('company-inactive');
    Route::get('/setting-company/active/{id}', [SettingController::class, 'company_active'])->name('company-active');
    // active & inactive department
    Route::get('/setting-department/inactive/{id}', [SettingController::class, 'department_inactive'])->name('department-inactive');
    Route::get('/setting-department/active/{id}', [SettingController::class, 'department_active'])->name('department-active');
    // active & inactive client
    Route::get('/setting-client/inactive/{id}', [SettingController::class, 'client_inactive'])->name('client-inactive');
    Route::get('/setting-client/active/{id}', [SettingController::class, 'client_active'])->name('client-active');
     // active & inactive branch
     Route::get('/setting-branch/inactive/{id}', [SettingController::class, 'branch_inactive'])->name('branch-inactive');
     Route::get('/setting-branch/active/{id}', [SettingController::class, 'branch_active'])->name('branch-active');

     // active & inactive region
     Route::get('/setting-region/inactive/{id}', [SettingController::class, 'region_inactive'])->name('region-inactive');
     Route::get('/setting-region/active/{id}', [SettingController::class, 'region_active'])->name('region-active');
    // active & inactive region
    Route::get('/setting-classes/inactive/{id}', [SettingController::class, 'classes_inactive'])->name('classes-inactive');
    Route::get('/setting-classes/active/{id}', [SettingController::class, 'classes_active'])->name('classes-active');
    // active & inactive region
    Route::get('/setting-type/inactive/{id}', [SettingController::class, 'type_inactive'])->name('type-inactive');
    Route::get('/setting-type/active/{id}', [SettingController::class, 'type_active'])->name('type-active');
    // active & inactive region
    Route::get('/setting-priority/inactive/{id}', [SettingController::class, 'priority_inactive'])->name('priority-inactive');
    Route::get('/setting-priority/active/{id}', [SettingController::class, 'priority_active'])->name('priority-active');
    // active & inactive region
    Route::get('/setting-condition/inactive/{id}', [SettingController::class, 'condition_inactive'])->name('condition-inactive');
    Route::get('/setting-condition/active/{id}', [SettingController::class, 'condition_active'])->name('condition-active');
    // active & inactive region
    Route::get('/setting-set-used/inactive/{id}', [SettingController::class, 'set_used_inactive'])->name('set-used-inactive');
    Route::get('/setting-set-used/active/{id}', [SettingController::class, 'set_used_active'])->name('set-used-active');
    // active & inactive road access
    Route::get('/set-road-access/inactive/{id}', [SettingController::class, 'road_access_inactive'])->name('road-access-inactive');
    Route::get('/set-road-access/active/{id}', [SettingController::class, 'road_access_active'])->name('road-access-active');
    // active & inactive job position
    Route::get('/job-position/inactive/{id}', [SettingController::class, 'job_position_inactive'])->name('job-position-inactive');
    Route::get('/job-position/active/{id}', [SettingController::class, 'job_position_active'])->name('job-position-active');
    // Route::get('/setting-user', [App\Http\Controllers\SettingUserController::class, 'index'])->name('setting-user');
    // Route::post('/assign-role', [App\Http\Controllers\SettingUserController::class, 'assignRole']);
    // Route::get('/setting-role', [App\Http\Controllers\SettingRoleController::class, 'index'])->name('setting-role');
    // Route::post('/add-user', [App\Http\Controllers\SettingUserController::class, 'addUser']);
    // Route::get('/setting-zone', [App\Http\Controllers\ZoneController::class, 'index'])->name('setting-zone');
    // Route::post('/deactivate-zone', [App\Http\Controllers\ZoneController::class, 'deactivate']);
    // Route::post('/activate-zone', [App\Http\Controllers\ZoneController::class, 'activate']);
    // Route::post('/store-zone', [App\Http\Controllers\ZoneController::class, 'store']);
    // Route::post('/update-zone', [App\Http\Controllers\ZoneController::class, 'update']);
    // Route::get('/setting-branch', [App\Http\Controllers\BranchController::class, 'index'])->name('setting-branch');
    // Route::post('/store-branch', [App\Http\Controllers\BranchController::class, 'store']);

    // Report
    Route::get('/download-customer', [ReportController::class, 'view_download_data_customer'])->name('download-report-customer');
    Route::post('/download-data-customer-xlsx', [ReportController::class, 'DownloadDataCustomer']);
    Route::get('/download-report', [ReportController::class, 'download_report_index'])->name('download-report');
    Route::post('/download-data-fix-xlsx', [ReportController::class, 'DownloadDataFix']);
    Route::get('/visit-report', [ReportController::class, 'visit_report_index'])->name('visit-report');
    Route::post('/visit-report-result', [ReportController::class, 'visit_report_result'])->name('visit-report-result');
    Route::get('/list-visit-report', [ReportController::class, 'visit_report_index']);
    Route::get('/achievement-report', [ReportController::class, 'achievement_report_index'])->name('achievement-report');
    Route::post('/achievement-report-result', [ReportController::class, 'achievement_report_result'])->name('achievement-report-result');
    Route::post('/achievement-report-resultx', [ReportController::class, 'achievement_report_resultx'])->name('achievement-report-resultx');
    Route::get('/outstanding-report', [ReportController::class, 'outstanding_report_index'])->name('outstanding-report');
    Route::post('/outstanding-report-result', [ReportController::class, 'outstanding_report_result'])->name('outstanding-report-result');
    Route::get('/transaction-report', [ReportController::class, 'transaction_report_index'])->name('transaction-report');
    Route::post('/transaction-report-result', [ReportController::class, 'transaction_report_result'])->name('transaction-report-result');
    Route::get('/cancel-transaction-report', [ReportController::class, 'cancel_transaction_report_index'])->name('cancel-transaction-report');
    Route::get('/cancel-transaction-report-result', [ReportController::class, 'cancel_transaction_report_result'])->name('cancel-transaction-report-result');
    Route::get('/pdf-report', [ReportController::class, 'download_pdf_report'])->name('pdf-report');
    Route::get('/pdf-lod', [ReportController::class, 'download_pdf_lod'])->name('pdf-lod');

    // Covis
    Route::get('/order-new-import', [CovisController::class, 'order_add_import'])->name('order-new-import');
    Route::post('/re-assign', [CovisController::class, 'reAssign']);
    Route::post('/customer-delete', [CovisController::class, 'customer_delete']);
    Route::get('/customer', [CovisController::class, 'customer_index'])->name('customer');
    Route::get('/customer-new-table', [CovisController::class, 'customer_new_search'])->name('customer.new.table');
    Route::get('/customer-search', [CovisController::class, 'customer_search'])->name('customer.search');
    Route::get('/customer-view/{id}', [CovisController::class, 'customer_view']);
    Route::put('/update-customer/{id}', [CovisController::class, 'updateCustomer']);
    Route::get('/customer-new', [CovisController::class, 'customer_add'])->name('customer-new');
    Route::get('/customer-new-import', [CovisController::class, 'customer_add_import'])->name('customer-new-import');
    Route::get('/transaction-request', [CovisController::class, 'transaction_request'])->name('transaction-request');
    Route::get('/transaction-request-view/{uuid}', [CovisController::class, 'transaction_request_view'])->name('transaction-request-view');
    Route::get('/transaction-confirmation', [CovisController::class, 'transaction_confirmation'])->name('transaction-confirmation');
    Route::get('/transaction-confirmation-view/{uuid}', [CovisController::class, 'transaction_confirmation_view'])->name('transaction-confirmation-view');
    Route::get('/transaction-approval', [CovisController::class, 'transaction_approval'])->name('transaction-approval');
    Route::get('/transaction-approval-view/{uuid}', [CovisController::class, 'transaction_approval_view'])->name('transaction-approval-view');
    Route::get('/transaction-request-complete', [CovisController::class, 'transaction_complete'])->name('transaction-request-complete');
    Route::get('/transaction-complete-view/{uuid}', [CovisController::class, 'transaction_complete_view'])->name('transaction-complete-view');
    Route::get('/transaction-revision', [CovisController::class, 'transaction_revision'])->name('transaction-revision');
    Route::post('/transaction-revision', [CovisController::class, 'transaction_customer_revision']);
    Route::get('/transaction-revision-view/{uuid}', [CovisController::class, 'transaction_revision_view'])->name('transaction-revision-view');
    
    Route::get('/transaction-cancel', [CovisController::class, 'transaction_cancel'])->name('transaction-cancel');
    
    Route::post('/transaction-order-cancel', [CovisController::class, 'transaction_order_cancel']);
    
    Route::get('/print-transaction/{id}', [CovisController::class, 'printTransaction'])->name('print-transaction');

    // Action (to be confirm => waiting approval)
    Route::post('/transaction-confirmation-to-waiting-approval', [CovisController::class, 'transaction_to_be_confirm_to_waiting_approval'])->name('transaction-waiting-approval');
    Route::post('/transaction-waiting-approval-to-approval', [CovisController::class, 'transaction_waiting_approval_to_approval'])->name('transaction-approval');


    // Covis POST
    Route::post('/post-customer', [CovisController::class, 'postCustomer']);
    Route::post('/post-customer-request', [CovisController::class, 'storeTransaction']);

    // Personnel
    Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel');
    Route::get('/personnel-view/{id}', [PersonnelController::class, 'view'])->name('personnel-view');
    Route::get('/personnel-view-detail/{id}', [PersonnelController::class, 'view_detail'])->name('personnel-view-detail');

    // user lod
    Route::post('/create/user-lod', [PersonnelController::class, 'userLodStore'])->name('user-lod');



    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('/post-change-password', [App\Http\Controllers\ProfileController::class, 'postChangePassword']);
    Route::post('/update-phone', [App\Http\Controllers\ProfileController::class, 'updatePhone']);
    Route::post('/update-profil-image', [App\Http\Controllers\ProfileController::class, 'updateProfilImage'])->name('update-profil-image');


    // list user
    Route::get('/change-password-list-user/{id}', [App\Http\Controllers\SettingController::class, 'changePasswordListUser'])->name('change-password-set-user');
    Route::post('/post-change-password-list-user/{id}', [App\Http\Controllers\SettingController::class, 'postChangeListUserPassword'])->name('post-password-set-user');

    // Knowledgebase
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/terms-policy', [TermPolicyController::class, 'index'])->name('terms-policy');

    //

    // backdate
    Route::post('/transaction-backdate', [CovisController::class, 'transactionBackdate']);


    // bulk apprve
    Route::post('confirmAllTransaction', [CovisController::class, 'confirmAll']);
    //  confirm
    Route::post('confirmationAllTransaction', [CovisController::class, 'confirmationAll']);
    // import customer excel
    Route::post('import', [CovisController::class, 'importCustomerExcel'])->name('import-customer-excel');
    Route::post('import-order', [CovisController::class, 'importOrderExcel'])->name('import-order-excel');
    Route::post('update-note-customer', [CovisController::class, 'updateNoteCustomer'])->name('update-note-customer');

    Route::post('get-transaction-completed', [CovisController::class, 'filterTransactionComplete']);


});

require __DIR__.'/auth.php';
