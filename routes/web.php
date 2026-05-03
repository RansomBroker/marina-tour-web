<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/tour-packages', function () {
    return view('pages.tour-packages');
});

Route::get('/blogs', function () {
    return view('pages.blogs');
});

Route::get('/contact-us', function() {
    return view('pages.contact-us');
});

Route::get('/tour-packages/detail/{slug}', function($slug) {
    return view('pages.tour-detail', compact('slug'));
});