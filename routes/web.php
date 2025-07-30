<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\AppManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanMangementController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RolePermission;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/*Route::get('/', function () {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/', [AuthController::class, 'loginDetail']);
Route::get('/forgot-password', [AuthController::class, 'forgotpassword'])->name('auth.forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('auth.send-link');
Route::get('/confirm-password', [AuthController::class, 'confirmpassword'])->name('auth.confirm-password');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.home');

    ///**************** Customer  ************/
    Route::get('/customer-list', [LoanMangementController::class, 'customerList'])->name('pages.customerlist');
    Route::post('/customer-create', [LoanMangementController::class, 'customerCreate'])->name('pages.customercreate');
    Route::get('/customer-delete/{id}', [LoanMangementController::class, 'customerDelete'])->name('pages.customerdelete');
    Route::get('/customer-update/{id}', [LoanMangementController::class, 'customerUpdate'])->name('pages.customerupdate');
    Route::get('/customer-profile/{id}', [LoanMangementController::class, 'customerProfile'])->name('pages.customerprofile');

    ///*************** Loan Management ************/
    Route::get('/loan-list', [LoanMangementController::class, 'loanList'])->name('pages.loanlist');
    Route::get('/loan-create', [LoanMangementController::class, 'loanCreate'])->name('pages.loancreate');
    Route::post('/add-newloan', [LoanMangementController::class, 'loanCreateStore']);
    Route::get('/loan-view/{id}', [LoanMangementController::class, 'loanView']);
    Route::get('/transactions', [LoanMangementController::class, 'transactions'])->name('pages.transactions');
    Route::get('/collect_transactions', [LoanMangementController::class, 'collectTransactions'])->name('pages.collect_transactions');
    Route::get('/borrow-history', [LoanMangementController::class, 'borrowHistory'])->name('pages.borrowhistory');
    Route::get('/loan-collection-group', [LoanMangementController::class, 'LoanCollectionGroup'])->name('pages.loancollection');
    Route::get('/add-collection-group-index', [LoanMangementController::class, 'AddCollectionGroupIndex'])->name('pages.addcollectionindex');
    Route::post('/add-collection-group', [LoanMangementController::class, 'AddCollectionGroup'])->name('pages.addcollection');
    Route::get('/loan-penalty', [LoanMangementController::class, 'LoanPenalty'])->name('pages.loanpenalty');
    Route::get('/repayments', [LoanMangementController::class, 'Repayments'])->name('pages.repayments');

    ///*************** Task Management ****************/
    Route::get('/task-list', [TasksController::class, 'TaskList'])->name('pages.tasklist');
    Route::get('/task-create', [TasksController::class, 'TaskCreate'])->name('pages.taskcreate');
    Route::post('/task-create', [TasksController::class, 'TaskCreateStore']);
    Route::get('/task-delete/{id}', [TasksController::class, 'TaskDelete']);
    Route::get('/task-edit/{id}', [TasksController::class, 'TaskEdit'])->name('pages.taskedit');
    Route::put('/task-edit/{id}', [TasksController::class, 'TaskEditStore']);
    Route::post('/task-suspend/{id}', [TasksController::class, 'TaskSupend']);
    Route::post('/task-complete/{id}', [TasksController::class, 'TaskComplete']);

    ///****************************** Marketing *************************************/
    //Route::get('/marketing', [MarketingController::class, 'marketing'])->name('pages.marketing');
    Route::get('/marketing', [MarketingController::class, 'Marketing'])->name('pages.setting');

    ///***************************************** User Management Module ********************/
    Route::get('/user-list', [UsersController::class, 'UserListView'])->name('pages.userlist');
    Route::get('/user-profile/{id}', [UsersController::class, 'UserProfileView'])->name('pages.userprofile');
    Route::put('/user-profile-update/{id}', [UsersController::class, 'UserProfileUpdate'])->name('pages.userUpdate');
    Route::get('/role-list', [RolePermission::class, 'UserRoleList'])->name('pages.rolelist');
    Route::get('/create-user', [UsersController::class, 'CreateUser'])->name('pages.userCreate');
    Route::post('/create-user', [UsersController::class, 'CreateUserStoreData']);
    Route::get('/create-role', [UsersController::class, 'CreateUserRole'])->name('pages.createuserole');
    Route::get('/delete-permission/{id}', [UsersController::class, 'DeleteUserRole'])->name('pages.createuserole');
    Route::post('/create-new-role', [RolePermission::class, 'CreateUserRoleStore']);
    Route::get('/permission-list', [UsersController::class, 'PermissionList'])->name('pages.permissionlist');
    Route::get('/change-permission', [SettingController::class, 'ChangePermissionIndex'])->name('pages.change-permission');
    Route::get('/change-permission-index', [SettingController::class, 'ChangePermissionStore'])->name('pages.permission-store');
    Route::get('/user-logs', [SettingController::class, 'UserLogsIndex'])->name('pages.user-logs');

    ///************************************ App Management *******************/
    Route::get('/privacy-policy', [AppManagementController::class, 'PrivacyPolicy'])->name('pages.privacypolicy');
    Route::post('/privacy-policy', [AppManagementController::class, 'PrivacyPolicyStore']);
    Route::get('/privacy-policy-edit/{id}', [AppManagementController::class, 'PrivacyPolicyEdit']);
    Route::put('/privacy-policy-edit/{id}', [AppManagementController::class, 'PrivacyPolicyEditStore']);
    Route::get('/create-policy', [AppManagementController::class, 'PrivacyPolicyCreate']);
    Route::get('/privacy-policy-delete', [AppManagementController::class, 'PrivacyPolicyDelete']);

    ///------------------- Disclosure ----------------------------///
    Route::get('/disclosure', [AppManagementController::class, 'Disclosure'])->name('pages.disclosure');
    Route::post('/disclosure', [AppManagementController::class, 'DisclosureCreateStore']);
    Route::get('/disclosure-edit/{id}', [AppManagementController::class, 'DisclosureEdit']);
    Route::put('/disclosure-edit/{id}', [AppManagementController::class, 'DisclosureEditStore']);
    Route::get('/disclosure-create', [AppManagementController::class, 'DisclosureCreate']);
    Route::get('/disclosure-delete', [AppManagementController::class, 'DisclosureDelete']);

    ///----------------------------Why Choose Us -------------------///
    Route::get('/why-choose-us', [AppManagementController::class, 'WhyChooseUs'])->name('pages.whychooseeus');
    Route::post('/why-choose-us', [AppManagementController::class, 'WhyChooseUsStore']);
    Route::get('/why-choose-us-edit/{id}', [AppManagementController::class, 'WhyChooseUsEdit']);
    Route::put('/why-choose-us-edit/{id}', [AppManagementController::class, 'WhyChooseUsEditStore']);
    Route::get('/why-choose-us-create', [AppManagementController::class, 'WhyChooseUsCreate']);
    Route::get('/why-choose-us-delete', [AppManagementController::class, 'WhyChooseUsDelete']);

    ///------------------------Why FAQ -------------------------///
    Route::get('/faq', [AppManagementController::class, 'Faq'])->name('pages.faq');
    Route::get('/faq-create', [AppManagementController::class, 'FaqCreate']);
    Route::post('/faq-create', [AppManagementController::class, 'FaqCreateStore']);
    Route::get('/faq-edit/{id}', [AppManagementController::class, 'FaqEdit']);
    Route::post('/faq-edit/{id}', [AppManagementController::class, 'FaqEditStore']);
    Route::post('/faq-delete', [AppManagementController::class, 'FaqDelete']);

    ///------------------------About Us----------------------------///
    Route::get('/about-us', [AppManagementController::class, 'AboutUs'])->name('pages.aboutus');
    Route::get('/about-us-create', [AppManagementController::class, 'AboutUsCreate']);
    Route::post('/about-us-create', [AppManagementController::class, 'AboutUsCreateStore']);
    Route::get('/about-us-edit/{id}', [AppManagementController::class, 'AboutUsEdit']);
    Route::post('/about-us-edit/{id}', [AppManagementController::class, 'AboutUsEditStore']);
    Route::get('/about-us-delete', [AppManagementController::class, 'AboutUsDelete']);

    ///--------------------------Accounting--------------------------------///
    Route::get('/company-income', [AccountingController::class, 'indexIncome']);
    Route::get('/company-expenses', [AccountingController::class, 'indexExpenses']);
    Route::post('/company-expenses', [AccountingController::class, 'indexExpensesStore']);
    Route::get('/company-target', [AccountingController::class, 'indexTarget']);
    Route::get('/create-target', [AccountingController::class, 'createTarget']);
    Route::post('/create-target', [AccountingController::class, 'createTargetStore']);
    Route::get('/create-expenses', [AccountingController::class, 'createExpense']);

    ///--------------------------Support-----------------------------///
    Route::get('/support', [AppManagementController::class, 'Support'])->name('pages.support');
    Route::get('/support-create', [AppManagementController::class, 'SupportCreate']);
    Route::post('/support-create', [AppManagementController::class, 'SupportCreateStore']);
    Route::get('/support-edit/{id}', [AppManagementController::class, 'SupportEdit']);
    Route::post('/support-edit/{id}', [AppManagementController::class, 'SupportEditStore']);
    Route::get('/support-delete/{id}', [AppManagementController::class, 'SupportDelete']);

    ///******************************* Setting *********************************///
    Route::get('/setting', [SettingController::class, 'Setting'])->name('pages.setting');
    Route::get('/loan_setting', [SettingController::class, 'loanSetting'])->name('pages.loansetting');
    Route::post('/loan_setting/{id}', [SettingController::class, 'loanSettingStore']);
    Route::get('/profile-setting', [SettingController::class, 'profileSetting'])->name('pages.custom-report');
    Route::get('/profile/{id}', [SettingController::class, 'profileView']);
    Route::get('/push-notify', [SettingController::class, 'pushNotification']);

    ///*************************** User Report *************************/
    Route::get('/user-report', [ReportController::class, 'UserReport'])->name('pages.user-report');
    Route::get('/app-report', [ReportController::class, 'AppReport'])->name('pages.app-report');
    Route::get('/custom-report', [ReportController::class, 'CustomReport'])->name('pages.custom-report');
    Route::get('/npl-report', [ReportController::class, 'nplReport'])->name('pages.npl-report');

    ///*************************** User Report *************************/
    Route::get('/test-sms', function () {
        $reponse = app('beem-sms')->sendSMS(
            'This is the test sms',
            '0656122491'
        );
        return response()->json($reponse);
    });

    Route::get('/test-sms', function () {
        $reponse = app('beem-sms')->getBalance();
        return response()->json($reponse);
    });

    ///*************************** User Logout *************************/
    Route::post('/logout', [AuthController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');
});
