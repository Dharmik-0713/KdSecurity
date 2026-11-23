<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

Route::get('/admin/client-detail', [AdminController::class, 'clientDetail'])->name('admin.client-detail.index')->middleware('auth');
Route::get('/admin/client-detail/{id}', [AdminController::class, 'clientDetail'])->name('admin.client-detail')->middleware('auth');

Route::get('/admin/contact-requests', [AdminController::class, 'contactRequests'])->name('admin.contact-requests')->middleware('auth');
Route::post('/admin/contact-requests/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.contact-requests.update')->middleware('auth');

Route::get('/report-preview', function () {
    return view('reports.audit-template');
});