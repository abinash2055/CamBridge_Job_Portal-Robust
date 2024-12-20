<?php

use App\Http\Controllers\User\JobApiController;
use App\Http\Controllers\Admin\AdminPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//job routes
Route::middleware('api')->group(function () {
    Route::get('search', [JobApiController::class, 'search'])->name('job.search');

    //pages api
    Route::get('districts', [JobApiController::class, 'getDistricts'])->name('job.getDistricts');
    Route::get('company-categories', [JobApiController::class, 'getCategories'])->name('job.getCategories');
    Route::get('job-titles', [JobApiController::class, 'getAllByTitle'])->name('job.getAllByTitle');
    Route::get('companies', [JobApiController::class, 'getAllOrganization'])->name('job.getAllOrganization');
});


// Toggle Button
Route::middleware('auth:sanctum')->post('/post/toggle-status/{id}', [AdminPostController::class, 'toggleStatus']);
