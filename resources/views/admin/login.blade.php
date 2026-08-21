<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIH Console Login | Bengal IT Hub</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        (function() {
            var stored = localStorage.getItem('bith-theme');
            var isDark = stored ? stored === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <style>
        :root {
            --font-display: 'Fraunces', serif;
            --font-heading: 'Outfit', sans-serif;
            --font-body:    'Inter', sans-serif;
            
            /* Light mode tokens */
            --a-primary:      #1E4A5F;
            --a-primary-lt:   #2E7089;
            --a-gold:         #E8AA3D;
            --a-gold-lt:      #F5C978;
            --a-surface:      #FFFFFF;
            --a-surface-alt:  #E8F0F1;
            --a-bg:           #F5F8F8;
            --a-border:       #DCE6E8;
            --a-text:         #0F262E;
            --a-text-muted:   #52707A;
            --a-success:      #10B981;
            --a-danger:       #EF4444;
            --a-danger-bg:    #FEF2F2;
            --a-danger-border:#FECACA;
        }

        html.dark {
            /* Dark mode tokens */
            --a-primary:      #4F9BB8;
            --a-primary-lt:   #6FB6D0;
            --a-gold:         #E8AA3D;
            --a-gold-lt:      #F5C978;
            --a-surface:      #123039;
            --a-surface-alt:  #163944;
            --a-bg:           #0A1F28;
            --a-border:       #21454F;
            --a-text:         #EAF4F6;
            --a-text-muted:   #93B2BA;
            --a-success:      #10B981;
            --a-danger:       #F87171;
            --a-danger-bg:    #1F1D2B;
            --a-danger-border:#5C2B29;
            color-scheme: dark;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: var(--font-body);
            background-color: var(--a-bg);
            color: var(--a-text);
            transition: background-color 260ms ease, color 260ms ease;
        }

        .login-shell {
            min-height: 100vh;
            display: flex;
            background-color: var(--a-bg);
        }

        .login-brand-panel, .login-form-panel {
            flex: 1 1 50%;
            align-self: stretch;
            min-height: 0;
        }
        .login-brand-panel {
            flex-basis: 52%;
        }
        .login-form-panel {
            flex-basis: 48%;
        }

        @media (max-width: 960px) {
            .login-shell {
                flex-direction: column;
            }
            .login-brand-panel, .login-form-panel {
                flex-basis: auto;
            }
        }

        /* ---------------- Left Brand Panel ---------------- */
        .login-brand-panel {
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 20% 15%, #2E7089 0%, #123544 55%, #0A1F28 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 56px 64px;
        }

        @media (max-width: 960px) {
            .login-brand-panel {
                padding: 40px 32px;
                min-height: 340px;
            }
        }

        .login-brand-panel .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.55;
            animation: loginBlob 18s ease-in-out infinite;
            pointer-events: none;
        }
        .login-brand-panel .blob-1 {
            width: 380px; height: 380px;
            top: -100px; right: -100px;
            background-color: #F2A93B;
            animation-delay: 0s;
        }
        .login-brand-panel .blob-2 {
            width: 320px; height: 320px;
            bottom: -140px; left: -80px;
            background-color: #2E7089;
            animation-delay: -7s;
        }
        .login-brand-panel .blob-3 {
            width: 220px; height: 220px;
            bottom: 30%; right: 10%;
            background-color: #FF6B5D;
            opacity: 0.3;
            animation-delay: -10s;
        }

        @keyframes loginBlob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(24px, -18px) scale(1.08); }
        }

        .login-brand-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            opacity: 0.06;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        .login-brand-top {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }
        .login-brand-top img {
            height: 92px;
            width: 92px;
            object-fit: contain;
            filter: drop-shadow(0 6px 18px rgba(0, 0, 0, 0.45));
            transition: transform 0.22s ease;
        }
        .login-brand-top:hover img {
            transform: scale(1.05);
        }

        .login-brand-mid {
            position: relative;
            z-index: 1;
            max-width: 480px;
            margin: 40px 0;
        }
        .login-brand-mid .eyebrow-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-heading);
            font-size: 0.74rem;
            font-weight: 600;
            letter-spacing: 0.10em;
            text-transform: uppercase;
            color: #F5C978;
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 7px 16px;
            border-radius: 999px;
            margin-bottom: 22px;
        }
        .login-brand-mid .eyebrow-pill .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #F2A93B;
            box-shadow: 0 0 0 3px rgba(242, 169, 59, 0.25);
        }
        .login-brand-mid h1 {
            font-family: var(--font-display);
            font-weight: 600;
            font-style: italic;
            font-size: clamp(1.9rem, 3vw, 2.5rem);
            line-height: 1.2;
            margin: 0 0 18px;
            color: #fff;
        }
        .login-brand-mid p {
            color: #A9C7CE;
            font-size: 1.05rem;
            line-height: 1.7;
            margin: 0;
        }

        .login-brand-pills {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .login-brand-pills span {
            display: inline-flex;
            align-items: center;
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.04em;
            color: #EAF4F6;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 16px;
            border-radius: 999px;
            backdrop-filter: blur(4px);
        }

        /* ---------------- Right Form Panel ---------------- */
        .login-form-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
            background-color: var(--a-surface);
            transition: background-color 260ms ease;
        }

        .login-theme-toggle {
            position: absolute;
            top: 32px;
            right: 40px;
            width: 54px;
            height: 30px;
            border-radius: 999px;
            background-color: var(--a-bg);
            border: 1px solid var(--a-border);
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            transition: background-color 260ms ease, border-color 260ms ease;
        }
        .login-theme-toggle .knob {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: var(--a-primary);
            margin-left: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            transition: transform 280ms ease, background-color 280ms ease;
        }
        html.dark .login-theme-toggle .knob {
            transform: translateX(24px);
            background-color: #F2A93B;
            color: #12242B;
        }

        .login-form-inner {
            width: 100%;
            max-width: 400px;
        }
        .login-form-inner .mobile-logo {
            display: none;
            margin-bottom: 24px;
            text-decoration: none;
        }
        .login-form-inner .mobile-logo img {
            height: 72px;
            width: 72px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.18));
        }
        @media (max-width: 960px) {
            .login-form-inner .mobile-logo {
                display: inline-flex;
                align-items: center;
            }
        }

        .login-form-inner .kicker {
            font-family: var(--font-heading);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--a-gold);
            margin-bottom: 8px;
            display: block;
        }
        .login-form-inner h2 {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 600;
            margin: 0 0 8px;
            color: var(--a-text);
            line-height: 1.2;
        }
        .login-form-inner .sub {
            color: var(--a-text-muted);
            font-size: 0.94rem;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        /* Alert / Error notification */
        .login-alert {
            margin-bottom: 20px;
            border: 1px solid var(--a-danger-border);
            border-radius: 8px;
            background-color: var(--a-danger-bg);
            padding: 12px 16px;
            color: var(--a-danger);
            font-size: 0.86rem;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .login-alert svg {
            flex-shrink: 0;
            margin-top: 1px;
        }

        .field-group {
            margin-bottom: 20px;
            position: relative;
        }
        .field-group label {
            display: block;
            font-family: var(--font-heading);
            font-weight: 600;
            font-size: 0.84rem;
            color: var(--a-text);
            margin-bottom: 8px;
        }
        .field-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .field-input-wrap .field-icon {
            position: absolute;
            left: 14px;
            color: var(--a-text-muted);
            pointer-events: none;
            display: flex;
        }
        .field-input-wrap input {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border-radius: 10px;
            border: 1.5px solid var(--a-border);
            font-family: inherit;
            font-size: 0.94rem;
            background-color: var(--a-bg);
            color: var(--a-text);
            transition: border-color 180ms ease, box-shadow 180ms ease, background-color 260ms ease;
        }
        .field-input-wrap input:focus {
            outline: none;
            border-color: var(--a-primary);
            box-shadow: 0 0 0 4px rgba(30, 74, 95, 0.15);
            background-color: var(--a-surface);
        }
        html.dark .field-input-wrap input:focus {
            box-shadow: 0 0 0 4px rgba(79, 155, 184, 0.2);
            border-color: var(--a-primary);
        }

        .field-toggle-visibility {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--a-text-muted);
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 180ms ease;
        }
        .field-toggle-visibility:hover {
            color: var(--a-text);
        }

        .field-row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.86rem;
        }
        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--a-text-muted);
            cursor: pointer;
            user-select: none;
        }
        .remember-check input {
            accent-color: var(--a-primary);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        .forgot-link {
            color: var(--a-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 180ms ease;
        }
        .forgot-link:hover {
            text-decoration: underline;
        }
        html.dark .forgot-link {
            color: var(--a-gold-lt);
        }

        .btn-signin {
            width: 100%;
            padding: 14px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, var(--a-primary), var(--a-primary-lt));
            color: #fff;
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 0.98rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 24px rgba(10, 31, 40, 0.22);
            transition: transform 200ms ease, box-shadow 200ms ease, opacity 200ms ease;
        }
        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 32px rgba(10, 31, 40, 0.32);
        }
        .btn-signin:active {
            transform: translateY(0);
        }

        .login-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 28px 0;
            color: var(--a-text-muted);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .login-divider::before, .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--a-border);
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            border-radius: 10px;
            background-color: var(--a-bg);
            border: 1px solid var(--a-border);
            font-size: 0.82rem;
            color: var(--a-text-muted);
            line-height: 1.5;
        }
        .security-note svg {
            color: var(--a-success);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .login-footer-note {
            text-align: center;
            margin-top: 28px;
            font-size: 0.84rem;
            color: var(--a-text-muted);
        }
        .login-footer-note a {
            color: var(--a-primary);
            font-weight: 600;
            text-decoration: none;
        }
        .login-footer-note a:hover {
            text-decoration: underline;
        }
        html.dark .login-footer-note a {
            color: var(--a-gold-lt);
        }
    </style>
</head>
<body>

<div class="login-shell">
    {{-- ── Left Brand / Art Panel ── --}}
    <div class="login-brand-panel">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <a href="{{ route('home') }}" class="login-brand-top" aria-label="Bengal IT Hub home">
            <img src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub logo" width="92" height="92">
        </a>

        <div class="login-brand-mid">
            <span class="eyebrow-pill"><span class="dot"></span> Welcome</span>
            <h1>Your Admin Console</h1>
            <p>Secure workspace for Bengal IT Hub content, leads, partners, events, and website operations.</p>
        </div>

        <div class="login-brand-pills">
            <span>CMS</span>
            <span>Leads</span>
            <span>Events</span>
        </div>
    </div>

    {{-- ── Right Form Panel ── --}}
    <div class="login-form-panel">
        <button type="button" class="login-theme-toggle" id="themeToggleBtn" aria-label="Toggle dark mode">
            <span class="knob">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/></svg>
            </span>
        </button>

        <div class="login-form-inner">
            <a href="{{ route('home') }}" class="mobile-logo" aria-label="Bengal IT Hub home">
                <img src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub logo" width="72" height="72">
            </a>

            <span class="kicker">Welcome Back</span>
            <h2>Sign in</h2>
            <p class="sub">Use your Bengal IT Hub admin credentials to continue.</p>

            @if($errors->any())
                <div class="login-alert" role="alert">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('status'))
                <div class="login-alert" style="border-color: #A7F3D0; background-color: #ECFDF5; color: #065F46;" role="status">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.authenticate') }}">
                @csrf

                <div class="field-group">
                    <label for="email">Email address</label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="3.2"/><path d="M5.8 19.2c.8-3.2 3-4.8 6.2-4.8s5.4 1.6 6.2 4.8"/></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                    </div>
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5.5" y="10" width="13" height="9" rx="2"/><path d="M8.5 10V7.6a3.5 3.5 0 0 1 7 0V10"/></svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                        <button type="button" class="field-toggle-visibility" id="togglePasswordBtn" aria-label="Toggle password visibility">
                            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <div class="field-row-between">
                    <label class="remember-check" for="remember">
                        <input type="checkbox" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember this device</span>
                    </label>
                    <a href="{{ route('home') }}" class="forgot-link">Back to website</a>
                </div>

                <button type="submit" class="btn-signin">
                    Sign in
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </form>

            <div class="login-divider">Protected Area</div>

            <div class="security-note">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>This area requires administrative authentication and is not indexed by search engines. Access is logged.</span>
            </div>

            <p class="login-footer-note">Not an administrator? <a href="{{ route('home') }}">Return to the website &rarr;</a></p>
        </div>
    </div>
</div>

<script>
(function () {
    // Password show / hide
    var toggleBtn = document.getElementById('togglePasswordBtn');
    var passwordInput = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');
    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        });
    }

    // Theme toggle
    var themeBtn = document.getElementById('themeToggleBtn');
    if (themeBtn) {
        themeBtn.addEventListener('click', function () {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('bith-theme', isDark ? 'dark' : 'light');
        });
    }
})();
</script>
</body>
</html>
