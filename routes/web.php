<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function ():\Illuminate\View\View {
    return view('welcome');
});

Route::get("/signin", function():\Illuminate\View\View {
    return view("signin");
});

Route::get("/profil", function():\Illuminate\View\View {
    return view("profil_client");
});