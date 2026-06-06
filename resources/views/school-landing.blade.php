<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>School</title>
    @php($schoolIcon = \App\Models\School::first()?->logo)
    @if($schoolIcon)
    <link rel="icon" type="image/x-icon" href="{{ $schoolIcon }}">
    <link rel="apple-touch-icon" href="{{ $schoolIcon }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        :root {
            --bg: #FDFDFC;
            --bg-alt: #f5f5f4;
            --text: #1b1b18;
            --text-muted: #706f6c;
            --border: #e3e3e0;
            --card-bg: #ffffff;
            --card-shadow: rgba(0,0,0,0.05);
            --accent: #f53003;
            --accent-hover: #d62b02;
            --accent-light: #fff2f2;
            --hero-from: #1b1b18;
            --hero-to: #2d2d2a;
            --footer-bg: #1b1b18;
            --footer-text: #A1A09A;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0a0a0a;
                --bg-alt: #111110;
                --text: #EDEDEC;
                --text-muted: #A1A09A;
                --border: #262626;
                --card-bg: #161615;
                --card-shadow: rgba(0,0,0,0.3);
                --accent: #F61500;
                --accent-hover: #d62b02;
                --accent-light: #1D0002;
                --hero-from: #0a0a0a;
                --hero-to: #1a1a18;
                --footer-bg: #0a0a0a;
                --footer-text: #706f6c;
            }
            .nav-wrap { background: rgba(10, 10, 10, 0.92); }
            .section { background: rgba(10, 10, 10, 0.88); }
            .cta { background: rgba(29, 0, 2, 0.88); }
            footer { background: rgba(10, 10, 10, 0.92); }
        }
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }
        .nav-wrap {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(253, 253, 252, 0.92);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .nav-brand { font-weight: 600; font-size: 1.1rem; color: var(--text); }
        .nav-center { display: flex; gap: 0.25rem; align-items: center; }
        .nav-center a {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: color 0.2s, background 0.2s;
        }
        .nav-center a:hover { color: var(--text); background: var(--bg-alt); }
        .nav-actions { display: flex; gap: 0.75rem; align-items: center; }
        .nav-actions a {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: color 0.2s, background 0.2s;
        }
        .nav-actions a:hover { color: var(--text); background: var(--bg-alt); }
        .nav-actions .btn-primary {
            background: var(--accent);
            color: white;
            font-weight: 600;
        }
        .nav-actions .btn-primary:hover { background: var(--accent-hover); color: white; }
        .to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 200;
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            background: var(--accent);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: opacity 0.3s, transform 0.3s, background 0.2s;
            opacity: 0;
            transform: translateY(1rem);
            pointer-events: none;
        }
        .to-top.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        .to-top:hover { background: var(--accent-hover); }
        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 85vh;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: 50% var(--parallax-y, 50%);
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }
        .hero-slide.active { opacity: 1; }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(11,11,10,0.75) 0%, rgba(11,11,10,0.45) 100%);
            z-index: 1;
        }
        .hero-content { position: relative; z-index: 2; max-width: 720px; }
        .hero h1 { font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 0.75rem; color: #ffffff; text-shadow: 0 2px 8px rgba(0,0,0,0.3); }
        .hero .name-ar { font-size: 1.25rem; color: var(--text-muted); margin-bottom: 1.5rem; font-weight: 500; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .hero .established { margin-top: 1rem; font-size: 0.875rem; color: var(--text-muted); }
        .section { max-width: 1280px; margin: 0 auto; padding: 5rem 2rem; background: rgba(253, 253, 252, 0.88); }
        .section-heading {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            letter-spacing: -0.5px;
            color: var(--text);
        }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; }
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 2px var(--card-shadow);
        }
        .card h3 { font-size: 1.05rem; font-weight: 600; margin-bottom: 0.75rem; color: var(--text); }
        .card p { font-size: 0.925rem; color: var(--text-muted); line-height: 1.7; }
        .card-icon { font-size: 1.75rem; margin-bottom: 0.75rem; }
        .card-sm {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-sm:hover { transform: translateY(-2px); box-shadow: 0 4px 12px var(--card-shadow); }
        .card-sm .label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }
        .card-sm .value { font-size: 1rem; color: var(--text); font-weight: 600; margin-top: 0.25rem; }
        .card-sm .value a { color: var(--accent); text-decoration: none; }
        .card-sm .value a:hover { text-decoration: underline; }
        .social-wrap { text-align: center; margin-top: 2.5rem; }
        .social-wrap > div { font-weight: 600; color: var(--text-muted); margin-bottom: 1rem; font-size: 0.9rem; }
        .social-links { display: flex; gap: 0.75rem; justify-content: center; }
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            border: 1px solid var(--border);
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 1rem;
        }
        .social-link:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
        .cta {
            background: rgba(255, 242, 242, 0.88);
            border-top: 1px solid var(--border);
            text-align: center;
            padding: 5rem 2rem;
        }
        .cta h2 { font-size: 2rem; font-weight: 700; letter-spacing: -1px; margin-bottom: 1rem; }
        .cta p { color: var(--text-muted); max-width: 500px; margin: 0 auto 2rem; }
        .cta-btn {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, transform 0.2s;
        }
        .cta-btn:hover { background: var(--accent-hover); transform: translateY(-1px); }
        footer {
            background: rgba(27, 27, 24, 0.92);
            color: var(--footer-text);
            padding: 0.5rem 2rem;
            font-size: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* ===== Scroll Reveal ===== */
        .reveal { opacity: 0; transform: translateY(2.5rem); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-3rem); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(3rem); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .delay-1 { transition-delay: 0.12s; }
        .delay-2 { transition-delay: 0.24s; }
        .delay-3 { transition-delay: 0.36s; }
        .delay-4 { transition-delay: 0.48s; }

        /* ===== Hero Entrance ===== */
        .hero-content { animation: heroFadeUp 1s ease forwards; }
        @keyframes heroFadeUp { 0% { opacity: 0; transform: translateY(1.5rem); } 100% { opacity: 1; transform: translateY(0); } }
        .hero .hero-badge { opacity: 0; animation: badgeFadeIn 0.8s ease 0.4s forwards; }
        .hero .established { opacity: 0; animation: badgeFadeIn 0.8s ease 0.6s forwards; }
        @keyframes badgeFadeIn { 0% { opacity: 0; transform: translateY(0.5rem); } 100% { opacity: 1; transform: translateY(0); } }
        .hero-slide { will-change: transform; }

        /* ===== Enhanced Hover Effects ===== */
        .card { transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.3s ease; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px var(--card-shadow); border-color: var(--accent); }
        .card-sm { transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.3s ease; }
        .card-sm:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 12px 32px var(--card-shadow); border-color: var(--accent); }
        .social-link { transition: all 0.3s ease; }
        .social-link:hover { transform: scale(1.12); border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
        .cta-btn { transition: background 0.3s, transform 0.3s, box-shadow 0.3s; }
        .cta-btn:hover { transform: translateY(-2px) scale(1.02); box-shadow: 0 8px 24px rgba(245, 48, 3, 0.3); }
        .nav-center a { position: relative; }
        .nav-center a::after { content: ''; position: absolute; bottom: 2px; left: 50%; width: 0; height: 2px; background: var(--accent); transition: width 0.3s ease, left 0.3s ease; }
        .nav-center a:hover::after { width: 60%; left: 20%; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.25rem; }
            .grid-2 { grid-template-columns: 1fr; }
            .section { padding: 3rem 1.5rem; }
            .nav { padding: 0.75rem 1.25rem; }
        }
    </style>
</head>
<body>
    <div style="position: fixed; inset: 0; z-index: -1; background: url('/images/landing-bg.jpg') center/cover no-repeat fixed;"></div>
    <div class="nav-wrap">
    <header class="nav">
        <div class="nav-brand">{{ $school->nameEn }}</div>
        <div class="nav-center">
            <a href="#hero">Home</a>
            @if($school->mission || $school->vision)<a href="#about">About</a>@endif
            <a href="#info">Contact</a>
            <a href="#get-in-touch">Get in Touch</a>
        </div>
        <div class="nav-actions">
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">Register</a>
                @endif
            @endauth
        </div>
    </header>
    </div>

    <main>

    <div class="hero" id="hero">
        <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?w=1600&q=80');"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c7f1?w=1600&q=80');"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=1600&q=80');"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1600&q=80');"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1600&q=80');"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            @if($school->logo)
            <img src="{{ $school->logo }}" alt="{{ $school->nameEn }}" style="height: 72px; margin-bottom: 1.5rem;">
            @endif
            <h1>{{ $school->nameEn }}</h1>
            <div class="name-ar" style="color: rgba(255,255,255,0.8);">{{ $school->nameAr }}</div>
            @if($school->address)
            <div class="hero-badge" style="background: rgba(255,255,255,0.12); color: #fff; backdrop-filter: blur(6px);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $school->address }}
            </div>
            @endif
            @if($school->established_year)
            <div class="established" style="color: rgba(255,255,255,0.6);">Established {{ $school->established_year }}</div>
            @endif
        </div>
    </div>

    <script>
        (function() {
            const slides = document.querySelectorAll('.hero-slide');
            let current = 0;
            const total = slides.length;
            if (total < 2) return;
            setInterval(() => {
                slides[current].classList.remove('active');
                current = (current + 1) % total;
                slides[current].classList.add('active');
            }, 5000);
        })();
    </script>

    @if($school->mission || $school->vision)
    <div class="section reveal" id="about">
        <div class="section-heading">Mission & Vision</div>
        <div class="grid-2">
            @if($school->mission)
            <div class="card reveal-left delay-1">
                <h3>Our Mission</h3>
                <p>{{ $school->mission }}</p>
            </div>
            @endif
            @if($school->vision)
            <div class="card reveal-right delay-2">
                <h3>Our Vision</h3>
                <p>{{ $school->vision }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="section reveal" id="info" style="padding-top: 0;">
        <div class="section-heading">Contact & Information</div>
        <div class="grid-4">
            @if($school->phone)
            <div class="card-sm reveal delay-1">
                <div class="card-icon">📞</div>
                <div class="label">Phone</div>
                <div class="value">{{ $school->phone }}</div>
            </div>
            @endif
            @if($school->email)
            <div class="card-sm reveal delay-2">
                <div class="card-icon">✉️</div>
                <div class="label">Email</div>
                <div class="value"><a href="mailto:{{ $school->email }}">{{ $school->email }}</a></div>
            </div>
            @endif
            @if($school->website)
            <div class="card-sm reveal delay-3">
                <div class="card-icon">🌐</div>
                <div class="label">Website</div>
                <div class="value"><a href="{{ $school->website }}" target="_blank">{{ $school->website }}</a></div>
            </div>
            @endif
            @if($school->principal_name)
            <div class="card-sm reveal delay-4">
                <div class="card-icon">👤</div>
                <div class="label">Principal</div>
                <div class="value">{{ $school->principal_name }}</div>
            </div>
            @endif
        </div>

        @if($school->social_facebook || $school->social_twitter || $school->social_instagram || $school->social_linkedin)
        <div class="social-wrap reveal">
            <div>Follow Us</div>
            <div class="social-links">
                @if($school->social_facebook)
                <a href="{{ $school->social_facebook }}" target="_blank" class="social-link" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                @endif
                @if($school->social_twitter)
                <a href="{{ $school->social_twitter }}" target="_blank" class="social-link" aria-label="Twitter">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                @endif
                @if($school->social_instagram)
                <a href="{{ $school->social_instagram }}" target="_blank" class="social-link" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                @endif
                @if($school->social_linkedin)
                <a href="{{ $school->social_linkedin }}" target="_blank" class="social-link" aria-label="LinkedIn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>

    @if($school->email)
    <div class="cta reveal" id="get-in-touch">
        <h2>Get in Touch</h2>
        <p>We'd love to hear from you. Reach out for inquiries, admissions, or any questions.</p>
        <a href="mailto:{{ $school->email }}" class="cta-btn">Contact Us</a>
    </div>
    @endif
    </main>

    <button class="to-top" id="toTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Scroll to top">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
    </button>

    <script>
        (function() {
            const slides = document.querySelectorAll('.hero-slide');
            let current = 0;
            const total = slides.length;
            if (total > 1) {
                setInterval(() => {
                    slides[current].classList.remove('active');
                    current = (current + 1) % total;
                    slides[current].classList.add('active');
                }, 5000);
            }
            const toTop = document.getElementById('toTop');
            if (toTop) {
                window.addEventListener('scroll', () => {
                    toTop.classList.toggle('visible', window.scrollY > 400);
                });
            }

            // Hero parallax
            const hero = document.getElementById('hero');
            if (hero) {
                window.addEventListener('scroll', () => {
                    const rect = hero.getBoundingClientRect();
                    const offset = rect.top;
                    if (offset < 0 && offset > -window.innerHeight) {
                        hero.style.setProperty('--parallax-y', (offset * 0.1) + 'px');
                    } else {
                        hero.style.setProperty('--parallax-y', '0px');
                    }
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
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
                observer.observe(el);
            });

            // Smooth nav scroll with offset
            document.querySelectorAll('.nav-center a[href^="#"]').forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        })();
    </script>

    <footer>
        <div>
            <p>&copy; {{ date('Y') }} {{ $school->nameEn }}. All rights reserved.</p>
            @if($school->address)
            <p style="margin-top: 0.25rem;">{{ $school->address }}</p>
            @endif
        </div>
        <div>
            <a href="mailto:kashmos@outlook.com" style="color: var(--footer-text); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#f53003'" onmouseout="this.style.color=''">Powered by Kashmos</a>
        </div>
    </footer>
</body>
</html>
