<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Auth\SocialLoginController;
use App\Http\Controllers\API\Auth\UserController;
use App\Http\Controllers\API\V1\CMS\HomePageController;
use App\Http\Controllers\API\V1\User\NotificationController;
use App\Http\Controllers\API\V1\User\UserContactSupportController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:api'], function ($router) {
    // register
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('/verify-email', [RegisterController::class, 'VerifyEmail']);
    Route::post('/resend-otp', [RegisterController::class, 'ResendOtp']);
    // login
    Route::post('login', [LoginController::class, 'login']);
    // forgot password
    Route::post('/forget-password', [ResetPasswordController::class, 'forgotPassword']);
    Route::post('/verify-otp', [ResetPasswordController::class, 'VerifyOTP']);
    Route::post('/reset-password', [ResetPasswordController::class, 'ResetPassword']);
    // social login
    Route::post('/social-login', [SocialLoginController::class, 'SocialLogin']);
});

Route::group(['middleware' => 'auth:api'], function ($router) {
    Route::get('/refresh-token', [LoginController::class, 'refreshToken']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/update-password', [UserController::class, 'changePassword']);
});

// only for user
Route::group(['middleware' => ['auth:api', 'check_is_user']], function ($router) {
    // Notifications route
    Route::get('/my-notifications', [NotificationController::class, 'index']);
    Route::post('/my-notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::delete('/my-notifications-delete/{id}', [NotificationController::class, 'delete']);
    Route::delete('/my-notifications-delete-all', [NotificationController::class, 'deleteAll']);
});

// witout auth
Route::post('/contact-support-message/sent', [UserContactSupportController::class, 'store']);

// --------- cms part --------------
Route::get('/cms/social-link', [HomePageController::class, 'getSocialLinks']);
Route::get('/cms/system-info', [HomePageController::class, 'getSystemInfo']);

// dynamic page
Route::get('dynamic-pages', [HomePageController::class, 'getDynamicPages']);
Route::get('dynamic-pages/single/{slug}', [HomePageController::class, 'showDaynamicPage']);

// route for home page
Route::group(['prefix' => 'cms/home-page'], function () {
    Route::get('/hero-section', [HomePageController::class, 'getHeroSection']);
    Route::get('/service-section', [HomePageController::class, 'getServiceSection']);
    Route::get('/about-section', [HomePageController::class, 'getAboutUsSection']);
    Route::get('/quick-rate-section', [HomePageController::class, 'getQuickRateCheckSection']);
    Route::get('/work-process-section', [HomePageController::class, 'getWorkProcessSection']);
    Route::get('/faq-section', [HomePageController::class, 'getFaqSection']);
    Route::get('/testimonial-section', [HomePageController::class, 'getTestimonialSection']);
    Route::get('/custom-text-section', [HomePageController::class, 'getCustomTextSection']);
});

