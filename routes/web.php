<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataSummaryController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');
Route::get('/attendance/print', [PDFController::class, 'print'])->name('attendance.print');
Route::resource('attendance', 'AttendanceController')->only(['index', 'show']);

Route::get('/datasummary', [DataSummaryController::class, 'index'])->name('datasummary.index');
Route::post('/datasummary/filter', [DataSummaryController::class, 'filter'])->name('datasummary.filter');

Route::resource('locations', 'LocationController');
Route::get('/locations', 'LocationController@index')->name('pages.kelolajarak.index');

Route::resource('activitiesout', 'ActivitiesOutController');
Route::get('/activitiesout', 'ActivitiesOutController@index')->name('pages.activitiesout.index');