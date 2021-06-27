<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
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
Route::get('/', [BlogController::class,'index']); //jei ateiname i pagrindini psl., kreipiames i Controller ir jo index (index yra metodas (aprasytas Controlleryje), i kuri norime nukreipti)
Route::get('/add-post', [BlogController::class,'createPost']); //apsirasome get Route, kad ivedus adresą add-post mums grazintu formą
Route::post('/store', [BlogController::class,'store']); //saugoti duomenis
Route::get('/post/{post}', [BlogController::class,'show']); //{post} parametras ateina is Blog controllerio, jie turi sutapti;sis route reikalingas, kad rodytu konkretu posta
Route::get('/delete/{post}', [BlogController::class,'destroy']);
Route::get('/update/{post}', [BlogController::class,'update']); //formos uzkrovimui reikalingas, kai norime paredaguoti posta
Route::patch('/storeupdate/{post}', [BlogController::class,'storeUpdate']);
Route::post('/post/{post}/comment',[CommentController::class,'addComment']);

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
