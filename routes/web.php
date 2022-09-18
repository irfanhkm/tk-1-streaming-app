<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadVideoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home']);

Route::post('/upload', [UploadVideoController::class, 'create'])->name('upload.video.create');
Route::put('/upload/{id}', [UploadVideoController::class, 'update'])->name('upload.video.update');
