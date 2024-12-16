<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\TestimonialApiController;
use App\Http\Controllers\Api\FeedbackApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\GeneralSettingApiController;
use App\Http\Controllers\Api\SkillApiController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// testimonials
Route::get('/testimonials', [TestimonialApiController::class, 'get_all_testimonials']);
Route::post('/testimonials', [TestimonialApiController::class, 'store_testimonial']);
Route::get('/testimonials/{id}', [TestimonialApiController::class, 'show_testimonial']);
Route::put('/testimonial/{id}', [TestimonialApiController::class, 'update_testimonial']);
Route::delete('/testimonial/{id}', [TestimonialApiController::class, 'delete_testimonial']);

//feedbacks
Route::get('/feedback', [FeedbackApiController::class, 'get_all_feedbacks']);
Route::post('/feedback', [FeedbackApiController::class, 'store_feedbacks']);
Route::get('/feedback/{id}', [FeedbackApiController::class, 'show_feedback']);
Route::delete('/feedback/{id}', [FeedbackApiController::class, 'delete_feedback']);

// clients
Route::get('/clients', [ClientApiController::class, 'index']);
Route::post('/clients', [ClientApiController::class, 'store']);
Route::get('/client/{id}', [ClientApiController::class, 'show']);
Route::put('/client/{id}', [ClientApiController::class, 'update']);
Route::delete('/client/{id}', [ClientApiController::class, 'destroy']);

//general settings
Route::get('/general_settings', [GeneralSettingApiController::class, 'index']);
Route::post('/general_settings', [GeneralSettingApiController::class, 'store']);
Route::get('/general_settings/{id}', [GeneralSettingApiController::class, 'show']);
Route::put('/general_settings/{id}', [GeneralSettingApiController::class, 'update']);
Route::delete('/general_settings/{id}', [GeneralSettingApiController::class, 'destroy']);

//skills
Route::get('/skills', [SkillApiController::class, 'index']);
Route::post('/skills', [SkillApiController::class, 'store']);
Route::get('/skill/{id}', [SkillApiController::class, 'show']);
Route::put('/skill/{id}', [SkillApiController::class, 'update']);
Route::delete('/skill/{id}', [SkillApiController::class, 'destroy']);















