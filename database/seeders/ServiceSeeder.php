<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Haircut',
                'description' => 'Basic haircut service',
                'duration_minutes' => 30,
                'price' => 25.00,
            ],
            [
                'name' => 'Consultation',
                'description' => 'Initial consultation',
                'duration_minutes' => 60,
                'price' => 50.00,
            ],
            [
                'name' => 'Repair Service',
                'description' => 'Basic repair service',
                'duration_minutes' => 45,
                'price' => 75.00,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}