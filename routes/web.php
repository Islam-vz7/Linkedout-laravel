<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Mail\ApplicationMail;
use App\Models\Application;

Route::get('/', function () {
    return view('start');
});



Route::get('/users', function () {
    return view('/users');
})->middleware(['auth', 'verified'])->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('users/add', [UserController::class, 'add'])->name('users.add');
    Route::get('users/edit-profile/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/update-profile/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users/delete-image/{id}', [UserController::class, 'deleteImage'])->name('users.deleteImage');
    Route::put('users/update-image/{id}', [UserController::class, 'updateImage'])->name('users.updateImage');
    Route::put('users/update-image/{id}', [UserController::class, 'updateImage'])->name('users.updateImage');


    Route::get('users/edit-profile', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/profile', [UserController::class, 'profile'])->name('users.profile');
    

    Route::post('users/application', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('users/application/{job_id}', [JobController::class, 'apply'])->name('application');
    Route::post('/users/myjobs', [ApplicationController::class,'approveApplication'])->name('approve.application');


    Route::post('/users/myjobs/store', [JobController::class, 'store'])->name('myjobs.store');
    Route::get('/users/myjobs', [ApplicationController::class, 'index'])->name('myjobs');


    Route::get('users/jobs', [JobController::class, 'jobsIndex'])->name('jobs');

    Route::post('/users/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/users/{user_id}', [PostController::class, 'index'])->name('posts.index');

    
    Route::get('/users', [PostController::class, 'index'])->name('posts.index');
    Route::get('/users/edit-profile/delete-post/{id}', [PostController::class, 'deletePost']);
    Route::get('users/edit-post/{id}', [PostController::class, 'editPost' ])->name('users.editPost');
    Route::put('users/update-post/{id}', [PostController::class, 'updatePost' ])->name('users.updatePost');

    Route::post('myjobs/approve/{application_id}', [ApplicationController::class, 'approve' ])->name('myjobs.approve');
    Route::post('myjobs/decline/{application_id}', [ApplicationController::class, 'decline' ])->name('myjobs.decline');

    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('users/delete-comment/{id}', [CommentController::class, 'deleteComment' ])->name('users.edit');
});

require __DIR__.'/auth.php';
