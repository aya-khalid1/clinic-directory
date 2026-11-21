<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'ClinicCare') — Clinic Appointment Directory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        :root { --bg-app: #f8fafc; --text-primary: #0f172a; }
        @media (prefers-color-scheme: dark) { :root { --bg-app: #0b1120; --text-primary: #f8fafc; } }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-app); color: var(--text-primary); margin: 0; }
        .glass-nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .smooth-transition { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="min-h-screen flex flex-col selection:bg-sky-500 selection:text-white">
@php
    $nav = [
        ['home', 'home', 'Home', 'fa-home'],
        ['clinics.index', 'clinics.*', 'Clinics', 'fa-hospital'],
        ['doctors.index', 'doctors.*', 'Doctors', 'fa-user-doctor'],
        ['appointments.index', 'appointments.*', 'My Appointments', 'fa-calendar-alt'],
    ];
    $apptCount = count(session('my_appointments', []));
@endphp

<header class="sticky top-0 z-40 glass-nav bg-white/90 dark:bg-slate-900/90 border-b border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-sky-600/20 group-hover:scale-105 smooth-transition">
                <i class="fas fa-heart-pulse text-lg"></i>
            </div>
            <div>
                <span class="font-extrabold text-base sm:text-lg tracking-tight text-slate-900 dark:text-white block leading-none">
                    Clinic<span class="text-sky-600 dark:text-sky-400">Care</span>
                </span>
                <span class="text-[11px] font-medium text-slate-500 dark:text-slate-400">Appointment Directory</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-1 bg-slate-100 dark:bg-slate-800/80 p-1 rounded-xl border border-slate-200/70 dark:border-slate-700/70">
            @foreach ($nav as [$route, $pattern, $label])
                <a href="{{ route($route) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold smooth-transition flex items-center gap-1.5 {{ request()->routeIs($pattern) ? 'bg-white dark:bg-slate-900 text-sky-600 dark:text-sky-400 shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white' }}">
                    <span>{{ $label }}</span>
                    @if ($route === 'appointments.index')
                        <span class="bg-sky-600 text-white text-[11px] font-bold px-1.5 rounded-full">{{ $apptCount }}</span>
                    @endif
                </a>
            @endforeach
        </nav>

        <a href="{{ route('doctors.index') }}" class="px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-sky-600 hover:bg-sky-700 text-white shadow-sm shadow-sky-600/20 smooth-transition flex items-center gap-1.5">
            <i class="fas fa-calendar-check"></i>
            <span>Book Now</span>
        </a>
    </div>

    <div class="flex md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-2 py-1.5 justify-around text-xs font-semibold">
        @foreach ($nav as [$route, $pattern, $label, $icon])
            <a href="{{ route($route) }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-lg {{ request()->routeIs($pattern) ? 'text-sky-600 dark:text-sky-400' : 'text-slate-500 dark:text-slate-400' }}">
                <i class="fas {{ $icon }}"></i>
                <span>{{ $route === 'appointments.index' ? 'Bookings' : $label }}</span>
            </a>
        @endforeach
    </div>
</header>

<main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @yield('content')
</main>

<footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-400">
        <div class="flex items-center gap-2">
            <i class="fas fa-hospital-user text-sky-600 dark:text-sky-400"></i>
            <span class="font-semibold text-slate-700 dark:text-slate-200">ClinicCare Directory</span>
            <span>• Amman, Zarqa & Irbid</span>
        </div>
        <p class="text-xs text-center sm:text-right">
            Web Applications Development II — Group 5 (Clinics, Specialties, Doctors & Schedules)
        </p>
    </div>
</footer>

@if (session('status'))
    <div id="toast" class="fixed bottom-5 right-5 z-50 max-w-sm w-full px-4 py-3 rounded-xl shadow-xl border text-white flex items-center gap-3 text-sm font-semibold {{ session('status_type') === 'error' ? 'bg-rose-600 border-rose-500' : 'bg-emerald-600 border-emerald-500' }}">
        <i class="fas {{ session('status_type') === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check' }} text-lg"></i>
        <span>{{ session('status') }}</span>
    </div>
    <script>setTimeout(() => document.getElementById('toast')?.remove(), 3500)</script>
@endif
</body>
</html>
