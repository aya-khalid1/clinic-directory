<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public const CITIES = ['Amman', 'Zarqa', 'Irbid'];

    public function index(Request $request)
    {
        $city = $request->query('city');

        return view('clinics.index', [
            'clinics' => Clinic::withCount('doctors')
                ->when(in_array($city, self::CITIES), fn ($q) => $q->where('city', $city))
                ->get(),
            'city' => $city,
            'cities' => self::CITIES,
        ]);
    }
}
