<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); })" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                --crm-table-head: #4b5563;
                --crm-card-bg: rgba(255,255,255,0.7);
                --crm-badge-indigo-bg: #e0e7ff;
                --crm-badge-indigo-text: #4338ca;
                --crm-badge-student-bg: #fef3c7;
                --crm-badge-student-text: #d97706;
                --crm-badge-parent-bg: #dcfce7;
                --crm-badge-parent-text: #15803d;
                --crm-banner-bg: linear-gradient(135deg, #fffbeb, #fef3c7);
                --crm-banner-border: #fde68a;
                --crm-banner-label: #92400e;
                --crm-banner-name: #78350f;
                --crm-btn-secondary-bg: #f3f4f6;
                --crm-btn-secondary-hover: #e5e7eb;
                --crm-btn-secondary-text: #374151;
                --crm-divider: #e5e7eb;
                --crm-tab-bg: rgba(255,255,255,0.6);
                --crm-tab-active-bg: white;
                --crm-tab-text: #6b7280;
                --crm-tab-active-text: #4f46e5;
                --crm-tab-active-border: #6366f1;
                --crm-pill-bg: #e0e7ff;
                --crm-pill-text: #4338ca;
                --crm-empty-bg: rgba(255,255,255,0.7);
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
                --crm-table-head: #94a3b8;
                --crm-card-bg: rgba(30,41,59,0.7);
                --crm-badge-indigo-bg: #312e81;
                --crm-badge-indigo-text: #a5b4fc;
                --crm-badge-student-bg: #451a03;
                --crm-badge-student-text: #fcd34d;
                --crm-badge-parent-bg: #052e16;
                --crm-badge-parent-text: #4ade80;
                --crm-banner-bg: linear-gradient(135deg, #451a03, #78350f);
                --crm-banner-border: #92400e;
                --crm-banner-label: #fef3c7;
                --crm-banner-name: #fde68a;
                --crm-btn-secondary-bg: #334155;
                --crm-btn-secondary-hover: #475569;
                --crm-btn-secondary-text: #e2e8f0;
                --crm-divider: #334155;
                --crm-tab-bg: rgba(255,255,255,0.06);
                --crm-tab-active-bg: #1e293b;
                --crm-tab-text: #94a3b8;
                --crm-tab-active-text: #a5b4fc;
                --crm-tab-active-border: #6366f1;
                --crm-pill-bg: #312e81;
                --crm-pill-text: #e0e7ff;
                --crm-empty-bg: rgba(30,41,59,0.7);
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
                --crm-table-head: #7a5c3a;
                --crm-card-bg: rgba(250,240,220,0.75);
                --crm-badge-indigo-bg: #f0e3c6;
                --crm-badge-indigo-text: #7a5230;
                --crm-badge-student-bg: #fef3c7;
                --crm-badge-student-text: #92400e;
                --crm-badge-parent-bg: #e5d8be;
                --crm-badge-parent-text: #5c3d1c;
                --crm-banner-bg: linear-gradient(135deg, #f5ecd8, #ecddb8);
                --crm-banner-border: #e2d1a5;
                --crm-banner-label: #5c3d1c;
                --crm-banner-name: #3b2a10;
                --crm-btn-secondary-bg: #ece2d0;
                --crm-btn-secondary-hover: #dfd1b5;
                --crm-btn-secondary-text: #3b2f25;
                --crm-divider: #e2d6bf;
                --crm-tab-bg: rgba(255,248,238,0.72);
                --crm-tab-active-bg: #faf5ec;
                --crm-tab-text: #6e5d4f;
                --crm-tab-active-text: #6e4e19;
                --crm-tab-active-border: #c8a76a;
                --crm-pill-bg: #f0e3c6;
                --crm-pill-text: #5c3d1c;
                --crm-empty-bg: rgba(255,250,240,0.7);
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
                --crm-table-head: #d4b483;
                --crm-card-bg: rgba(55,40,25,0.75);
                --crm-badge-indigo-bg: #3b2a10;
                --crm-badge-indigo-text: #f0dfc0;
                --crm-badge-student-bg: #4a350f;
                --crm-badge-student-text: #fcd34d;
                --crm-badge-parent-bg: #3a2a14;
                --crm-badge-parent-text: #e0c9a6;
                --crm-banner-bg: linear-gradient(135deg, #4a3515, #785025);
                --crm-banner-border: #a07845;
                --crm-banner-label: #fce8c8;
                --crm-banner-name: #ffe0a0;
                --crm-btn-secondary-bg: #3e2e1e;
                --crm-btn-secondary-hover: #54402c;
                --crm-btn-secondary-text: #f0e4d0;
                --crm-divider: #5c4530;
                --crm-tab-bg: rgba(255,255,255,0.08);
                --crm-tab-active-bg: #2a1f16;
                --crm-tab-text: #bba88e;
                --crm-tab-active-text: #f0d9a8;
                --crm-tab-active-border: #c8a76a;
                --crm-pill-bg: #5c3d1c;
                --crm-pill-text: #f5e0c0;
                --crm-empty-bg: rgba(50,35,20,0.7);
            }
            [data-theme="natural"] .crm-container {
                background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
