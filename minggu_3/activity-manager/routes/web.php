<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('activities', ActivityController::class);

Route::post(
    '/activities/{activity}/publish',
    [ActivityController::class, 'publish']
)->name('activities.publish');

Route::post(
    '/activities/{activity}/complete',
    [ActivityController::class, 'complete']
)->name('activities.complete');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy']
)->name('categories.destroy');