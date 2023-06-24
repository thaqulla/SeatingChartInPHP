<?php

use Illuminate\Support\Facades\Route;
 // ルーティングを設定するコントローラを宣言する
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [CommentController::class, 'index'])->middleware('auth');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');//App\Http\Controllers\HomeController
Route::resource('seats', SeatController::class);
Route::get('/seats/csv-download',[SeatController::class, 'downloadcsv'])->name('csvDownload');
Route::get('/report', [SeatController::class, 'report'])->name('seats.report')->middleware('auth');
// Route::get('/test', function() {return view('seats.test');})->name('seats.test')->middleware('auth');
Route::resource('comments', CommentController::class)->only(['index','update','destroy'])->middleware('auth');
Route::resource('socres', ScoreController::class)->only(['index', 'store','update','destroy'])->middleware('auth');
Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
// // 投稿の一覧ページ
// Route::get('/seats', [SeatController::class, 'index'])->name('seats.index');
// // 投稿の作成ページ
// Route::get('/seats/create', [SeatController::class, 'create'])->name('seats.create');
// // 投稿の作成機能

// 投稿の詳細ページ
// Route::get('/seats/{seat}', [SeatController::class, 'show'])->name('seats.show');
// // 投稿の更新ページ
// Route::get('/seats/{seat}/edit', [SeatController::class, 'edit'])->name('seats.edit');
// // 投稿の更新機能
// Route::patch('/seats/{seat}', [SeatController::class, 'update'])->name('seats.update');
// // 投稿の削除機能
// Route::delete('/seats/{seat}', [SeatController::class, 'destroy'])->name('seats.destroy');




