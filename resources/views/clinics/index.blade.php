@extends('layouts.app')

@section('title', 'Clinics')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Medical Clinics</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Showing {{ $clinics->count() }} accredited clinics across Jordan
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @foreach (['' => 'All Cities'] + array_combine($cities, $cities) as $value => $label)
                <a href="{{ route('clinics.index', $value ? ['city' => $value] : []) }}"
                   class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold smooth-transition {{ (string) $city === (string) $value ? 'bg-sky-600 text-white shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 hover:border-sky-400' }}">{{ $label }}</a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($clinics as $clinic)
            <article class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-md smooth-transition flex flex-col">
                <div class="relative h-44 bg-slate-200 dark:bg-slate-800">
                    <img src="{{ $clinic->image }}" alt="{{ $clinic->name }}" class="w-full h-full object-cover" onerror="this.style.display='none'" />
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg bg-slate-900/80 text-white text-xs font-bold backdrop-blur-sm">
                        <i class="fas fa-location-dot text-sky-400 mr-1"></i>{{ $clinic->city }}
                    </span>
                    <span class="absolute top-3 right-3 px-2.5 py-1 rounded-lg bg-amber-400 text-slate-950 text-xs font-extrabold">
                        <i class="fas fa-star mr-1"></i>{{ $clinic->rating }}
                    </span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">{{ $clinic->name }}</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 leading-relaxed">{{ $clinic->description }}</p>
                        <div class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                            <div class="flex items-center gap-2"><i class="fas fa-map-pin text-sky-600 dark:text-sky-400 w-4"></i><span>{{ $clinic->address }}</span></div>
                            <div class="flex items-center gap-2"><i class="fas fa-phone text-teal-600 dark:text-teal-400 w-4"></i><span>{{ $clinic->phone }}</span></div>
                            <div class="flex items-center gap-2"><i class="fas fa-clock text-amber-600 dark:text-amber-400 w-4"></i><span>{{ $clinic->hours }}</span></div>
                        </div>
                    </div>
                    <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                            {{ $clinic->doctors_count }} {{ Str::plural('Doctor', $clinic->doctors_count) }}
                        </span>
                        <a href="{{ route('doctors.index', ['clinic' => $clinic->id]) }}" class="px-3.5 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold smooth-transition">
                            View Doctors & Hours
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
