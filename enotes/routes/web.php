<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

// 1. HALAMAN DEPAN (Redirect langsung ke Notes)
Route::get('/', function () {
    return redirect()->route('notes.index');
});

// 2. AUTHENTICATION (Login/Register)
Auth::routes();

// A. RUTE PUBLIK (BISA DIAKSES TAMU & MEMBER)


// 1. Halaman Daftar Catatan
Route::get('/notes', 'NoteController@index')->name('notes.index');

// 2. Fitur Create & Store
// Agar Tamu bisa akses halaman buat catatan & menyimpannya
Route::get('/notes/create', 'NoteController@create')->name('notes.create');
Route::post('/notes', 'NoteController@store')->name('notes.store');

// B. RUTE KHUSUS MEMBER (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {

    // --- FITUR EDIT & DELETE (Hanya Member) ---
    Route::get('/notes/{note}/edit', 'NoteController@edit')->name('notes.edit');
    Route::put('/notes/{note}', 'NoteController@update')->name('notes.update');
    Route::delete('/notes/{note}', 'NoteController@destroy')->name('notes.destroy');
    Route::delete('/notes-clear', 'NoteController@clearAll')->name('notes.clear');

    // --- ADMIN USER ---
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.destroy');

    // --- UBAH PASSWORD ---
    Route::get('/password/change', 'ChangePasswordController@index')->name('password.change');
    Route::post('/password/change', 'ChangePasswordController@update')->name('password.change.update');

    // --- HAPUS AKUN SENDIRI ---
    Route::delete('/account/delete', 'AccountController@delete')->name('account.delete');
});

// C. RUTE WILDCARD
Route::get('/notes/{note}', 'NoteController@show')->name('notes.show');

// 3. UTILITY STORAGE LINK
Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    return 'Link Storage Berhasil Dibuat!';
});