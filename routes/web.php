<?php

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    /*----------------------------Customer -------------------------------*/
    Route::get('/loan/customer', [App\Http\Controllers\LoanController::class, 'index'])->name('loan.customer');
    Route::get('/loan/create', [App\Http\Controllers\LoanController::class, 'create'])->name('loan.create');
    Route::get('/loan/customize', [App\Http\Controllers\LoanController::class, 'index'])->name('loan.customize');
    /*---------------------Task Controller------------------------- */
    Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('task.show');
    Route::get('/task/task_create', [App\Http\Controllers\TaskController::class, 'create'])->name('task.create');
    Route::post('/task/task_create', [App\Http\Controllers\TaskController::class, 'taskcreateStore']);
    Route::get('task/task_edit/{id}', [App\Http\Controllers\TaskController::class, 'taskEdit'])->name('task.edit');
    Route::post('task/task_edit/{id}', [App\Http\Controllers\TaskController::class, 'taskEditStore']);
    Route::delete('/task/task_delete/{id}', [App\Http\Controllers\TaskController::class, 'taskDestroy'])->name('task.delete');
    /*------------------------Marketing ----------------------------*/
    Route::get('/marketing', [App\Http\Controllers\MarketController::class, 'index'])->name('marketing.show');

    /*------------------------User Controller------------------------*/
    Route::get('/user/systemuser', [App\Http\Controllers\UsersController::class, 'index'])->name('user.systemuser');
    Route::get('/user/add_user', [App\Http\Controllers\UsersController::class, 'newuser'])->name('user.newuser');
    Route::post('/user/add_user', [App\Http\Controllers\UsersController::class, 'newuserCreate']);
    Route::get('/system_user_profile/{id}', [App\Http\Controllers\UsersController::class, 'systemUserProfile'])->name('user.systemuserprofile');
    Route::put('/system_user_update_1/{id}', [App\Http\Controllers\UsersController::class, 'systemUserProfileView'])->name('user.systemuserprofileview');
    Route::get('/system_user_update_2/{id}', [App\Http\Controllers\UsersController::class, 'systemUserProfilePass'])->name('user.systemuserprofilepass');
    Route::put('/system_user_update_2/{id}', [App\Http\Controllers\UsersController::class, 'systemUserProfilePassword'])->name('user.systemuserprofilepassword');


    /*------------------------App Setting------------------------*/
    Route::get('/app/policy', [App\Http\Controllers\AppSettingController::class, 'policy'])->name('app.policy');
    Route::get('/app/policy_create', [App\Http\Controllers\AppSettingController::class, 'policyCreate'])->name('app.policyCreate');
    Route::post('/app/policy_create', [App\Http\Controllers\AppSettingController::class, 'policyCreateStore']);
    Route::get('/app/policy_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'policyEdit'])->name('app.policyEdit');
    Route::post('/app/policy_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'policyEditStore']);
    Route::get('/app/policy_delete/{id}', [App\Http\Controllers\AppSettingController::class, 'policy'])->name('app.policyDelete');


    Route::get('/app/disclosure_create', [App\Http\Controllers\AppSettingController::class, 'disclosureCreate'])->name('app.disclosurecreate');
    Route::get('/app/disclosure_statement', [App\Http\Controllers\AppSettingController::class, 'disclosure'])->name('app.disclosure');
    Route::post('/app/disclosure_statement', [App\Http\Controllers\AppSettingController::class, 'disclosureData']);
    Route::post('/app/disclosure_delete/{id}', [App\Http\Controllers\AppSettingController::class, 'disclosureDelete']);
    Route::get('/disclosure_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'disclosureEdit']);
    Route::put('/disclosure_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'disclosureEditUpdate']);


    Route::get('/app/whychoose_us', [App\Http\Controllers\AppSettingController::class, 'whychoose_us'])->name('app.whychooseus');
    Route::get('/app/whychoose_us_create', [App\Http\Controllers\AppSettingController::class, 'whychooseCreate'])->name('app.whychooseCreate');
    Route::post('/app/whychoose_us_create', [App\Http\Controllers\AppSettingController::class, 'whychooseStore']);
    Route::get('/app/whychoose_us_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'whychooseEdit'])->name('app.whychooseEdit');
    Route::post('/app/whychoose_us_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'whychooseEditStore']);

    Route::get('/app/faq', [App\Http\Controllers\AppSettingController::class, 'faq'])->name('app.faq');
    Route::get('/app/faq_create', [App\Http\Controllers\AppSettingController::class, 'faqCreate'])->name('app.faqcreate');
    Route::post('/app/faq_create', [App\Http\Controllers\AppSettingController::class, 'faqCreateStore']);
    Route::get('/app/faq_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'faqEdit'])->name('app.faqedit');
    Route::post('/app/faq_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'faqEditStore']);
    Route::get('/app/faq_delete/{id}', [App\Http\Controllers\AppSettingController::class, 'faqDelete'])->name('app.faqdelete');

    Route::get('/app/about_us', [App\Http\Controllers\AppSettingController::class, 'aboutus'])->name('app.aboutus');
    Route::get('/app/about_us_create', [App\Http\Controllers\AppSettingController::class, 'aboutusCreate'])->name('app.aboutuscreate');
    Route::post('/app/about_us_create', [App\Http\Controllers\AppSettingController::class, 'aboutusCreateStore']);
    Route::get('/app/about_us_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'aboutusEdit'])->name('app.aboutusedit');
    Route::post('/app/about_us_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'aboutusEditUpdate']);
    Route::post('/app/about_us_delete/{id}', [App\Http\Controllers\AppSettingController::class, 'aboutusDelete']);


    Route::get('/app/support', [App\Http\Controllers\AppSettingController::class, 'customersupport'])->name('app.support');
    Route::get('/app/support_create', [App\Http\Controllers\AppSettingController::class, 'customersupportCreate'])->name('app.supportcreate');
    Route::post('/app/support_create', [App\Http\Controllers\AppSettingController::class, 'customersupportCreateStore']);
    Route::get('/app/support_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'customersupportEdit'])->name('app.supportedit');
    Route::post('/app/support_edit/{id}', [App\Http\Controllers\AppSettingController::class, 'customersupportEditStore']);
    Route::get('/app/support_delete/{id}', [App\Http\Controllers\AppSettingController::class, 'customersupportDelete'])->name('app.supportdelete');
    Route::post('/app/support_delete/{id}', [App\Http\Controllers\AppSettingController::class, 'customersupportDeleteStore']);

    /*-------------------------Setting--------------------------------*/
    Route::get('/setting/general', [App\Http\Controllers\SystemSettingController::class, 'index'])->name('setting.general');
    Route::get('/setting/profile', [App\Http\Controllers\SystemSettingController::class, 'viewprofile'])->name('setting.profile');
    Route::get('/setting/rolepermission', [App\Http\Controllers\SystemSettingController::class, 'rolepermission'])->name('setting.rolepermission');
    Route::get('/setting/role_create', [App\Http\Controllers\SystemSettingController::class, 'roleCreate'])->name('setting.rolecreate');
    Route::post('/setting/role_create', [App\Http\Controllers\SystemSettingController::class, 'roleCreateStore']);
    //Route::post('/setting/role_create', [App\Http\Controllers\SystemSettingController::class, 'roleCreate'])->name('setting.rolecreate');
    Route::get('/setting/change_permission/{id}', [App\Http\Controllers\SystemSettingController::class, 'ChangePermission'])->name('setting.permissionview');
    Route::post('/setting/set_permission', [App\Http\Controllers\SystemSettingController::class, 'ChangePermissionStore'])->name('setting.changepermission');
    Route::get('/setting/role_delete/{id}', [App\Http\Controllers\SystemSettingController::class, 'roleDelete'])->name('setting.roledelete');

    /*--------------------Report ---------------------------------------*/
    Route::get('/report/system', [App\Http\Controllers\ReportController::class, 'systemreport'])->name('report.sysytem');
    Route::get('/report/app', [App\Http\Controllers\ReportController::class, 'appreport'])->name('report.app');
})->name('auth');
