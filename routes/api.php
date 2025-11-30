<?php

use App\Http\Controllers\API\V1\CMS\ContactUsPageController;
use App\Http\Controllers\API\V1\CMS\HomePageController;
use App\Http\Controllers\API\V1\CMS\IntroPageController;
use App\Http\Controllers\API\V1\CMS\ServicePageController;
use App\Http\Controllers\API\V1\User\OrderController;
use App\Http\Controllers\API\V1\User\ServiceController;
use App\Http\Controllers\API\V1\User\UserContactSupportController;
use Illuminate\Support\Facades\Route;



// witout auth
Route::post('/contact-support-message/sent', [UserContactSupportController::class, 'store']);

// --------- cms part --------------
Route::get('/cms/social-link', [HomePageController::class, 'getSocialLinks']);
Route::get('/cms/system-info', [HomePageController::class, 'getSystemInfo']);

// dynamic page
Route::get('dynamic-pages', [HomePageController::class, 'getDynamicPages']);
Route::get('dynamic-pages/single/{slug}', [HomePageController::class, 'showDaynamicPage']);

// route for home page
Route::group(['prefix' => 'cms'], function () {
    //intro page
    Route::get('/intro-page/intro-video', [IntroPageController::class, 'getIntroVideo']);
    Route::get('/intro-page/intro-section', [IntroPageController::class, 'getIntroSection']);
    // home page
    Route::get('/home-page/hero-section', [HomePageController::class, 'getHeroSection']);
    Route::get('/home-page/service-section', [HomePageController::class, 'getServiceSection']);

    // service page
    Route::get('/service-page/hero-section', [ServicePageController::class, 'getHeroSection']);
    Route::get('/service-page/service-section', [ServicePageController::class, 'getServiceSection']);
    // contact us page
    Route::get('/contact-us-page/hero-section', [ContactUsPageController::class, 'getHeroSection']);
    Route::get('/contact-us-page/contact-section', [ContactUsPageController::class, 'getContactSection']);
});

//order routes
Route::apiResource('/orders', OrderController::class)->only(['index', 'store', 'show']);

//service routes
Route::apiResource('/services', ServiceController::class)->only(['show']);


