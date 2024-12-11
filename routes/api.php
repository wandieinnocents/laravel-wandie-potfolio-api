<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\TestimonialApiController;
use App\Http\Controllers\Api\FeedbackApiController;




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




