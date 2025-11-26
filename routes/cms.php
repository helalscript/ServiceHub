<?php

use App\Http\Controllers\Web\Backend\CMS\HomePageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageServiceController;
use App\Http\Controllers\Web\Backend\CMS\HomePageWorkProcessController;
use App\Http\Controllers\Web\Backend\CMS\HomeTestimonialController;
use App\Http\Controllers\Web\Backend\CMS\IntroPageController;
use Illuminate\Support\Facades\Route;

// ===================== CMS HOME PAGE =====================
Route::prefix('cms/home-page')->name('cms.home_page.')->group(function () {

    Route::get('/hero-section', [HomePageController::class, 'getHeroSection'])->name('hero_section.create');
    Route::post('/hero-section', [HomePageController::class, 'updateHeroSection'])->name('hero_section.update');

    Route::resource('services', HomePageServiceController::class)->names('services_section');
    Route::post('services/status/{id}', [HomePageServiceController::class, 'status'])->name('services_section.status');
    Route::post('services/update-container', [HomePageServiceController::class, 'updateContainer'])->name('services_section.update_container');
});


// ===================== END CMS HOME PAGE =====================

// ===================== CMS INTRO PAGE =====================
Route::prefix('cms/intro-page')->name('cms.intro_page.')->group(function () {

    Route::get('/intro-video', [IntroPageController::class, 'getIntroVedio'])->name('intro_video.create');
    Route::post('/intro-video', [IntroPageController::class, 'updateIntroVedio'])->name('intro_video.update');
    Route::get('/intro-section', [IntroPageController::class, 'getIntroSection'])->name('intro_section.create');
    Route::post('/intro-section', [IntroPageController::class, 'updateIntroSection'])->name('intro_section.update');
});
// ===================== END CMS INTRO PAGE =====================