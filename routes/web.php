<?php

use App\Http\Controllers\AppManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanMangementController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ReportController;
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
Route::get('/forgot-password', [AuthController::class, 'forgotpassword'])->name('auth.forgot-password');
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
Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.home');

Route::get('/customer-list', [LoanMangementController::class, 'customerList'])->name('pages.customerlist');

Route::get('/loan-list', [LoanMangementController::class, 'loanList'])->name('pages.loanlist');

Route::get('/transactions', [LoanMangementController::class, 'transactions'])->name('pages.transactions');

Route::get('/borrow-history', [LoanMangementController::class, 'borrowHistory'])->name('pages.borrowhistory');

Route::get('/task-list', [TasksController::class, 'TaskList'])->name('pages.tasklist');
Route::get('/task-create', [TasksController::class, 'TaskCreate'])->name('pages.taskcreate');
Route::post('/task-create', [TasksController::class, 'TaskCreateStore']);
Route::post('/task-delete/{id}', [TasksController::class, 'TaskDelete']);
Route::post('/task-suspend/{id}', [TasksController::class, 'TaskSupend']);
Route::post('/task-complete/{id}', [TasksController::class, 'TaskComplete']);

Route::get('/marketing', [MarketingController::class, 'marketing'])->name('pages.marketing');

Route::get('/user-list', [UsersController::class, 'UserListView'])->name('pages.userlist');

Route::get('/role-list', [UsersController::class, 'UserRoleList'])->name('pages.rolelist');

Route::get('/create-user', [UsersController::class, 'UserCreate'])->name('pages.userCreate');

Route::get('/create-role', [UsersController::class, 'CreateUserRole'])->name('pages.createuserole');

Route::get('/permission-list', [UsersController::class, 'PermissionList'])->name('pages.permissionlist');

Route::get('/privacy-policy', [AppManagementController::class, 'PrivacyPolicy'])->name('pages.privacypolicy');
Route::post('/privacy-policy', [AppManagementController::class, 'PrivacyPolicyStore']);
Route::get('/privacy-policy-edit/{id}', [AppManagementController::class, 'PrivacyPolicyEdit']);
Route::put('/privacy-policy-edit/{id}', [AppManagementController::class, 'PrivacyPolicyEditStore']);
Route::get('/create-policy', [AppManagementController::class, 'PrivacyPolicyCreate']);
Route::get('/privacy-policy-delete', [AppManagementController::class, 'PrivacyPolicyDelete']);

Route::get('/disclosure', [AppManagementController::class, 'Disclosure'])->name('pages.disclosure');
Route::post('/disclosure', [AppManagementController::class, 'DisclosureCreateStore']);
Route::get('/disclosure-edit/{id}', [AppManagementController::class, 'DisclosureEdit']);
Route::put('/disclosure-edit/{id}', [AppManagementController::class, 'DisclosureEditStore']);
Route::get('/disclosure-create', [AppManagementController::class, 'DisclosureCreate']);
Route::get('/disclosure-delete', [AppManagementController::class, 'DisclosureDelete']);

Route::get('/why-choose-us', [AppManagementController::class, 'WhyChooseUs'])->name('pages.whychooseeus');
Route::post('/why-choose-us', [AppManagementController::class, 'WhyChooseUsStore']);
Route::get('/why-choose-us-edit/{id}', [AppManagementController::class, 'WhyChooseUsEdit']);
Route::put('/why-choose-us-edit/{id}', [AppManagementController::class, 'WhyChooseUsEditStore']);
Route::get('/why-choose-us-create', [AppManagementController::class, 'WhyChooseUsCreate']);
Route::get('/why-choose-us-delete', [AppManagementController::class, 'WhyChooseUsDelete']);

Route::get('/faq', [AppManagementController::class, 'Faq'])->name('pages.faq');
Route::get('/faq-create', [AppManagementController::class, 'FaqCreate']);
Route::post('/faq-create', [AppManagementController::class, 'FaqCreateStore']);
Route::get('/faq-edit/{id}', [AppManagementController::class, 'FaqEdit']);
Route::post('/faq-edit/{id}', [AppManagementController::class, 'FaqEditStore']);
Route::post('/faq-delete', [AppManagementController::class, 'FaqDelete']);

Route::get('/about-us', [AppManagementController::class, 'AboutUs'])->name('pages.aboutus');
Route::get('/about-us-create', [AppManagementController::class, 'AboutUsCreate']);
Route::post('/about-us-create', [AppManagementController::class, 'AboutUsCreateStore']);
Route::get('/about-us-edit/{id}', [AppManagementController::class, 'AboutUsEdit']);
Route::post('/about-us-edit/{id}', [AppManagementController::class, 'AboutUsEditStore']);
Route::get('/about-us-delete', [AppManagementController::class, 'AboutUsDelete']);

Route::get('/support', [AppManagementController::class, 'Support'])->name('pages.support');
Route::get('/support-create', [AppManagementController::class, 'SupportCreate']);
Route::post('/support-create', [AppManagementController::class, 'SupportCreateStore']);
Route::get('/support-edit/{id}', [AppManagementController::class, 'SupportEdit']);
Route::post('/support-edit/{id}', [AppManagementController::class, 'SupportEditStore']);
Route::get('/support-delete/{id}', [AppManagementController::class, 'SupportDelete']);

Route::get('/setting', [SettingController::class, 'Setting'])->name('pages.setting');
Route::get('/profile-setting', [SettingController::class, 'profileSetting'])->name('pages.custom-report');

Route::get('/marketing', [MarketingController::class, 'Marketing'])->name('pages.setting');

Route::get('/change-permission', [SettingController::class, 'ChangePermissionIndex'])->name('pages.change-permission');
Route::get('/change-permission-index', [SettingController::class, 'ChangePermissionStore'])->name('pages.permission-store');

Route::get('/user-report', [ReportController::class, 'UserReport'])->name('pages.user-report');

Route::get('/app-report', [ReportController::class, 'AppReport'])->name('pages.app-report');

Route::get('/custom-report', [ReportController::class, 'CustomReport'])->name('pages.custom-report');
