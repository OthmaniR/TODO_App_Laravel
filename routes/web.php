<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\StatisticsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/task/index' , [ToDoController::class ,'index'])->name('tasks.list');
Route::get('/tasks/create' , [ToDoController::class ,'create'])->name('tasks.create');
Route::post('/tasks/store' , [ToDoController::class ,'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit' , [ToDoController::class ,'edit'])->name('tasks.editTask');
Route::put('/tasks/update' , [ToDoController::class ,'update'])->name('tasks.update');
Route::delete('/tasks/{id}' , [ToDoController::class ,'destroy'])->name('tasks.destroy');
Route::post('/tasks/{task}/complete', [ToDoController::class, 'markAsComplete'])->name('tasks.markAsComplete');
Route::post('/tasks/{task}/uncomplete', [ToDoController::class, 'markAsUncomplete'])->name('tasks.markAsUncomplete');

Route::get('/stats/daily', [StatisticsController::class, 'getDailyStatistics'])->name('tasks.dailyStat');
Route::get('/stats/weekly', [StatisticsController::class, 'getWeeklyStatistics'])->name('tasks.weeklyStat');
Route::get('/stats/monthly', [StatisticsController::class, 'getMonthlyStatistics'])->name('tasks.monthlyStat');
