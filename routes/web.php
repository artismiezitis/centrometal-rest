<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Centrometal\InstallationController;
use App\Http\Controllers\Centrometal\InstallationDataController;
use App\Http\Controllers\Centrometal\WdataController;
use App\Http\Controllers\Centrometal\StatusController;
use App\Http\Controllers\Centrometal\UserController;
use App\Http\Controllers\Centrometal\ErrorsController;
use App\Http\Controllers\Centrometal\HumanizedStatusController;
use App\Http\Controllers\Centrometal\LoginController;
use App\Http\Controllers\Centrometal\AuthCookieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('centrometal')->group(function () {

    Route::get('/installation', [InstallationController::class, 'index']);
    Route::get('/installation/data', [InstallationDataController::class, 'index']);
    Route::get('/status', [StatusController::class, 'index']);
    Route::get('/status/humanized', [HumanizedStatusController::class, 'data']);
    Route::get('/wdata', [WdataController::class, 'index']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/errors', [ErrorsController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index']);
    Route::get('/cookie', [AuthCookieController::class, 'index']);


});

Route::get('/', function () {




    return view('welcome');
});
