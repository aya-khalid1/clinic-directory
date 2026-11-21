<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = collect([
            ['Dentistry', 'fa-tooth', 'text-sky-600 bg-sky-100 dark:bg-sky-900/40 dark:text-sky-300'],
            ['Pediatrics', 'fa-baby', 'text-teal-600 bg-teal-100 dark:bg-teal-900/40 dark:text-teal-300'],
            ['Ophthalmology', 'fa-eye', 'text-indigo-600 bg-indigo-100 dark:bg-indigo-900/40 dark:text-indigo-300'],
            ['Cardiology', 'fa-heart-circle-check', 'text-rose-600 bg-rose-100 dark:bg-rose-900/40 dark:text-rose-300'],
            ['Dermatology', 'fa-spa', 'text-amber-600 bg-amber-100 dark:bg-amber-900/40 dark:text-amber-300'],
            ['Orthopedics', 'fa-bone', 'text-purple-600 bg-purple-100 dark:bg-purple-900/40 dark:text-purple-300'],
        ])->mapWithKeys(fn ($s) => [$s[0] => Specialty::create(['name' => $s[0], 'icon' => $s[1], 'color' => $s[2]])]);

        $u = 'https://images.unsplash.com/photo-';
        $clinics = [
            1 => ['Royal Dental Care', 'Amman', 'Shmeisani, Al-Shareef Abdul Hamid Sharaf St.', '06-560-1122', 'Sun – Thu: 09:00 AM – 06:00 PM', 4.9, '1629909613654-28e377c37b09', 'Modern dental & aesthetic clinic offering implants, orthodontics, and painless preventive care.'],
            2 => ['Al-Yasmin Pediatric Center', 'Irbid', 'University Street, Near Al-Huson Junction', '02-724-6543', 'Sat – Wed: 09:30 AM – 04:30 PM', 4.8, '1519494026892-80bbd2d6fd0d', 'Child-friendly medical center dedicated to infant care, vaccinations, and pediatric growth monitoring.'],
            3 => ['Noor Al-Hayat Medical Center', 'Zarqa', 'Al-Saadah Street, Downtown', '05-365-4321', 'Sun – Thu: 08:30 AM – 05:00 PM', 4.7, '1586773860418-d37222d8fce3', 'Comprehensive outpatient clinic specializing in internal medicine, cardiology, and chronic care.'],
            4 => ['Vision Eye & Laser Center', 'Amman', '5th Circle, Zahran Street', '06-592-9012', 'Sun, Tue, Thu: 12:00 PM – 08:00 PM', 4.9, '1579684385127-1ef15d508118', 'Advanced ophthalmology center equipped with diagnostic imaging and vision correction suites.'],
            5 => ['DermaGlow Skin Clinic', 'Amman', 'Abdoun, Sulaiman Al-Nabulsi St.', '06-593-1753', 'Sat, Mon, Wed: 11:00 AM – 06:30 PM', 4.8, '1612349317150-e413f6a5b16d', 'Specialized clinical dermatology and medical laser treatments with personalized care plans.'],
            6 => ['Al-Qimma Bone & Joint Clinic', 'Irbid', 'Al-Qubbah Circle, Wasfi Al-Tal St.', '02-727-1852', 'Sun, Tue, Thu: 10:00 AM – 05:00 PM', 4.7, '1516549655169-df83a0774514', 'Orthopedic care for joint pain, sports injuries, spine consultations, and rehabilitation guidance.'],
        ];
        foreach ($clinics as $id => $c) {
            Clinic::create(['id' => $id, 'name' => $c[0], 'city' => $c[1], 'address' => $c[2], 'phone' => $c[3], 'hours' => $c[4], 'rating' => $c[5], 'image' => "{$u}{$c[6]}?auto=format&fit=crop&w=800&q=80", 'description' => $c[7]]);
        }

        // [name, specialty, clinic_id, years, fee, available, avatar, bio, schedule[[day, hours, slots]]]
        $doctors = [
            ['Dr. Ahmad Al-Kilani', 'Dentistry', 1, 9, 25, true, '1612349317150-e413f6a5b16d', 'Specialist in dental implants, oral surgery, and aesthetic smile design with over 9 years of clinical practice.', [
                ['Sunday', '09:00 AM – 03:00 PM', ['09:30 AM', '10:30 AM', '12:00 PM', '02:00 PM']],
                ['Monday', '09:00 AM – 03:00 PM', ['09:00 AM', '11:00 AM', '01:00 PM']],
                ['Tuesday', '09:00 AM – 03:00 PM', ['10:00 AM', '11:30 AM', '02:30 PM']],
                ['Wednesday', '09:00 AM – 03:00 PM', ['09:30 AM', '01:30 PM']],
                ['Thursday', '09:00 AM – 02:00 PM', ['10:00 AM', '12:30 PM']],
            ]],
            ['Dr. Reem Al-Abdullah', 'Pediatrics', 2, 12, 20, true, '1559839734-2b71ea197ec2', 'Senior pediatric consultant focusing on newborn care, childhood immunizations, nutrition, and seasonal illnesses.', [
                ['Saturday', '10:00 AM – 04:00 PM', ['10:00 AM', '11:30 AM', '02:00 PM']],
                ['Sunday', '10:00 AM – 04:00 PM', ['10:30 AM', '01:00 PM', '03:00 PM']],
                ['Monday', '10:00 AM – 04:00 PM', ['11:00 AM', '02:30 PM']],
                ['Tuesday', '10:00 AM – 04:00 PM', ['10:00 AM', '01:30 PM']],
                ['Wednesday', '10:00 AM – 03:30 PM', ['11:00 AM', '02:00 PM']],
            ]],
            ['Dr. Sarah Al-Khatib', 'Cardiology', 3, 8, 25, true, '1594824476967-48c8b964ac31', 'Internal medicine and cardiology specialist managing hypertension, heart checkups, diabetes, and preventive screenings.', [
                ['Sunday', '08:30 AM – 02:30 PM', ['09:00 AM', '10:30 AM', '12:30 PM']],
                ['Monday', '08:30 AM – 02:30 PM', ['09:30 AM', '11:30 AM', '01:30 PM']],
                ['Wednesday', '08:30 AM – 02:30 PM', ['09:00 AM', '11:00 AM']],
                ['Thursday', '08:30 AM – 02:00 PM', ['10:00 AM', '12:00 PM']],
            ]],
            ['Dr. Tariq Al-Masri', 'Ophthalmology', 4, 15, 30, false, '1537368910025-700350fe46c7', 'Consultant eye surgeon experienced in refractive laser procedures, cataract evaluation, and retinal care.', [
                ['Sunday', '01:00 PM – 07:30 PM', ['01:30 PM', '03:30 PM', '05:30 PM']],
                ['Tuesday', '01:00 PM – 07:30 PM', ['02:00 PM', '04:00 PM', '06:00 PM']],
                ['Thursday', '01:00 PM – 06:30 PM', ['01:30 PM', '03:00 PM']],
            ]],
            ['Dr. Layla Al-Mansour', 'Dermatology', 5, 10, 25, true, '1651008376811-b90baee60c1f', 'Dermatologist specializing in acne therapy, eczema, pigmentation treatments, and clinical skin rejuvenation.', [
                ['Saturday', '11:00 AM – 06:00 PM', ['11:30 AM', '01:30 PM', '04:00 PM']],
                ['Monday', '11:00 AM – 06:00 PM', ['12:00 PM', '02:30 PM', '04:30 PM']],
                ['Wednesday', '11:00 AM – 06:00 PM', ['11:00 AM', '02:00 PM']],
            ]],
            ['Dr. Omar Al-Zoubi', 'Orthopedics', 6, 14, 25, true, '1622253692010-333f2da6031d', 'Orthopedic specialist treating joint disorders, knee & shoulder issues, back pain, and sports injuries.', [
                ['Sunday', '10:00 AM – 04:30 PM', ['10:30 AM', '12:30 PM', '02:30 PM']],
                ['Tuesday', '10:00 AM – 04:30 PM', ['11:00 AM', '01:00 PM', '03:00 PM']],
                ['Thursday', '10:00 AM – 03:30 PM', ['10:00 AM', '01:30 PM']],
            ]],
        ];
        foreach ($doctors as $d) {
            $doctor = Doctor::create([
                'name' => $d[0], 'specialty_id' => $specialties[$d[1]]->id, 'clinic_id' => $d[2],
                'experience_years' => $d[3], 'fee' => $d[4], 'available' => $d[5],
                'avatar' => "{$u}{$d[6]}?auto=format&fit=crop&w=400&q=80", 'bio' => $d[7],
            ]);
            foreach ($d[8] as [$day, $hours, $slots]) {
                $doctor->schedules()->create(['day' => $day, 'hours' => $hours, 'slots' => $slots]);
            }
        }
    }
}
