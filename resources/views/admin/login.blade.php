<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>BIH Console Login</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html,
        body {
            min-height: 100%;
        }

        body.bih-admin-login-body {
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            background:
                radial-gradient(circle at 15% 18%, rgba(15, 118, 110, .28), transparent 18rem),
                radial-gradient(circle at 82% 82%, rgba(2, 132, 199, .22), transparent 17rem),
                linear-gradient(135deg, #020617 0%, #102033 52%, #0f766e 100%) !important;
            color: #0f172a;
            font-family: Manrope, ui-sans-serif, system-ui, sans-serif;
        }

        .bih-admin-login-stage {
            position: relative;
            display: grid;
            min-height: 100vh;
            place-items: center;
            padding: 2rem;
        }

        .bih-admin-login-card {
            position: relative;
            display: grid;
            width: min(94vw, 920px);
            min-height: 420px;
            grid-template-columns: 1.08fr .92fr;
            overflow: hidden;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 34px 78px rgba(2, 6, 23, .38);
        }

        .bih-admin-login-card::before,
        .bih-admin-login-card::after {
            content: "";
            position: absolute;
            z-index: 5;
            border-radius: 999px;
            pointer-events: none;
        }

        .bih-admin-login-card::before {
            left: -78px;
            bottom: -84px;
            width: 210px;
            height: 210px;
            background: linear-gradient(145deg, rgba(20, 184, 166, .26), rgba(15, 23, 42, .08));
        }

        .bih-admin-login-card::after {
            right: -68px;
            bottom: -76px;
            width: 170px;
            height: 170px;
            background: linear-gradient(145deg, rgba(45, 212, 191, .74), rgba(15, 118, 110, .95));
        }

        .bih-admin-login-welcome {
            position: relative;
            display: flex;
            min-height: 420px;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
            border-top-right-radius: 48% 100%;
            border-bottom-right-radius: 48% 100%;
            background:
                linear-gradient(90deg, rgba(255, 255, 255, .08), transparent 48%),
                radial-gradient(circle at 76% 70%, rgba(45, 212, 191, .22), transparent 8rem),
                linear-gradient(145deg, #102033 0%, #0f3348 52%, #0f766e 100%);
            padding: 2.1rem 6rem 2.1rem 3.1rem;
            color: #fff;
        }

        .bih-admin-login-welcome::before,
        .bih-admin-login-welcome::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .bih-admin-login-welcome::before {
            right: 1rem;
            bottom: 3.35rem;
            width: 160px;
            height: 160px;
            background:
                radial-gradient(circle at 35% 30%, rgba(255, 255, 255, .22), transparent 2.4rem),
                linear-gradient(145deg, #2dd4bf, #0f766e);
            box-shadow: 0 22px 46px rgba(15, 23, 42, .25);
        }

        .bih-admin-login-welcome::after {
            left: 2rem;
            bottom: -5.2rem;
            width: 195px;
            height: 195px;
            background: linear-gradient(145deg, rgba(45, 212, 191, .22), rgba(255, 255, 255, .08));
        }

        .bih-admin-login-logo-wrap,
        .bih-admin-login-copy,
        .bih-admin-login-pills {
            position: relative;
            z-index: 2;
        }

        .bih-admin-login-logo-wrap {
            display: grid;
            width: 118px;
            height: 118px;
            place-items: center;
            border: 1px solid rgba(15, 118, 110, .16);
            border-radius: 999px;
            background: rgba(255, 255, 255, .96);
            padding: .85rem;
            box-shadow: 0 16px 32px rgba(15, 23, 42, .16);
        }

        .bih-admin-login-logo-wrap img,
        .bih-admin-login-mobile-logo {
            display: block;
            width: 100%;
            height: auto;
            max-height: 76px;
            object-fit: contain;
        }

        .bih-admin-login-mobile-logo {
            width: 138px;
            max-height: 92px;
            border: 1px solid rgba(15, 118, 110, .14);
            border-radius: 999px;
            background: #fff;
            padding: .8rem;
            box-shadow: 0 14px 28px rgba(15, 23, 42, .12);
        }

        .bih-admin-login-copy {
            max-width: 300px;
            margin-top: 1.65rem;
        }

        .bih-admin-login-copy p {
            margin: 0;
            color: rgba(255, 255, 255, .88);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .bih-admin-login-copy h1 {
            margin: .52rem 0 0;
            color: #fff;
            font-size: 34px;
            font-weight: 900;
            line-height: 1.02;
            font-family: "Plus Jakarta Sans", Manrope, ui-sans-serif, system-ui, sans-serif;
        }

        .bih-admin-login-copy span {
            display: block;
            margin-top: .7rem;
            color: rgba(255, 255, 255, .73);
            font-size: 13px;
            font-weight: 700;
            line-height: 1.7;
        }

        .bih-admin-login-pills {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: auto;
            padding-top: 1.4rem;
        }

        .bih-admin-login-pills span {
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 999px;
            background: rgba(255, 255, 255, .12);
            padding: .32rem .65rem;
            color: rgba(240, 253, 250, .94);
            font-size: 11px;
            font-weight: 900;
        }

        .bih-admin-login-form {
            position: relative;
            z-index: 6;
            display: flex;
            min-width: 0;
            flex-direction: column;
            justify-content: center;
            background: #fff;
            padding: 2rem 2.65rem 2rem 2.25rem;
        }

        .bih-admin-login-mobile-logo {
            display: none;
            margin-bottom: 1.35rem;
        }

        .bih-admin-login-form h2 {
            margin: 0;
            color: #0f172a;
            font-size: 34px;
            font-weight: 900;
            line-height: 1;
            font-family: "Plus Jakarta Sans", Manrope, ui-sans-serif, system-ui, sans-serif;
        }

        .bih-admin-login-note {
            margin: .42rem 0 .45rem;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.55;
        }

        .bih-admin-login-error {
            margin-top: .75rem;
            border: 1px solid #fecaca;
            border-radius: 5px;
            background: #fef2f2;
            padding: .58rem .7rem;
            color: #991b1b;
            font-size: 12px;
            font-weight: 800;
        }

        .bih-admin-login-label {
            margin-top: .82rem;
            color: #475569;
            font-size: 12px;
            font-weight: 900;
        }

        .bih-admin-login-field {
            display: grid;
            grid-template-columns: 38px minmax(0, 1fr);
            align-items: center;
            margin-top: .32rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            background: #f8fafc;
        }

        .bih-admin-login-field:focus-within {
            border-color: #0f766e;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, .13);
        }

        .bih-admin-login-field span {
            display: grid;
            min-height: 40px;
            place-items: center;
            color: #0f766e;
        }

        .bih-admin-login-field svg {
            width: 16px;
            height: 16px;
        }

        .bih-admin-login-field input,
        body.bih-admin .bih-admin-login-field input,
        body.bih-admin .bih-admin-login-field input:focus {
            width: 100%;
            min-width: 0;
            border: 0 !important;
            border-radius: 0 !important;
            background: transparent !important;
            padding: .68rem .72rem .68rem 0 !important;
            color: #0f172a;
            font-size: 12px;
            font-weight: 800;
            outline: none;
            box-shadow: none !important;
        }

        .bih-admin-login-field input::placeholder {
            color: #94a3b8;
            font-weight: 700;
        }

        .bih-admin-login-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            margin-top: .72rem;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
        }

        .bih-admin-login-row label {
            display: inline-flex;
            align-items: center;
            gap: .42rem;
        }

        .bih-admin-login-row input,
        body.bih-admin .bih-admin-login-row input {
            width: 14px;
            height: 14px;
            padding: 0 !important;
            accent-color: #0f766e;
        }

        .bih-admin-login-row a {
            color: #0f766e;
            text-decoration: none;
        }

        .bih-admin-login-submit,
        body.bih-admin .bih-admin-login-submit {
            margin-top: 1rem;
            border: 0;
            border-radius: 4px !important;
            background: linear-gradient(135deg, #0f766e, #0284c7);
            padding: .76rem 1rem;
            color: #fff;
            font-size: 13px;
            font-weight: 900;
            box-shadow: 0 14px 28px rgba(15, 118, 110, .22);
        }

        .bih-admin-login-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 36px rgba(15, 118, 110, .28);
        }

        @media (max-width: 900px) {
            .bih-admin-login-card {
                max-width: 500px;
                min-height: 0;
                grid-template-columns: 1fr;
            }

            .bih-admin-login-welcome {
                display: none;
            }

            .bih-admin-login-form {
                padding: 1.65rem;
            }

            .bih-admin-login-mobile-logo {
                display: block;
            }
        }

        @media (max-width: 520px) {
            .bih-admin-login-stage {
                align-items: stretch;
                padding: .9rem;
            }

            .bih-admin-login-row {
                align-items: flex-start;
                flex-direction: column;
                gap: .65rem;
            }
        }
    </style>
</head>
<body class="bih-admin bih-admin-login-body">
    <main class="bih-admin-login-stage" aria-label="Admin login">
        <div class="bih-admin-login-card">
            <section class="bih-admin-login-welcome" aria-label="Bengal IT Hub console welcome">
                <div class="bih-admin-login-logo-wrap">
                    <img src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub">
                </div>
                <div class="bih-admin-login-copy">
                    <p>Welcome</p>
                    <h1>Your Admin Console</h1>
                    <span>Secure workspace for Bengal IT Hub content, leads, partners, events, and website operations.</span>
                </div>
                <div class="bih-admin-login-pills" aria-hidden="true">
                    <span>CMS</span>
                    <span>Leads</span>
                    <span>Events</span>
                </div>
            </section>

            <form method="POST" action="{{ route('admin.authenticate') }}" class="bih-admin-login-form">
                @csrf
                <img class="bih-admin-login-mobile-logo" src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub">
                <h2>Sign in</h2>
                <p class="bih-admin-login-note">Use your Bengal IT Hub admin credentials to continue.</p>

                @if($errors->any())
                    <div class="bih-admin-login-error" role="alert">{{ $errors->first() }}</div>
                @endif

                <label class="bih-admin-login-label" for="email">Email address</label>
                <div class="bih-admin-login-field">
                    <span aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.7"/><path d="M5.8 19.2c.8-3.2 3-4.8 6.2-4.8s5.4 1.6 6.2 4.8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                </div>

                <label class="bih-admin-login-label" for="password">Password</label>
                <div class="bih-admin-login-field">
                    <span aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"><rect x="5.5" y="10" width="13" height="9" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8.5 10V7.6a3.5 3.5 0 0 1 7 0V10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                    </span>
                    <input id="password" type="password" name="password" placeholder="Enter password" required>
                </div>

                <div class="bih-admin-login-row">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <span>Remember this device</span>
                    </label>
                    <a href="{{ route('home') }}">Back to website</a>
                </div>

                <button class="bih-admin-login-submit" type="submit">Sign in</button>
            </form>
        </div>
    </main>
</body>
</html>
