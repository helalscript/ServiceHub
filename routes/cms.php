<?php

use App\Http\Controllers\Web\Backend\CMS\ContactUsPageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageServiceController;
use App\Http\Controllers\Web\Backend\CMS\HomePageWorkProcessController;
use App\Http\Controllers\Web\Backend\CMS\HomeTestimonialController;
use App\Http\Controllers\Web\Backend\CMS\IntroPageController;
use App\Http\Controllers\Web\Backend\CMS\ServicePageController;
use Illuminate\Support\Facades\Route;

Route::prefix('cms')->name('cms.')->group(function () {
    // ===================== CMS HOME PAGE =====================
    Route::prefix('home-page')->name('home_page.')->group(function () {

        Route::get('/hero-section', [HomePageController::class, 'getHeroSection'])->name('hero_section.create');
        Route::post('/hero-section', [HomePageController::class, 'updateHeroSection'])->name('hero_section.update');

        Route::resource('services', HomePageServiceController::class)->names('services_section');
        Route::post('services/status/{id}', [HomePageServiceController::class, 'status'])->name('services_section.status');
        Route::post('services/update-container', [HomePageServiceController::class, 'updateContainer'])->name('services_section.update_container');
    });
    // ===================== END CMS HOME PAGE =====================


    // ===================== CMS INTRO PAGE =====================
    Route::prefix('intro-page')->name('intro_page.')->group(function () {

        Route::get('/intro-video', [IntroPageController::class, 'getIntroVedio'])->name('intro_video.create');
        Route::post('/intro-video', [IntroPageController::class, 'updateIntroVedio'])->name('intro_video.update');
        Route::get('/intro-section', [IntroPageController::class, 'getIntroSection'])->name('intro_section.create');
        Route::post('/intro-section', [IntroPageController::class, 'updateIntroSection'])->name('intro_section.update');
    });
    // ===================== END CMS INTRO PAGE =====================

    
    // ===================== CMS Services PAGE =====================
    Route::prefix('service-page')->name('service_page.')->group(function () {

        Route::get('/hero-section', [ServicePageController::class, 'getHeroSection'])->name('hero_section.create');
        Route::post('/hero-section', [ServicePageController::class, 'updateHeroSection'])->name('hero_section.update');

        Route::get('/service-section', [ServicePageController::class, 'getServiceSection'])->name('service_section.create');
        Route::post('/service-section', [ServicePageController::class, 'updateServiceSection'])->name('service_section.update');
    });
    // ===================== END CMS Services PAGE =====================

    // ===================== CMS CONTACT US PAGE =====================
    Route::prefix('contact-us-page')->name('contact_us_page.')->group(function () {

        Route::get('/hero-section', [ContactUsPageController::class, 'getHeroSection'])->name('hero_section.create');
        Route::post('/hero-section', [ContactUsPageController::class, 'updateHeroSection'])->name('hero_section.update');

        Route::get('/contact-section', [ContactUsPageController::class, 'getContactSection'])->name('contact_section.create');
        Route::post('/contact-section', [ContactUsPageController::class, 'updateContactSection'])->name('contact_section.update');
    });
});
