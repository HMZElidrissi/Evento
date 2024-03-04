<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            EventSeeder::class,
            ReservationSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Amine Ismaili',
            'email' => 'amine@amine.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'Rania Bouabid',
            'email' => 'rania@rania.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
