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

Route::get('/blogs/detail/{slug}', function($slug) {
    $blog = \App\Models\Blog::where('slug', $slug)->firstOrFail();
    return view('pages.blog-detail', compact('blog'));
});

use App\Http\Controllers\AdminAuthController;

// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Panel
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('admin.categories');

    Route::get('/packages', function () {
        return view('admin.packages');
    })->name('admin.packages');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');

    Route::get('/inquiries', function () {
        return view('admin.inquiries');
    })->name('admin.inquiries');

    Route::get('/blogs', function () {
        return view('admin.blogs');
    })->name('admin.blogs');

    Route::get('/blogs/create', function () {
        return view('admin.blogs-create');
    })->name('admin.blogs.create');

    Route::get('/blogs/edit/{id}', function ($id) {
        return view('admin.blogs-edit', compact('id'));
    })->name('admin.blogs.edit');
});

