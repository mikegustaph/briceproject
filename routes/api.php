<?php

use App\Http\Controllers\API\AppManageApiController;
use App\Http\Controllers\API\LoanApiController;
use App\Http\Controllers\LoanMangementController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AzamPayController;
use App\Http\Controllers\API\AzamPayAuthController;
use App\Http\Controllers\BeemController;
use App\Http\Controllers\PayController;
use App\Services\AzamPayService;
use App\Services\PayServices;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::get('/privacy-policy', [AppManageApiController::class, 'privacyPolicy']);
    Route::get('/disclosure', [AppManageApiController::class, 'Disclosure']);
    Route::get('/whychooseus', [AppManageApiController::class, 'whyChooseus']);
    Route::get('/faq', [AppManageApiController::class, 'Faq']);
    Route::get('/aboutus', [AppManageApiController::class, 'AboutUs']);
    Route::get('/support', [AppManageApiController::class, 'Support']);
    Route::post('/send-otp', [OtpController::class, 'sendOtp']);
    Route::post('/test-otp', [OtpController::class, 'sendOtpNow']);
    ///Settings for loan
    Route::get('/loan-setting', [LoanApiController::class, 'settheLoan']);
    Route::post('/setting-fromapp', [LoanApiController::class, 'settingFrmApp']);
    Route::post('/save-push-notify', [SettingController::class, 'savePushNotification']);

    ///Api customer login using otp
    Route::post('/applogin', [LoanApiController::class, 'appLoginByPhone']);
    Route::post('/checkuser', [LoanApiController::class, 'checkUser']);
    Route::post('/customer-info', [LoanApiController::class, 'AddUserCustomerInfo']);
    Route::post('/fetch-customer', [LoanApiController::class, 'fetchCustomer']);
    /// This fetch all personal information
    Route::post('/customer-info-display', [LoanApiController::class, 'checkCustomerInfo']);

    ///Check Credit Score and Loan Limit
    Route::post('/creditscore', [LoanApiController::class, 'checkCreditScore']);
    Route::post('/loanpost', [LoanApiController::class, 'storeNewLoan']);
    Route::post('/check-userloan', [LoanApiController::class, 'checkLoanStatusByPhone']);
    ///Customer Repay Loan
    Route::post('/repayloan', [LoanApiController::class, 'repayLoan']);
    Route::post('/approve_loan', [LoanApiController::class, 'approveLoan']);
    Route::post('/loanhistory', [LoanApiController::class, 'loanHistory']);

    /******************** Azam Pay *************/
    //Route::post('/token', [PayController::class, 'getPayToken']);
    //Route::post('/paytoken', [PayServices::class, 'generateToken']);
    Route::post('/mnocheckout', [\App\Http\Controllers\PayController::class, 'mnoCheckout']);
    Route::post('/disburse', [\App\Http\Controllers\PayController::class, 'disbursePayment']);
    Route::post('/callback', [\App\Http\Controllers\PayController::class, 'PayCallback']);
    Route::post('/checkname', [\App\Http\Controllers\PayController::class, 'nameLookUp']);

    /******************* Send SMS **************/
    Route::get('/yourbalance', [BeemController::class, 'checkYourBalance']);
    Route::post('/sendotp', [BeemController::class, 'sendTestSms']);
});
