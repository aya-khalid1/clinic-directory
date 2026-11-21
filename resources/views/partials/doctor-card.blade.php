<article class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md smooth-transition flex flex-col justify-between">
    <div>
        <div class="flex items-start justify-between gap-3 mb-4">
            <div class="flex items-center gap-3.5">
                <img src="{{ $doctor->avatar }}" alt="{{ $doctor->name }}" class="w-14 h-14 rounded-2xl object-cover border border-slate-200 dark:border-slate-700" onerror="this.style.display='none'" />
                <div>
                    <h3 class="font-bold text-base text-slate-900 dark:text-white leading-snug">{{ $doctor->name }}</h3>
                    <span class="inline-block mt-1 px-2.5 py-0.5 rounded-md bg-sky-50 dark:bg-sky-950 text-sky-700 dark:text-sky-300 text-xs font-bold">
                        {{ $doctor->specialty->name }}
                    </span>
                </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $doctor->available ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300' }}">
                {{ $doctor->available ? 'Available' : 'Limited Slots' }}
            </span>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed mb-4">{{ $doctor->bio }}</p>

        <div class="space-y-1.5 text-xs text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-800/60 p-3 rounded-xl border border-slate-100 dark:border-slate-800">
            <div class="flex items-center justify-between">
                <span class="text-slate-400">Clinic:</span>
                <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $doctor->clinic->name }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-slate-400">City:</span>
                <span class="font-semibold">{{ $doctor->clinic->city }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-slate-400">Working Days:</span>
                <span class="font-semibold text-teal-700 dark:text-teal-300">{{ $doctor->schedules->count() }} Days / Week</span>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-2">
        <div>
            <span class="text-[11px] text-slate-400 block">Consultation</span>
            <span class="text-sm font-extrabold text-slate-900 dark:text-white">{{ $doctor->fee }} JOD</span>
        </div>
        <a href="{{ route('doctors.show', $doctor) }}" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold smooth-transition flex items-center gap-1.5">
            <span>Schedule & Book</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</article>
