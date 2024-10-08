<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FrequenciesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\CommitteesController;
use App\Http\Controllers\CommitteeMeetingsController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\CommitteeMeetingController;
use App\Http\Controllers\EscalationForecastController;
use App\Http\Controllers\LeaveLicenseEntryController;



// Route to show the form
Route::get('/escalation-forecast', [EscalationForecastController::class, 'index'])->name('escalation.forecast');

// Route to handle the calculation
Route::post('/escalation-forecast/calculate', [EscalationForecastController::class, 'calculate'])->name('escalation.forecast.calculate');


/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/

// Authentication
Route::get('/', [Auth::class, 'index']);
Route::post('/authenticate', [Auth::class, 'authentication']);
Route::get('/logout', [Auth::class, 'logout']);

// Dashboard
Route::get('/dashboard', [MasterController::class, 'index'])->name('dashboard');

// Users Routes
Route::get('/users/index', [UsersController::class, 'index']);
Route::get('/users/create', [UsersController::class, 'create']);
Route::post('/users/create', [UsersController::class, 'store']);
Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
Route::post('/users/edit/{id}', [UsersController::class, 'update']);
Route::get('/users/delete/{id}', [UsersController::class, 'destroy']);
Route::get('/users/show/{id}', [UsersController::class, 'show']);

// Frequencies Routes
Route::get('/frequencies/index', [FrequenciesController::class, 'index']);
Route::get('/frequencies/create', [FrequenciesController::class, 'create']);
Route::post('/frequencies/create', [FrequenciesController::class, 'store']);
Route::get('/frequencies/edit/{id}', [FrequenciesController::class, 'edit']);
Route::post('/frequencies/edit/{id}', [FrequenciesController::class, 'update']);
Route::get('/frequencies/delete/{id}', [FrequenciesController::class, 'destroy']);
Route::get('/frequencies/show/{id}', [FrequenciesController::class, 'show']);

// Members Routes
Route::get('/members/index', [MembersController::class, 'index']);
Route::get('/members/create', [MembersController::class, 'create']);
Route::post('/members/create', [MembersController::class, 'store']);
Route::get('/members/edit/{id}', [MembersController::class, 'edit']);
Route::post('/members/edit/{id}', [MembersController::class, 'update']);
Route::get('/members/delete/{id}', [MembersController::class, 'destroy']);
Route::get('/members/show/{id}', [MembersController::class, 'show']);

// Committees Routes
Route::get('/committees/index', [CommitteesController::class, 'index']);
Route::get('/committees/create', [CommitteesController::class, 'create']);
Route::post('/committees/create', [CommitteesController::class, 'store']);
Route::get('/committees/edit/{id}', [CommitteesController::class, 'edit']);
Route::post('/committees/edit/{id}', [CommitteesController::class, 'update']);
Route::get('/committees/delete/{id}', [CommitteesController::class, 'destroy']);
Route::get('/committees/show/{id}', [CommitteesController::class, 'show']);

// Committee Meetings Routes
Route::get('/committee-meetings/index', [CommitteeMeetingsController::class, 'index'])->name('committee-meetings.index');
Route::get('/committee-meetings/create', [CommitteeMeetingsController::class, 'create']);
Route::post('/committee-meetings/create', [CommitteeMeetingsController::class, 'store']);
Route::get('/committee-meetings/edit/{id}', [CommitteeMeetingsController::class, 'edit'])->name('committee-meetings.edit');
Route::post('/committee-meetings/edit/{id}', [CommitteeMeetingsController::class, 'update']);
Route::get('/committee-meetings/delete/{id}', [CommitteeMeetingsController::class, 'destroy']);
Route::get('/committee-meetings/show/{id}', [CommitteeMeetingsController::class, 'show'])->name('committee-meetings.show');
Route::post('committee-meetings/upload-file/{id}', [CommitteeMeetingsController::class, 'uploadFile'])->name('committee-meetings.upload-file');
Route::get('committee-meetings/create/{id}', [CommitteeMeetingsController::class, 'nextdate'])->name('committee-meetings.create');

// Email Routes
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

// Committee Members Routes
Route::get('/committee-members/{committeeId}', [CommitteeMeetingsController::class, 'getMembers'])->name('getMembers');

// Meeting Rooms Routes
Route::resource('meeting_rooms', MeetingRoomController::class);
Route::get('meeting_rooms/delete/{id}', [MeetingRoomController::class, 'destroy'])->name('meeting_rooms.delete');
Route::get('/meeting_rooms/{id}', [MeetingRoomController::class, 'show'])->name('meeting_rooms.show');
Route::get('/meeting_rooms/{id}/edit', [MeetingRoomController::class, 'edit'])->name('meeting_rooms.edit');

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

use App\Http\Controllers\ReportController;

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

use App\Http\Controllers\ForecastReportController;

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


use App\Http\Controllers\LeaveLicenseController;

Route::get('/leave-license/download', [LeaveLicenseController::class, 'download'])->name('leave-license.download');



Route::get('/leave-license/download', [LeaveLicenseEntryController::class, 'download'])->name('leaveLicense.download');



Route::get('/leave-license-entry/download', [LeaveLicenseEntryController::class, 'download'])->name('leave-license.download');
