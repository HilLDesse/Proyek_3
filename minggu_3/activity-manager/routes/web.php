<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

// Trash dan restore
Route::get('/activities/trash', [ActivityController::class, 'trash'])
    ->name('activities.trash');

Route::post('/activities/{id}/restore', [ActivityController::class, 'restore'])
    ->name('activities.restore');

// Resource CRUD
Route::resource('activities', ActivityController::class);

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