<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FrequenciesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\CommitteesController;
use App\Http\Controllers\CommitteeMeetingsController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ForgotPassword;

use App\Models\Users;
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

// Route::get('/', function(){
//     return view('auth.reset');
// });
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'Cache is cleared';
});

Route::get('/', [Auth::class, 'index'])->name('login');
Route::post('/authenticate', [Auth::class,'authentication']);
// Route::get('/forgot-password', [ForgotPassword::class,'index']);
// Route::post('/forgot-password', [ForgotPassword::class, 'sendForgotPasswordEmail']);
Route::get('/logout', [Auth::class,'logout']);




Route::middleware(['guard'])->group(function(){
    Route::get('/dashboard', [MasterController::class,'index']);
    Route::post('/send-mails', [CommitteeMeetingsController::class, 'sendMails'])->name('send-mails');
    
    Route::get('/meeting-rooms/index',[MeetingRoomController::class,'index']);

    Route::get('/meeting-rooms/create',[MeetingRoomController::class,'create']);
    Route::post('/meeting-rooms/create',[MeetingRoomController::class,'store']);
   
    Route::get('/meeting-rooms/edit/{id}',[MeetingRoomController::class,'edit']);
    Route::post('/meeting-rooms/edit/{id}',[MeetingRoomController::class,'update']);
    Route::get('/meeting-rooms/delete/{id}',[MeetingRoomController::class,'destroy']);
    Route::get('/meeting-rooms/show/{id}',[MeetingRoomController::class,'show']);
    // Users Controllers
    Route::get('/users/index',[UsersController::class,'index']);
    Route::post('/users/create',[UsersController::class,'store']);
    Route::get('/users/create',[UsersController::class,'create']);
    Route::get('/users/edit/{id}',[UsersController::class,'edit']);
    Route::get('/users/delete/{id}',[UsersController::class,'destroy']);
    Route::post('/users/edit/{id}',[UsersController::class,'update']);
    Route::get('/users/show/{id}',[UsersController::class,'show']);
    
    // Frequencies Controllers
    Route::get('/frequencies/index',[FrequenciesController::class,'index']);
    Route::get('/frequencies/create',[FrequenciesController::class,'create']);
    Route::post('/frequencies/create',[FrequenciesController::class,'store']);
    Route::get('/frequencies/edit/{id}',[FrequenciesController::class,'edit']);
    Route::post('/frequencies/edit/{id}',[FrequenciesController::class,'update']);
    Route::get('/frequencies/delete/{id}',[FrequenciesController::class,'destroy']);
    Route::get('/frequencies/show/{id}',[FrequenciesController::class,'show']);
    
    // Members Controllers
    Route::get('/members/index',[MembersController::class,'index']);
    Route::get('/members/create',[MembersController::class,'create']);
    Route::post('/members/create',[MembersController::class,'store']);
    Route::get('/members/edit/{id}',[MembersController::class,'edit']);
    Route::post('/members/edit/{id}',[MembersController::class,'update']);
    Route::get('/members/delete/{id}',[MembersController::class,'destroy']);
    Route::get('/members/show/{id}',[MembersController::class,'show']);
    
    // Committees Controllers
    Route::get('/committees/index',[CommitteesController::class,'index']);
    Route::get('/committees/create',[CommitteesController::class,'create']);
    Route::post('/committees/create',[CommitteesController::class,'store']);
    Route::get('/committees/edit/{id}',[CommitteesController::class,'edit']);
    Route::post('/committees/edit/{id}',[CommitteesController::class,'update']);
    Route::get('/committees/show/{id}',[CommitteesController::class,'show']);
    Route::get('/committees/delete/{id}',[CommitteesController::class,'destroy']);
    
    // Committee Meetings Controllers
    Route::get('/committee-meetings/index',[CommitteeMeetingsController::class,'index']);
    Route::get('/committee-meetings/create',[CommitteeMeetingsController::class,'create']);
    Route::post('/committee-meetings/create',[CommitteeMeetingsController::class,'store']);
    Route::get('/committee-meetings/edit/{id}',[CommitteeMeetingsController::class,'edit']);
    Route::post('/committee-meetings/edit/{id}',[CommitteeMeetingsController::class,'update']);
    Route::get('/committee-meetings/create/{id}',[CommitteeMeetingsController::class,'updatedate']);
   
    Route::get('/committee-meetings/show/{id}',[CommitteeMeetingsController::class,'show']);
    Route::get('/committee-meetings/delete/{id}',[CommitteeMeetingsController::class,'destroy']);
    Route::post('/committee-meetings/updateminute/{id}',[CommitteeMeetingsController::class,'updateminute']);
    
    
    Route::post('/committee-meeting-members/update-attendance/{id}', [CommitteeMeetingsController::class, 'updateAttendance']);
    
    
    Route::get('/get-members/{committee_id}', [CommitteeMeetingsController::class, 'getMembers'])->name('getMembers');
    
    
});




