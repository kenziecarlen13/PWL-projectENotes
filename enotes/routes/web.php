<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; 

// 1. HALAMAN DEPAN
Route::get('/', function () {
    return view('welcome');
});

// 2. AUTHENTICATION
Auth::routes();

// 3. AREA KHUSUS MEMBER (Wajib Login)
Route::middleware(['auth'])->group(function () {

    // --- A. DASHBOARD & NOTES ---
    Route::get('/notes', 'NoteController@index')->name('notes.index');
    Route::get('/notes/create', 'NoteController@create')->name('notes.create');
    Route::post('/notes', 'NoteController@store')->name('notes.store');
    Route::get('/notes/{note}', 'NoteController@show')->name('notes.show');
    Route::get('/notes/{note}/edit', 'NoteController@edit')->name('notes.edit');
    Route::put('/notes/{note}', 'NoteController@update')->name('notes.update');
    Route::delete('/notes/{note}', 'NoteController@destroy')->name('notes.destroy');
    Route::delete('/notes-clear', 'NoteController@clearAll')->name('notes.clear');

    // --- B. MASTER DATA USER (Admin) ---
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.destroy');

    // --- C. UBAH PASSWORD (Solusi Error) ---
    Route::get('/password/change', 'ChangePasswordController@index')->name('password.change');
    Route::post('/password/change', 'ChangePasswordController@update')->name('password.change.update');

    // --- D. PENGATURAN AKUN ---
    Route::delete('/account/delete', 'AccountController@delete')->name('account.delete');
});

// 4. ROUTE UTILITY
Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    return 'Link Storage Berhasil Dibuat!';
});