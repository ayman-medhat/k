<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    // Redirect the standard /register route to the admission registration page
    Route::get('register', function () {
        return redirect()->route('admission.register');
    })->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Route::get('login/guest', function () {
        $user = \App\Models\User::where('email', 'guest@example.com')->first();

        if (! $user) {
            return redirect()->route('login')->withErrors([
                'email' => __('auth.guest_not_found'),
            ]);
        }

        \Illuminate\Support\Facades\Auth::login($user);

        request()->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    })->name('login.guest');

    Route::post('login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = \Illuminate\Support\Facades\Auth::user();
            $defaultRoute = $user->isParent()
                ? route('parent.dashboard')
                : route('dashboard');

            return redirect()->intended($defaultRoute);
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
    })->middleware(['guest', 'throttle:5,1']);

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
