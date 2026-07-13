<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIH Console Login</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo_bengal_it_hub.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bih-admin grid min-h-screen place-items-center px-5 py-10">
    <div class="w-full max-w-5xl overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 lg:grid lg:grid-cols-[1fr_.9fr]">
        <section class="hidden bg-teal-700 p-10 text-white lg:grid">
            <div>
                <img class="h-28 w-auto max-w-[280px] rounded-lg bg-white p-2" src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub">
                <h1 class="mt-8 text-4xl font-black leading-tight text-white">Bengal IT Hub Console</h1>
                <p class="mt-4 max-w-md text-lg leading-8 text-white/90">Manage pages, services, events, leads, partners, FAQs, blog posts, and website settings from one secure workspace.</p>
            </div>
            <div class="mt-auto grid grid-cols-3 gap-3 text-sm font-bold">
                <div class="rounded-lg bg-white/16 p-4">CMS</div>
                <div class="rounded-lg bg-white/16 p-4">Events</div>
                <div class="rounded-lg bg-white/16 p-4">Leads</div>
            </div>
        </section>

        <form method="POST" action="{{ route('admin.authenticate') }}" class="p-8 md:p-10">
            @csrf
            <img class="h-24 w-auto max-w-[260px] lg:hidden" src="{{ asset('logo_bengal_it_hub.svg') }}" alt="Bengal IT Hub">
            <p class="mt-2 text-sm font-black uppercase text-teal-700 lg:mt-0">Secure Access</p>
            <h2 class="mt-3 text-3xl font-black text-slate-950">Staff Console</h2>
            <p class="mt-2 text-sm font-semibold text-slate-600">Private admin access for Bengal IT Hub staff.</p>

            @if($errors->any())
                <div class="mt-5 rounded-lg border border-red-200 bg-red-50 p-3 text-sm font-bold text-red-900">{{ $errors->first() }}</div>
            @endif

            <label class="mt-6 block text-sm font-black">Email</label>
            <input class="mt-2 w-full rounded border border-slate-300 px-4 py-3" type="email" name="email" value="{{ old('email') }}" required autofocus>

            <label class="mt-4 block text-sm font-black">Password</label>
            <input class="mt-2 w-full rounded border border-slate-300 px-4 py-3" type="password" name="password" required>

            <label class="mt-4 flex items-center gap-2 text-sm font-bold">
                <input type="checkbox" name="remember" value="1"> Remember this device
            </label>

            <button class="mt-6 w-full rounded bg-teal-700 px-5 py-3 font-black text-white">Login</button>
            <a class="mt-4 inline-flex text-sm font-black text-slate-600 hover:text-teal-700" href="{{ route('home') }}">Back to website</a>
        </form>
    </div>
</body>
</html>
