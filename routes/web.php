<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/tour-packages', function () {
    return view('pages.tour-packages');
});