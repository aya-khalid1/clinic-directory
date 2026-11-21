<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();
            $t->string('icon');
            $t->string('color');
            $t->timestamps();
        });

        Schema::create('clinics', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('city')->index();
            $t->string('address');
            $t->string('phone');
            $t->string('hours');
            $t->decimal('rating', 2, 1);
            $t->string('image');
            $t->text('description');
            $t->timestamps();
        });

        Schema::create('doctors', function (Blueprint $t) {
            $t->id();
            $t->foreignId('clinic_id')->constrained()->cascadeOnDelete();
            $t->foreignId('specialty_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->unsignedTinyInteger('experience_years');
            $t->unsignedSmallInteger('fee'); // JOD
            $t->boolean('available')->default(true);
            $t->string('avatar');
            $t->text('bio');
            $t->timestamps();
        });

        Schema::create('schedules', function (Blueprint $t) {
            $t->id();
            $t->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $t->string('day');
            $t->string('hours');
            $t->json('slots');
            $t->timestamps();
        });

        Schema::create('appointments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $t->string('patient_name');
            $t->string('phone');
            $t->date('date');
            $t->string('time_slot');
            $t->string('notes')->nullable();
            $t->string('status')->default('Confirmed');
            $t->timestamps();
            $t->unique(['doctor_id', 'date', 'time_slot']); // no double booking
        });
    }

    public function down(): void
    {
        foreach (['appointments', 'schedules', 'doctors', 'clinics', 'specialties'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
