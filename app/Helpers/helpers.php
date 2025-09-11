<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('dashboard_route')) {
    function dashboard_route(): string
    {
        $user = Auth::user();

        if (! $user || ! $user->role) {
            return route('login');
        }

        switch ($user->role) {
            case 'admin':
                return route('admin.dashboard');
            case 'guru':
                return route('guru.dashboard');
            case 'siswa':
                return route('siswa.dashboard');
            case 'ortu':
                return route('ortu.dashboard');
            default:
                return route('login'); // fallback
        }
    }
}
