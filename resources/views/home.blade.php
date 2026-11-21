@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-sky-950 to-teal-950 text-white p-6 sm:p-10 lg:p-14 shadow-xl border border-slate-800">
        <div class="max-w-3xl relative z-10">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-500/20 border border-sky-400/30 text-sky-300 text-xs font-semibold mb-4">
                <i class="fas fa-location-dot"></i>
                <span>Trusted Clinics in Amman, Zarqa & Irbid</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
                Find Specialists & Book Clinic Appointments Effortlessly
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-7 max-w-2xl">
                Explore verified clinics, compare doctors by specialty and working hours, and reserve your visit time slot in just a few clicks.
            </p>

            <form method="GET" action="{{ route('doctors.index') }}" class="bg-white dark:bg-slate-900 p-2 rounded-2xl shadow-2xl flex flex-col sm:flex-row gap-2 max-w-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex-1 flex items-center gap-2.5 px-3">
                    <i class="fas fa-magnifying-glass text-slate-400"></i>
                    <input name="q" type="text" placeholder="Search doctor name, clinic, or specialty..."
                           class="w-full py-2 text-sm bg-transparent text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none" />
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold smooth-transition flex items-center justify-center gap-2">
                    <span>Search Doctors</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-white/10 max-w-lg">
                <div>
                    <div class="text-2xl font-extrabold text-white">{{ $clinicCount }}</div>
                    <div class="text-xs text-slate-300">Partner Clinics</div>
                </div>
                <div>
                    <div class="text-2xl font-extrabold text-teal-300">{{ $doctorCount }}</div>
                    <div class="text-xs text-slate-300">Verified Doctors</div>
                </div>
                <div>
                    <div class="text-2xl font-extrabold text-sky-300">{{ $specialties->count() }}</div>
                    <div class="text-xs text-slate-300">Medical Specialties</div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-12">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Browse by Specialty</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Select a specialty to filter available doctors</p>
            </div>
            <a href="{{ route('doctors.index') }}" class="text-sm font-semibold text-sky-600 dark:text-sky-400 hover:underline flex items-center gap-1">
                <span>View All</span>
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($specialties as $spec)
                <a href="{{ route('doctors.index', ['specialty' => $spec->name]) }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-sky-500 dark:hover:border-sky-400 rounded-2xl p-4 text-center shadow-sm hover:shadow-md smooth-transition group">
                    <div class="w-12 h-12 mx-auto rounded-2xl {{ $spec->color }} flex items-center justify-center text-xl mb-3 group-hover:scale-110 smooth-transition">
                        <i class="fas {{ $spec->icon }}"></i>
                    </div>
                    <div class="font-bold text-sm text-slate-800 dark:text-slate-100">{{ $spec->name }}</div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mt-12">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">Featured Doctors</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Check schedules and book directly with specialists</p>
            </div>
            <a href="{{ route('clinics.index') }}" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 text-xs sm:text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 smooth-transition">
                Explore Clinics
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($featuredDoctors as $doctor)
                @include('partials.doctor-card')
            @endforeach
        </div>
    </section>
@endsection
