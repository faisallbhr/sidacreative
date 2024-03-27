<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

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

Route::redirect('/', 'login');
Route::redirect('/register', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart', [DashboardController::class, 'chart'])->name('dashboard.chart');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/search', [ReportController::class, 'search'])->name('report.search');
    Route::post('/edit', [ReportController::class, 'edit'])->name('report.edit');
    Route::delete('/delete/{id}', [ReportController::class, 'destroy'])->name('report.delete');
    Route::post('/import-report', [ReportController::class, 'import'])->name('report.import');
});
