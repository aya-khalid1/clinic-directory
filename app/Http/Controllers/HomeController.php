<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Specialty;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'specialties' => Specialty::all(),
            'featuredDoctors' => Doctor::with(['clinic', 'specialty', 'schedules'])->take(3)->get(),
            'clinicCount' => Clinic::count(),
            'doctorCount' => Doctor::count(),
        ]);
    }
}
