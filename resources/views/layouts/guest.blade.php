<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
      x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        theme: localStorage.getItem('theme') || 'default',
        menuOpen: false
      }"
      x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); })"
      :class="{ 'dark': darkMode }"
      :data-theme="theme">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ \App\Models\School::first()?->nameEn ?? config('app.name', 'Laravel') }}</title>

        @php($schoolIcon = \App\Models\School::first()?->logo)
        @if($schoolIcon)
        <link rel="icon" type="image/x-icon" href="{{ $schoolIcon }}">
        <link rel="apple-touch-icon" href="{{ $schoolIcon }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root, [data-theme="default"] {
                --crm-bg-from: #f3f4f6;
                --crm-bg-to: #e5e7eb;
                --crm-text: #1f2937;
                --crm-text-muted: #6b7280;
                --crm-border: rgba(0,0,0,0.05);
                --crm-panel-bg: rgba(255,255,255,0.7);
                --crm-panel-border: rgba(255,255,255,0.5);
                --crm-panel-shadow: rgba(0,0,0,0.05);
                --crm-input-bg: #f9fafb;
                --crm-input-border: #d1d5db;
                --crm-input-focus-border: #6366f1;
                --crm-card-bg: rgba(255,255,255,0.7);
                --crm-btn-primary-bg: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
                --crm-btn-primary-hover: #4f46e5;
                --crm-btn-success-bg: linear-gradient(135deg, #10b981 0%, #059669 100%);
                --crm-btn-success-hover: #059669;
                --crm-btn-danger-text: #dc2626;
                --crm-btn-danger-border: #fca5a5;
                --crm-btn-edit-text: #2563eb;
                --crm-btn-edit-border: #93c5fd;
            }
            .dark {
                --crm-bg-from: #0f172a;
                --crm-bg-to: #1e293b;
                --crm-text: #f1f5f9;
                --crm-text-muted: #94a3b8;
                --crm-border: rgba(255,255,255,0.05);
                --crm-panel-bg: rgba(30,41,59,0.7);
                --crm-panel-border: rgba(255,255,255,0.1);
                --crm-panel-shadow: rgba(0,0,0,0.3);
                --crm-input-bg: #1e293b;
                --crm-input-border: #475569;
                --crm-input-focus-border: #6366f1;
                --crm-card-bg: rgba(30,41,59,0.7);
                --crm-btn-primary-bg: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
                --crm-btn-primary-hover: #4f46e5;
                --crm-btn-success-bg: linear-gradient(135deg, #10b981 0%, #059669 100%);
                --crm-btn-success-hover: #059669;
            }
            [data-theme="natural"] {
                --crm-bg-from: #f5efe6;
                --crm-bg-to: #ebdcc3;
                --crm-text: #3b2f25;
                --crm-text-muted: #8c7b6b;
                --crm-border: rgba(120,90,50,0.12);
                --crm-panel-bg: rgba(255,252,245,0.82);
                --crm-panel-border: rgba(255,225,180,0.5);
                --crm-panel-shadow: rgba(120,90,50,0.08);
                --crm-input-bg: #faf5ec;
                --crm-input-border: #d6c6b0;
                --crm-input-focus-border: #8c6b3a;
                --crm-card-bg: rgba(250,240,220,0.75);
                --crm-btn-primary-bg: linear-gradient(135deg, #d4a96a 0%, #b8894a 100%);
                --crm-btn-primary-hover: #b8894a;
                --crm-btn-success-bg: linear-gradient(135deg, #8a9e6a 0%, #6d7e52 100%);
                --crm-btn-success-hover: #6d7e52;
                --crm-btn-danger-text: #b85a4a;
                --crm-btn-danger-border: #d49585;
                --crm-btn-edit-text: #7a6a4a;
                --crm-btn-edit-border: #c8b895;
            }
            .dark[data-theme="natural"] {
                --crm-bg-from: #1c1510;
                --crm-bg-to: #2a1f16;
                --crm-text: #f3e9d8;
                --crm-text-muted: #bba88e;
                --crm-border: rgba(255,200,120,0.1);
                --crm-panel-bg: rgba(55,40,25,0.8);
                --crm-panel-border: rgba(255,200,120,0.15);
                --crm-panel-shadow: rgba(0,0,0,0.35);
                --crm-input-bg: #2a1f16;
                --crm-input-border: #5c4a3a;
                --crm-input-focus-border: #d4a96a;
                --crm-card-bg: rgba(55,40,25,0.75);
                --crm-btn-primary-bg: linear-gradient(135deg, #d4a96a 0%, #b8894a 100%);
                --crm-btn-primary-hover: #b8894a;
                --crm-btn-success-bg: linear-gradient(135deg, #8a9e6a 0%, #6d7e52 100%);
                --crm-btn-success-hover: #6d7e52;
            }
            [x-cloak] { display: none !important; }

            /* Auth form element theming */
            .guest-input {
                width: 100%; padding: 0.6rem 0.75rem; border-radius: 0.5rem;
                border: 1px solid var(--crm-input-border, #d1d5db); font-size: 0.9rem;
                background: var(--crm-input-bg, #f9fafb);
                color: var(--crm-text, #1f2937); transition: all 0.15s;
            }
            .guest-input:focus {
                border-color: var(--crm-input-focus-border, #6366f1);
                outline: none; box-shadow: 0 0 0 2px color-mix(in srgb, var(--crm-input-focus-border, #6366f1) 20%, transparent);
            }
            .guest-label {
                display: block; font-size: 0.875rem; font-weight: 500;
                color: var(--crm-text, #1f2937); margin-bottom: 0.25rem;
            }
            .guest-btn-primary {
                padding: 0.6rem 1.5rem;
                background: var(--crm-btn-primary-bg, linear-gradient(135deg, #6366f1 0%, #4f46e5 100%));
                color: white; border: none; border-radius: 9999px; font-weight: 700; font-size: 0.8rem;
                cursor: pointer; transition: all 0.2s;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.15);
            }
            .guest-btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 12px -2px rgba(0,0,0,0.2);
            }
            .guest-link {
                color: var(--crm-btn-edit-text, #2563eb);
                text-decoration: underline; font-size: 0.875rem;
            }
            .guest-link:hover {
                opacity: 0.8;
            }

            /* Theme-aware overrides for auth form elements inside the guest card */
            .guest-form-card input[type="email"],
            .guest-form-card input[type="password"],
            .guest-form-card input[type="text"],
            .guest-form-card input[type="checkbox"],
            .guest-form-card select,
            .guest-form-card textarea {
                background: var(--crm-input-bg) !important;
                border-color: var(--crm-input-border) !important;
                color: var(--crm-text) !important;
            }
            .guest-form-card input:focus {
                border-color: var(--crm-input-focus-border) !important;
                box-shadow: 0 0 0 2px color-mix(in srgb, var(--crm-input-focus-border, #6366f1) 20%, transparent) !important;
            }
            .guest-form-card label {
                color: var(--crm-text) !important;
            }
            .guest-form-card .text-red-600 {
                color: var(--crm-btn-danger-text, #dc2626) !important;
            }
            .guest-form-card a.underline {
                color: var(--crm-btn-edit-text, #2563eb) !important;
            }
            .guest-form-card .text-gray-600 {
                color: var(--crm-text-muted, #6b7280) !important;
            }
            .guest-form-card input[type="checkbox"] {
                accent-color: var(--crm-input-focus-border, #6366f1);
            }
        </style>
    </head>
    <body class="font-sans antialiased"
          style="background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%); color: var(--crm-text); min-height: 100vh;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div style="align-self: flex-end; margin-bottom: 0.5rem;">
                <a href="{{ route('language.switch', app()->getLocale() === 'en' ? 'ar' : 'en') }}" class="inline-flex items-center justify-center w-8 h-8 rounded-md transition ease-in-out duration-150" style="color: var(--crm-text-muted); background: transparent; text-decoration: none;">
                    @if (app()->getLocale() === 'en')
                        <img src="{{ asset('Egypt-Flag.ico') }}" alt="Arabic" class="h-4 w-4" style="border-radius: 2px;">
                    @else
                        <img src="{{ asset('flag_united_nations.ico') }}" alt="English" class="h-4 w-4" style="border-radius: 2px;">
                    @endif
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 sm:rounded-lg guest-form-card"
                 style="background: var(--crm-panel-bg); backdrop-filter: blur(10px); border: 1px solid var(--crm-panel-border); box-shadow: 0 10px 15px -3px var(--crm-panel-shadow); position: relative;">
                 {{ $slot }}
            </div>
        </div>
    </body>
</html>
