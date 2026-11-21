@extends('layouts.app')

@section('title', 'Doctors')

@section('content')
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Doctors Directory</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Filter doctors by specialty, city, or keyword and inspect their weekly schedules
                </p>
            </div>
            @if ($hasFilters)
                <a href="{{ route('doctors.index') }}" class="self-start md:self-auto px-3.5 py-2 rounded-xl bg-slate-200 dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-300 dark:hover:bg-slate-700 smooth-transition">
                    <i class="fas fa-rotate-left mr-1"></i>Reset Filters
                </a>
            @endif
        </div>

        <form method="GET" action="{{ route('doctors.index') }}" class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @if (! empty($filters['clinic']))
                <input type="hidden" name="clinic" value="{{ $filters['clinic'] }}" />
            @endif
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5">Search Keyword</label>
                <input name="q" type="text" value="{{ $filters['q'] ?? '' }}" placeholder="Doctor, clinic, or specialty..."
                       class="w-full px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:outline-none focus:border-sky-500" />
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5">Specialty</label>
                <select name="specialty" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:outline-none focus:border-sky-500">
                    <option value="">All Specialties</option>
                    @foreach ($specialties as $s)
                        <option value="{{ $s->name }}" @selected(($filters['specialty'] ?? '') === $s->name)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5">City</label>
                <select name="city" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:outline-none focus:border-sky-500">
                    <option value="">All Cities</option>
                    @foreach ($cities as $c)
                        <option value="{{ $c }}" @selected(($filters['city'] ?? '') === $c)>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold smooth-transition">
                <i class="fas fa-filter mr-1"></i>Apply
            </button>
        </form>
    </div>

    @if ($doctors->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($doctors as $doctor)
                @include('partials.doctor-card')
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-12 text-center">
            <i class="fas fa-user-md text-4xl text-slate-300 dark:text-slate-600 mb-3"></i>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">No Matching Doctors Found</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Try clearing your search or choosing a different specialty or city.</p>
        </div>
    @endif
@endsection
