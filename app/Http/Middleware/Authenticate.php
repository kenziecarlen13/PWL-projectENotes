<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Menentukan URL redirect jika pengguna tidak terautentikasi (Belum Login).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Cek tipe request:
        // Jika request berasal dari Browser (bukan API/JSON), 
        // maka arahkan pengguna ke route bernama 'login'.
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}