<?php

use App\Http\Controllers\API\AppManageApiController;
use App\Http\Controllers\LoanMangementController;
use App\Http\Controllers\OtpController;
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
    Route::get('/privacypolicy', [AppManageApiController::class, 'privacyPolicy']);
    Route::get('/disclosure', [AppManageApiController::class, 'Disclosure']);
    Route::get('/whychooseus', [AppManageApiController::class, 'whyChooseus']);
    Route::get('/faq', [AppManageApiController::class, 'Faq']);
    Route::get('/aboutus', [AppManageApiController::class, 'AboutUs']);
    Route::get('/support', [AppManageApiController::class, 'Support']);
    Route::post('/send-otp', [OtpController::class, 'sendOtp']);
    Route::post('/test-otp', [OtpController::class, 'sendOtpNow']);
    Route::get('/applogin', [LoanMangementController::class, 'appLoginByPhone']);
});
