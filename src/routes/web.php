<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;

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

Route::middleware('auth')->group(function () {
   Route::get('/', [AuthController::class, 'index']);
   Route::get('/', [AttendanceController::class, 'getindex']);
   Route::get('/attendance/start', [AttendanceController::class, 'startAttendance']);
   Route::get('/attendance/end', [AttendanceController::class, 'endAttendance']);
   Route::get('/attendance/{num}', [AttendanceController::class, 'getAttendance']);
   Route::get('/break/start/', [RestController::class, 'startRest']);
   Route::get('/break/end', [RestController::class, 'endRest']);
});







