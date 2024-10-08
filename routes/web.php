<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FrequenciesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\CommitteesController;
use App\Http\Controllers\CommitteeMeetingsController;
use App\Http\Controllers\LeaveLicenseController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\FDModulesController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\LeaseLicencesController;
use App\Http\Controllers\AllowedIpsController;

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
    


    //  Banks Controller
    Route::get('banks/index',[BanksController::class,'index']);
    Route::get('banks/create',[BanksController::class,'create']);
    Route::post('banks/create',[BanksController::class,'store']);
    Route::get('banks/edit/{id}',[BanksController::class,'edit']);
    Route::post('banks/edit/{id}',[BanksController::class,'update']);
    Route::get('banks/show/{id}',[BanksController::class,'show']);
    Route::get('banks/delete/{id}',[BanksController::class,'destroy']);


    // FD MOdules Controller
    Route::get('fd-modules/index',[FDModulesController::class,'index']);
    Route::get('fd-modules/create',[FDModulesController::class,'create']);
    Route::post('fd-modules/create',[FDModulesController::class,'store']);
    Route::get('fd-modules/edit/{id}',[FDModulesController::class,'edit']);
    Route::post('fd-modules/edit/{id}',[FDModulesController::class,'update']);
    Route::get('fd-modules/show/{id}',[FDModulesController::class,'show']);
    Route::get('fd-modules/delete/{id}',[FDModulesController::class,'destroy']);




    Route::get('calculate-fd/calculate', [FDModulesController::class, 'showForm']);

    Route::post('/calculate-interest', [FDModulesController::class, 'calculateInterest'])->name('calculateInterest');
    Route::get('/calculate-interest', [FDModulesController::class, 'calculateInterest'])->name('calculateInterest');
    Route::post('/fd-modules/toggle-status/{id}', [FDModulesController::class, 'toggleStatus']);





    //Allowed IPs 
    Route::get('allowed-ips/index',[AllowedIpsController::class,'index']);
    Route::get('allowed-ips/create',[AllowedIpsController::class,'create']);
    Route::post('allowed-ips/create',[AllowedIpsController::class,'store']);
    Route::get('allowed-ips/edit/{id}',[AllowedIpsController::class,'edit']);
    Route::post('allowed-ips/edit/{id}',[AllowedIpsController::class,'update']);
    Route::get('allowed-ips/show/{id}',[AllowedIpsController::class,'show']);
    Route::get('allowed-ips/delete/{id}',[AllowedIpsController::class,'destroy']);


    // Define the route for getting IP info
    Route::get('allowed-ips/get-ip-info', [AllowedIpsController::class, 'getIpInfo']);

    // lease licence controller
    Route::get('lease-licences/index',[LeaseLicencesController::class,'index']);
    Route::get('lease-licences/create',[LeaseLicencesController::class,'create']);
    Route::post('lease-licences/create',[LeaseLicencesController::class,'store']);
    Route::get('lease-licences/edit/{id}',[LeaseLicencesController::class,'edit']);
    Route::post('lease-licences/edit/{id}',[LeaseLicencesController::class,'update']);
    Route::get('lease-licences/show/{id}',[LeaseLicencesController::class,'show']);
    Route::get('lease-licences/delete/{id}',[LeaseLicencesController::class,'destroy']);
    
    Route::get('calculate-lease/calculate', [LeaseLicencesController::class, 'showForm']);
    Route::post('/calculate-lease', [LeaseLicencesController::class, 'calculateLease'])->name('calculateLease');
    Route::get('/calculate-lease', [LeaseLicencesController::class, 'calculateLease'])->name('calculateLease');
    
    // Leave License Entry Routes
Route::get('/leave-license-entry/index', [LeaveLicenseEntryController::class, 'index'])->name('leave-license-entries.index');
Route::get('/leave-license-entry/create', [LeaveLicenseEntryController::class, 'create'])->name('leave-license-entries.create');
Route::post('/leave-license-entry/store', [LeaveLicenseEntryController::class, 'store'])->name('leave-license-entries.store');
Route::get('/leave-license-entry/{leave_license_entry}/edit', [LeaveLicenseEntryController::class, 'edit'])->name('leave-license-entries.edit');
Route::put('/leave-license-entry/{leave_license_entry}', [LeaveLicenseEntryController::class, 'update'])->name('leave-license-entries.update');
Route::delete('/leave-license-entry/{leave_license_entry}', [LeaveLicenseEntryController::class, 'destroy'])->name('leave-license-entries.destroy');
Route::get('/leave-license-entry/{leave_license_entry}', [LeaveLicenseEntryController::class, 'show'])->name('leave-license-entries.show');
Route::get('leave-license/export', [LeaveLicenseEntryController::class, 'export'])->name('leave-license.export');
Route::get('leave-license/calculate-escalation/{id}', [LeaveLicenseEntryController::class, 'calculateEscalation'])->name('leave-license.calculate-escalation');

// Escalation Forecast Routes
Route::get('/escalation-forecast', [EscalationForecastController::class, 'index'])->name('escalation.forecast');
Route::get('/escalation/{id}/view', [EscalationForecastController::class, 'view'])->name('escalation.view');
Route::get('/escalation/{id}/edit', [EscalationForecastController::class, 'edit'])->name('escalation.edit');
Route::post('/escalation/forecast', [EscalationForecastController::class, 'generateForecast'])->name('escalation.forecast');
Route::get('/escalation-forecast/download/excel', [EscalationForecastController::class, 'downloadExcel'])->name('escalation.forecast.download.excel');
Route::get('/escalation-forecast/download/pdf', [EscalationForecastController::class, 'downloadPDF'])->name('escalation.forecast.download.pdf');



Route::get('/generate-pdf', [ReportController::class, 'generatePdf']);
Route::resource('leave-license', LeaveLicenseEntryController::class);

// Route to show the escalation forecast form
Route::get('/escalation-forecast', [EscalationForecastController::class, 'index'])->name('escalation.forecast.view');

// Route to handle the form submission
Route::post('/escalation-forecast', [EscalationForecastController::class, 'showForecast'])->name('escalation.forecast');

Route::resource('leave-license', LeaveLicenseEntryController::class);
// Route::get('leave-license/edit/{id}', [LeaveLicenseController::class, 'edit'])->name('leave-license.edit');
// Route::resource('leave-license', LeaveLicenseEntryController::class);
Route::put('leave-license/{id}', [LeaveLicenseEntryController::class, 'update'])->name('leave-license.update');
Route::get('leave-license/{id}/edit', [LeaveLicenseEntryController::class, 'edit'])->name('leave-license.edit');



Route::get('/forecast-report', [ForecastReportController::class, 'index'])->name('forecast.report.index');
Route::post('/forecast-report/generate', [ForecastReportController::class, 'generateReport'])->name('forecast.report.generate');
Route::get('/forecast-report/download/pdf', [ForecastReportController::class, 'downloadPdf'])->name('forecast.report.download.pdf');
Route::get('/forecast-report/download/excel', [ForecastReportController::class, 'downloadExcel'])->name('forecast.report.download.excel');

Route::get('/escalation-forecast', [EscalationForecastController::class, 'index'])->name('escalation.forecast.index');
Route::post('/escalation-forecast/show', [EscalationForecastController::class, 'showForecast'])->name('escalation.forecast.show');
Route::get('/escalation-forecast/download/excel', [EscalationForecastController::class, 'downloadExcel'])->name('escalation.forecast.download.excel');
Route::get('/escalation-forecast/download/pdf', [EscalationForecastController::class, 'downloadPDF'])->name('escalation.forecast.download.pdf');



// routes/web.php
Route::get('/escalation-calculation', [LeaveLicenseEntryController::class, 'showEscalationCalculation'])->name('escalation.calculation');
// routes/web.php

Route::get('/calculate-escalation/{id}', [LeaveLicenseEntryController::class, 'calculateEscalation'])->name('calculate.escalation');




Route::get('/leave-license/download', [LeaveLicenseController::class, 'download'])->name('leave-license.download');



Route::get('/leave-license/download', [LeaveLicenseEntryController::class, 'download'])->name('leaveLicense.download');



Route::get('/leave-license-entry/download', [LeaveLicenseEntryController::class, 'download'])->name('leave-license.download');



Route::get('/escalation-forecast/download/excel', [EscalationForecastController::class, 'downloadExcel'])->name('escalation.forecast.download.excel');
Route::get('/escalation-forecast/download/pdf', [EscalationForecastController::class, 'downloadPDF'])->name('escalation.forecast.download.pdf');

});