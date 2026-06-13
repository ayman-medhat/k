<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        theme: localStorage.getItem('theme') || 'default',
        mobileOpen: false
      }"
      x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); })"
      :class="{ 'dark': darkMode }"
      :data-theme="theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $school->nameEn }} — {{ $school->nameAr }}</title>
    @php($schoolIcon = \App\Models\School::first()?->logo)
    @if($schoolIcon)
    <link rel="icon" type="image/x-icon" href="{{ $schoolIcon }}">
    <link rel="apple-touch-icon" href="{{ $schoolIcon }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'DM Sans', ui-sans-serif, system-ui, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        .reveal { opacity: 0; transform: translateY(2.5rem); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-3rem); transition: opacity 0.9s ease, transform 0.9s ease; }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(3rem); transition: opacity 0.9s ease, transform 0.9s ease; }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .delay-1 { transition-delay: 0.12s; }
        .delay-2 { transition-delay: 0.24s; }
        .delay-3 { transition-delay: 0.36s; }
        .delay-4 { transition-delay: 0.48s; }
        .delay-5 { transition-delay: 0.60s; }

        @keyframes heroFadeUp {
            0% { opacity: 0; transform: translateY(1.5rem); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .hero-content { animation: heroFadeUp 1s ease forwards; }

        @keyframes scrollLoop {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .infinity-track { animation: scrollLoop 40s linear infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .float-icon { animation: float 3s ease-in-out infinite; }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 var(--lp-accent-glow); }
            50% { box-shadow: 0 0 0 16px color-mix(in srgb, var(--lp-accent-glow) 0%, transparent); }
        }
        .btn-primary { animation: pulse-glow 2s ease-in-out infinite; }

        .nav-blur { backdrop-filter: blur(16px) saturate(180%); -webkit-backdrop-filter: blur(16px) saturate(180%); }

        .card-hover { transition: transform 0.4s ease, box-shadow 0.4s ease; }
        .card-hover:hover { transform: translateY(-4px); }

        .nav-link-underline {
            position: relative;
        }
        .nav-link-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: currentColor;
            transition: width 0.3s ease, left 0.3s ease;
        }
        .nav-link-underline:hover::after {
            width: 80%;
            left: 10%;
        }

        @media (max-width: 768px) {
            .infinity-track { animation-duration: 20s; }
        }

        :root, [data-theme="default"] {
            --lp-bg: #FDFDFC;
            --lp-text: #1b1b18;
            --lp-text-muted: #706f6c;
            --lp-section-alt: #f5f5f4;
            --lp-card-bg: #ffffff;
            --lp-card-border: #e3e3e0;
            --lp-accent: #f59e0b;
            --lp-accent-hover: #fbbf24;
            --lp-accent-text: #d97706;
            --lp-accent-light: #fef3c7;
            --lp-accent-glow: rgba(251, 191, 36, 0.4);
            --lp-hero-from: #0f0f0e;
            --lp-hero-via: #1a1a18;
            --lp-hero-to: #2d2d28;
        }
        .dark {
            --lp-bg: #0a0a0a;
            --lp-text: #EDEDEC;
            --lp-text-muted: #A1A09A;
            --lp-section-alt: #111110;
            --lp-card-bg: #161615;
            --lp-card-border: #262626;
            --lp-accent: #f59e0b;
            --lp-accent-hover: #fbbf24;
            --lp-accent-text: #fbbf24;
            --lp-accent-light: #78350f;
            --lp-accent-glow: rgba(251, 191, 36, 0.4);
            --lp-hero-from: #0f0f0e;
            --lp-hero-via: #1a1a18;
            --lp-hero-to: #2d2d28;
        }
        [data-theme="natural"] {
            --lp-bg: #f8f3ea;
            --lp-text: #3b2f25;
            --lp-text-muted: #8c7b6b;
            --lp-section-alt: #f0e8da;
            --lp-card-bg: #fdf9f0;
            --lp-card-border: #e2d1a5;
            --lp-accent: #b8894a;
            --lp-accent-hover: #d4a96a;
            --lp-accent-text: #8c6b3a;
            --lp-accent-light: #f0e3c6;
            --lp-accent-glow: rgba(184, 137, 74, 0.4);
            --lp-hero-from: #2a1f16;
            --lp-hero-via: #3b2f25;
            --lp-hero-to: #4a3a2a;
        }
        .dark[data-theme="natural"] {
            --lp-bg: #1c1510;
            --lp-text: #f3e9d8;
            --lp-text-muted: #bba88e;
            --lp-section-alt: #2a1f16;
            --lp-card-bg: #3b2a14;
            --lp-card-border: #5c4530;
            --lp-accent: #d4a96a;
            --lp-accent-hover: #e8c88a;
            --lp-accent-text: #f0d9a8;
            --lp-accent-light: #5c3d1c;
            --lp-accent-glow: rgba(212, 169, 106, 0.4);
            --lp-hero-from: #0d0906;
            --lp-hero-via: #1c1510;
            --lp-hero-to: #2a1f16;
        }
        [x-cloak] { display: none !important; }

        .nav-link {
            color: var(--lp-text-muted);
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: var(--lp-text);
        }
        .lp-btn-accent {
            background: var(--lp-accent);
            color: white;
        }
        .lp-btn-accent:hover {
            background: var(--lp-accent-hover);
        }
        .lp-btn-ghost {
            color: var(--lp-text-muted);
            border: 1px solid var(--lp-card-border);
            background: transparent;
        }
        .lp-btn-ghost:hover {
            background: var(--lp-card-bg);
        }
        .lp-accent-text {
            color: var(--lp-accent-text);
        }
        .lp-accent-bg {
            background: var(--lp-accent-light);
        }
        .lp-card {
            background: var(--lp-card-bg);
            border-color: var(--lp-card-border);
        }
        .lp-section-alt {
            background: var(--lp-section-alt);
        }
        .lp-text-muted {
            color: var(--lp-text-muted);
        }
        .hover-lp-accent:hover {
            color: var(--lp-accent-text);
        }
        .lp-btn-social {
            border-color: var(--lp-card-border);
            color: var(--lp-text-muted);
            background: var(--lp-card-bg);
        }
        .lp-btn-social:hover {
            color: var(--lp-accent-text);
            border-color: var(--lp-accent);
            background: var(--lp-accent-light);
        }
    </style>
</head>
<body style="background: var(--lp-bg); color: var(--lp-text);">

    <!-- Nav -->
    <nav class="fixed top-0 left-0 right-0 z-50 nav-blur" style="background: color-mix(in srgb, var(--lp-card-bg) 85%, transparent); border-bottom: 1px solid var(--lp-card-border);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <a href="#" class="flex items-center gap-3 font-semibold text-lg no-underline" style="color: var(--lp-text);">
                    @if($school->logo)
                    <img src="{{ $school->logo }}" alt="" class="h-9 w-auto">
                    @endif
                    <span>{{ $school->nameEn }}</span>
                </a>
                <div class="hidden md:flex items-center gap-1">
                    <a href="#hero" class="nav-link nav-link-underline px-3 py-2 text-sm font-medium rounded-lg transition-colors no-underline">{{ __('welcome.home') }}</a>
                    @if($school->mission || $school->vision)
                    <a href="#about" class="nav-link nav-link-underline px-3 py-2 text-sm font-medium rounded-lg transition-colors no-underline">{{ __('welcome.about') }}</a>
                    @endif
                    <a href="#info" class="nav-link nav-link-underline px-3 py-2 text-sm font-medium rounded-lg transition-colors no-underline">{{ __('welcome.contact') }}</a>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Theme Toggle -->
                    <button @click="theme = theme === 'natural' ? 'default' : 'natural'; localStorage.setItem('theme', theme); document.documentElement.setAttribute('data-theme', theme);"
                            x-show="theme === 'default'"
                            class="w-9 h-9 rounded-full border border-[var(--lp-card-border)] flex items-center justify-center hover:bg-[var(--lp-card-bg)] transition-all text-[var(--lp-text-muted)]"
                            title="{{ __('welcome.theme_brown') }}" x-cloak>
                        <span style="font-size: 1rem;">🌰</span>
                    </button>
                    <button @click="theme = theme === 'natural' ? 'default' : 'natural'; localStorage.setItem('theme', theme); document.documentElement.setAttribute('data-theme', theme);"
                            x-show="theme === 'natural'"
                            class="w-9 h-9 rounded-full border border-[var(--lp-card-border)] flex items-center justify-center hover:bg-[var(--lp-card-bg)] transition-all text-[var(--lp-text-muted)]"
                            title="{{ __('welcome.theme_default') }}" x-cloak>
                        <span style="font-size: 1rem;">🎨</span>
                    </button>
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode"
                            class="w-9 h-9 rounded-full border border-[var(--lp-card-border)] flex items-center justify-center hover:bg-[var(--lp-card-bg)] transition-all text-[var(--lp-text-muted)]"
                            title="{{ __('welcome.dark_mode') }}">
                        <span x-show="!darkMode" style="font-size: 1rem;">🌙</span>
                        <span x-show="darkMode" style="font-size: 1rem;" x-cloak>☀️</span>
                    </button>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-lg no-underline">{{ __('nav.dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link px-3 py-2 text-sm font-medium rounded-lg no-underline">{{ __('nav.log_in') }}</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-4 py-2 lp-btn-accent text-sm font-semibold rounded-xl transition-all hover:-translate-y-0.5 shadow-lg no-underline btn-primary" style="box-shadow: 0 4px 14px -2px var(--lp-accent-glow);">
                            {{ __('nav.register') }}
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-[#0f0f0e] via-[#1a1a18] to-[#2d2d28]">
        <div class="absolute inset-0 opacity-[0.04] dark:opacity-[0.06]" style="background-image: radial-gradient(circle at 25% 50%, #fff 1px, transparent 1px), radial-gradient(circle at 75% 50%, #fff 1px, transparent 1px); background-size: 60px 60px, 40px 40px;"></div>
        <div class="relative z-10 text-center px-4 sm:px-6 max-w-4xl mx-auto hero-content">
            @if($school->logo)
            <img src="{{ $school->logo }}" alt="{{ $school->nameEn }}" class="h-20 w-auto mx-auto mb-6 opacity-90">
            @endif
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.05]">
                {{ $school->nameEn }}
            </h1>
            @if($school->nameAr)
            <p class="mt-3 text-xl sm:text-2xl text-white/60 font-medium" dir="rtl">{{ $school->nameAr }}</p>
            @endif
            @if($school->address)
            <div class="mt-6 inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm text-white/80 text-sm font-medium rounded-full border border-white/10">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $school->address }}
            </div>
            @endif
            @if($school->established_year)
            <p class="mt-4 text-white/40 text-sm">{{ __('welcome.established') }} {{ $school->established_year }}</p>
            @endif
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                @if($school->email)
                <a href="{{ route('admission.register') }}" class="inline-flex items-center gap-2 px-6 py-3 lp-btn-accent font-semibold rounded-2xl transition-all hover:-translate-y-1 shadow-xl no-underline btn-primary" style="box-shadow: 0 8px 25px -5px var(--lp-accent-glow);">
                    {{ __('welcome.enroll_now') }}
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#info" class="inline-flex items-center gap-2 px-6 py-3 lp-btn-ghost text-white font-semibold rounded-2xl transition-all hover:-translate-y-1 backdrop-blur-sm no-underline" style="color: rgba(255,255,255,0.7); border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.08);">
                    {{ __('welcome.learn_more') }}
                </a>
                @endif
                <a href="#info" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-2xl transition-all hover:-translate-y-1 backdrop-blur-sm no-underline">
                    {{ __('welcome.learn_more') }}
                </a>
            </div>
        </div>

        <!-- Scrolling stats marquee (like eloqwnt's infinity line) -->
        @if($school->established_year || $school->phone || $school->email || $school->principal_name)
        <?php
            $statItems = [];
            if ($school->established_year) $statItems[] = __('welcome.established') . ' ' . $school->established_year;
            if ($school->phone) $statItems[] = $school->phone;
            if ($school->email) $statItems[] = $school->email;
            if ($school->principal_name) $statItems[] = __('welcome.principal') . ': ' . $school->principal_name;
            if (count($statItems) < 3) $statItems = array_merge($statItems, $statItems, $statItems);
        ?>
        <div class="absolute bottom-0 left-0 right-0 border-t border-white/10 bg-white/5 backdrop-blur-sm py-4 overflow-hidden">
            <div class="flex infinity-track whitespace-nowrap">
                @foreach($statItems as $item)
                <span class="inline-flex items-center gap-3 text-white/60 text-sm font-medium mx-8">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 flex-shrink-0"></span>
                    {{ $item }}
                </span>
                @endforeach
                @foreach($statItems as $item)
                <span class="inline-flex items-center gap-3 text-white/60 text-sm font-medium mx-8">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 flex-shrink-0"></span>
                    {{ $item }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </section>

    <main>

    <!-- Mission & Vision -->
    @if($school->mission || $school->vision)
    <section id="about" class="py-20 sm:py-28 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-2 text-sm font-medium lp-text-muted mb-4 reveal">
                <span class="w-2 h-2 rounded-full" style="background: var(--lp-accent);"></span>
                {{ __('welcome.about') }}
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight reveal delay-1" style="color: var(--lp-text);">
                {{ __('welcome.mission_vision') }}
            </h2>
            <div class="mt-10 grid md:grid-cols-2 gap-6">
                @if($school->mission)
                <div class="p-8 rounded-2xl lp-card border card-hover shadow-sm reveal-left delay-2">
                    <div class="w-12 h-12 rounded-xl lp-accent-bg flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 lp-accent-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: var(--lp-text);">{{ __('welcome.our_mission') }}</h3>
                    <p class="lp-text-muted leading-relaxed">{{ $school->mission }}</p>
                </div>
                @endif
                @if($school->vision)
                <div class="p-8 rounded-2xl lp-card border card-hover shadow-sm reveal-right delay-3">
                    <div class="w-12 h-12 rounded-xl lp-accent-bg flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 lp-accent-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: var(--lp-text);">{{ __('welcome.our_vision') }}</h3>
                    <p class="lp-text-muted leading-relaxed">{{ $school->vision }}</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Contact & Information -->
    <section id="info" class="py-20 sm:py-28 px-4 sm:px-6 lp-section-alt">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-2 text-sm font-medium lp-text-muted mb-4 reveal">
                <span class="w-2 h-2 rounded-full" style="background: var(--lp-accent);"></span>
                {{ __('welcome.contact') }}
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight reveal delay-1" style="color: var(--lp-text);">
                {{ __('welcome.get_in_touch') }}
            </h2>
            <p class="mt-4 text-lg lp-text-muted max-w-xl reveal delay-2">{{ __('welcome.contact_desc') }}</p>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @if($school->phone)
                <div class="p-6 rounded-2xl lp-card border card-hover reveal delay-2">
                    <div class="w-10 h-10 rounded-lg lp-accent-bg flex items-center justify-center mb-4 float-icon">
                        <svg class="w-5 h-5 lp-accent-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="text-xs font-medium uppercase tracking-wider lp-text-muted mb-1">{{ __('welcome.phone') }}</div>
                    <div class="text-base font-semibold" style="color: var(--lp-text);">{{ $school->phone }}</div>
                </div>
                @endif
                @if($school->email)
                <div class="p-6 rounded-2xl lp-card border card-hover reveal delay-3">
                    <div class="w-10 h-10 rounded-lg lp-accent-bg flex items-center justify-center mb-4 float-icon">
                        <svg class="w-5 h-5 lp-accent-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <div class="text-xs font-medium uppercase tracking-wider lp-text-muted mb-1">{{ __('welcome.email') }}</div>
                    <div class="text-base font-semibold" style="color: var(--lp-text);"><a href="mailto:{{ $school->email }}" class="lp-accent-text hover:underline no-underline">{{ $school->email }}</a></div>
                </div>
                @endif
                @if($school->website)
                <div class="p-6 rounded-2xl lp-card border card-hover reveal delay-4">
                    <div class="w-10 h-10 rounded-lg lp-accent-bg flex items-center justify-center mb-4 float-icon">
                        <svg class="w-5 h-5 lp-accent-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="text-xs font-medium uppercase tracking-wider lp-text-muted mb-1">{{ __('welcome.website') }}</div>
                    <div class="text-base font-semibold truncate" style="color: var(--lp-text);"><a href="{{ $school->website }}" target="_blank" class="lp-accent-text hover:underline no-underline">{{ $school->website }}</a></div>
                </div>
                @endif
                @if($school->principal_name)
                <div class="p-6 rounded-2xl lp-card border card-hover reveal delay-5">
                    <div class="w-10 h-10 rounded-lg lp-accent-bg flex items-center justify-center mb-4 float-icon">
                        <svg class="w-5 h-5 lp-accent-text" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div class="text-xs font-medium uppercase tracking-wider lp-text-muted mb-1">{{ __('welcome.principal') }}</div>
                    <div class="text-base font-semibold" style="color: var(--lp-text);">{{ $school->principal_name }}</div>
                </div>
                @endif
            </div>

            @if($school->social_facebook || $school->social_twitter || $school->social_instagram || $school->social_linkedin)
            <div class="mt-12 text-center reveal">
                <p class="text-sm font-medium lp-text-muted mb-4">{{ __('welcome.follow_us') }}</p>
                <div class="flex items-center justify-center gap-3">
                    @if($school->social_facebook)
                    <a href="{{ $school->social_facebook }}" target="_blank" class="w-10 h-10 rounded-full border lp-btn-social flex items-center justify-center transition-all no-underline" aria-label="Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    @if($school->social_twitter)
                    <a href="{{ $school->social_twitter }}" target="_blank" class="w-10 h-10 rounded-full border lp-btn-social flex items-center justify-center transition-all no-underline" aria-label="Twitter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    @endif
                    @if($school->social_instagram)
                    <a href="{{ $school->social_instagram }}" target="_blank" class="w-10 h-10 rounded-full border lp-btn-social flex items-center justify-center transition-all no-underline" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif
                    @if($school->social_linkedin)
                    <a href="{{ $school->social_linkedin }}" target="_blank" class="w-10 h-10 rounded-full border lp-btn-social flex items-center justify-center transition-all no-underline" aria-label="LinkedIn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA -->
    @if($school->email)
    <section class="py-20 sm:py-28 px-4 sm:px-6 text-center reveal">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight" style="color: var(--lp-text);">{{ __('welcome.start_journey') }}</h2>
            <p class="mt-4 text-lg lp-text-muted">{{ __('welcome.ready_to_join') }} {{ $school->nameEn }}? {{ __('welcome.contact_us') }} {{ __('welcome.learn_more') }}.</p>
            <div class="mt-8">
                <a href="mailto:{{ $school->email }}" class="inline-flex items-center gap-2 px-8 py-3.5 lp-btn-accent font-semibold rounded-2xl transition-all hover:-translate-y-1 shadow-lg no-underline btn-primary" style="box-shadow: 0 4px 14px -2px var(--lp-accent-glow);">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    {{ __('welcome.contact_us') }}
                </a>
            </div>
        </div>
    </section>
    @endif

    </main>

    <!-- Footer -->
    <footer class="border-t lp-card" style="border-top-color: var(--lp-card-border);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-center sm:text-left">
                    <p class="text-sm lp-text-muted">&copy; {{ date('Y') }} {{ $school->nameEn }}. {{ __('welcome.all_rights') }}</p>
                    @if($school->address)
                    <p class="text-xs lp-text-muted mt-1">{{ $school->address }}</p>
                    @endif
                </div>
                <div>
                    <a href="mailto:kashmos@outlook.com" class="text-sm lp-text-muted hover-lp-accent transition-colors no-underline">{{ __('welcome.powered_by') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to top -->
    <button id="toTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full text-white shadow-lg transition-all flex items-center justify-center opacity-0 translate-y-4 pointer-events-none" style="background: var(--lp-accent); box-shadow: 0 4px 14px -2px var(--lp-accent-glow);" aria-label="{{ __('welcome.scroll_top') }}">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
    </button>

    <script>
        (function() {
            // Scroll to top button
            const toTop = document.getElementById('toTop');
            if (toTop) {
                window.addEventListener('scroll', () => {
                    const visible = window.scrollY > 400;
                    toTop.style.opacity = visible ? '1' : '0';
                    toTop.style.transform = visible ? 'translateY(0)' : 'translateY(1rem)';
                    toTop.style.pointerEvents = visible ? 'auto' : 'none';
                }, { passive: true });
            }

            // Scroll reveal observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
                observer.observe(el);
            });

            // Smooth scroll for nav links
            document.querySelectorAll('a[href^="#"]').forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    if (href === '#') return;
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        const nav = document.querySelector('nav');
                        const offset = nav ? nav.offsetHeight : 0;
                        const top = target.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top, behavior: 'smooth' });
                    }
                });
            });

            // Intersection Observer for nav background
            const hero = document.getElementById('hero');
            const nav = document.querySelector('nav');
            if (hero && nav) {
                const heroObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (!entry.isIntersecting) {
                            nav.classList.add('shadow-sm');
                        } else {
                            nav.classList.remove('shadow-sm');
                        }
                    });
                }, { threshold: 0 });
                heroObserver.observe(hero);
            }
        })();
    </script>
</body>
</html>
