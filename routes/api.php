<?php

use App\Http\Controllers\API\V1\AppAboutController;
use App\Http\Controllers\API\V1\AppFaqController;
use App\Http\Controllers\API\V1\AppPrivacyController;
use App\Http\Controllers\API\V1\AppSupportController;
use App\Http\Controllers\API\V1\AppWhychooseController;
use App\Http\Controllers\API\V1\AppAuthController;
use App\Http\Controllers\API\V1\CustomerController;
use App\Http\Controllers\API\V1\DisclosureController;
use App\Http\Controllers\API\V1\MainAppSettingController;
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

    //Route::resource('disclosures', DisclosureController::class);
    /*Route::resource('privacy', AppPrivacyController::class,);
    Route::resource('whychoose', AppWhychooseController::class);
    Route::resource('faq', AppFaqController::class);
    Route::resource('about', AppAboutController::class);
    Route::resource('support', AppSupportController::class);
    Route::resource('customer', CustomerController::class);*/
    Route::get('/disclosures', [DisclosureController::class, 'disclosure']);
    Route::post('/verify_phone', [AppAuthController::class, 'verifyphone']);
    Route::post('/sent_', [AppAuthController::class, 'sendOtp']);
    Route::post('/register_for_loan', [AppAuthController::class, 'customerregister']);
});
