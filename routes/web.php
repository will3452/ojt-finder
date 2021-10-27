<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;

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

Route::redirect('/', 'login');

Auth::routes(['verify' => true]);



Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/{user}', [ProfileController::class, 'setupProfile']);
    Route::post('/profile/{user}', [ProfileController::class, 'updateProfile']);

    Route::get('/offers', [OfferController::class, 'searchOffer']);
    Route::get('/create-index-offers', [OfferController::class, 'createAndIndex']);
    Route::post('/offer', [OfferController::class, 'postOffer']);
    Route::delete('/offer/{offer}', [OfferController::class, 'postDelete']);

    Route::post('/upload-resume', [ResumeController::class, 'uploadResume']);
    Route::post('/delete-resume/{resume}', [ResumeController::class, 'deleteResume']);

    Route::post('/apply', [ApplicationController::class, 'submitApplication']);
    Route::get('/applications/{offer}', [ApplicationController::class, 'applicationIndex']);
    Route::get('/my-applications', [ApplicationController::class, 'myApplications']);

    Route::post('/applications/{application}', [ApplicationController::class, 'applicationPost']);
});
