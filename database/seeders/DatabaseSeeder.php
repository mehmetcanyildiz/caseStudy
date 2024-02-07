<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

/**
 * Database Seeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Developer::factory(5)->create();
    }
}
