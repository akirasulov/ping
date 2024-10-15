<?php

declare (strict_types = 1);

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Akmal Rasulov',
            'email' => 'akirasulov2323@gmail.com',
        ]);

        $service = Service::factory()->for($user)->create(
            [
                'name' => 'Akmal Rasulov',
                'url' => 'https:://akirasulov.com',
            ]
        );

        Check::factory()->for($service)->count(10)->create();
    }
}
