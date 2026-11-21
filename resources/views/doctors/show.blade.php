@extends('layouts.app')

@section('title', $doctor->name)

@section('content')
    <a href="{{ route('doctors.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-sky-600 dark:hover:text-sky-400 smooth-transition">
        <i class="fas fa-arrow-left"></i>
        <span>Back to Doctors Directory</span>
    </a>

    @php($input = 'w-full px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:outline-none focus:border-sky-500')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                    <img src="{{ $doctor->avatar }}" alt="{{ $doctor->name }}" class="w-24 h-24 rounded-2xl object-cover border border-slate-200 dark:border-slate-700" onerror="this.style.display='none'" />
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="px-3 py-1 rounded-full bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-300 text-xs font-bold">{{ $doctor->specialty->name }}</span>
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-semibold">{{ $doctor->experience_years }} Years Experience</span>
                        </div>
                        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $doctor->name }}</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                            <i class="fas fa-hospital text-sky-600 dark:text-sky-400 mr-1"></i>
                            {{ $doctor->clinic->name }} ({{ $doctor->clinic->city }} • {{ $doctor->clinic->address }})
                        </p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mt-5 pt-5 border-t border-slate-100 dark:border-slate-800">{{ $doctor->bio }}</p>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-week text-teal-600 dark:text-teal-400"></i>
                    <span>Weekly Working Hours & Available Slots</span>
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-slate-800 text-xs uppercase text-slate-400">
                                <th class="py-2.5 pr-4">Day</th>
                                <th class="py-2.5 pr-4">Working Hours</th>
                                <th class="py-2.5">Available Time Slots</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach ($doctor->schedules as $row)
                                <tr>
                                    <td class="py-3 pr-4 font-bold text-slate-800 dark:text-slate-200">{{ $row->day }}</td>
                                    <td class="py-3 pr-4 text-slate-600 dark:text-slate-300 whitespace-nowrap">{{ $row->hours }}</td>
                                    <td class="py-3">
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($row->slots as $slot)
                                                <span class="px-2.5 py-1 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 text-xs font-semibold border border-teal-200/70 dark:border-teal-800/70">{{ $slot }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-md sticky top-24">
                <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Book Appointment</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Consultation Fee: <strong class="text-sky-600 dark:text-sky-400">{{ $doctor->fee }} JOD</strong></p>
                    </div>
                    <i class="fas fa-notes-medical text-2xl text-sky-600 dark:text-sky-400"></i>
                </div>

                <form method="POST" action="{{ route('appointments.store', $doctor) }}" class="space-y-4" novalidate>
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Patient Full Name <span class="text-rose-500">*</span></label>
                        <input name="patient_name" type="text" value="{{ old('patient_name') }}" placeholder="e.g., Dima Salameh" class="{{ $input }}" />
                        @error('patient_name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Phone Number <span class="text-rose-500">*</span></label>
                        <input name="phone" type="tel" value="{{ old('phone') }}" placeholder="e.g., 0791234567" class="{{ $input }}" />
                        @error('phone') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Preferred Date <span class="text-rose-500">*</span></label>
                        <input name="date" type="date" min="{{ now()->toDateString() }}" value="{{ old('date', now()->addDay()->toDateString()) }}" class="{{ $input }}" />
                        @error('date') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Day & Time Slot <span class="text-rose-500">*</span></label>
                        <select name="slot" class="{{ $input }}">
                            @foreach ($doctor->schedules as $row)
                                @foreach ($row->slots as $slot)
                                    <option value="{{ $row->day }}|{{ $slot }}" @selected(old('slot') === "{$row->day}|{$slot}")>{{ $row->day }} — {{ $slot }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('slot') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Visit Notes (Optional)</label>
                        <textarea name="notes" rows="2" placeholder="Symptoms or reason for visit..." class="{{ $input }}">{{ old('notes') }}</textarea>
                        @error('notes') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm shadow-md shadow-teal-600/20 smooth-transition flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>Confirm Appointment</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
