<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Space::insert([
            ['name' => 'Clickise', 'slug' => 'clickise'],
            ['name' => 'Telescope', 'slug' => 'telescope'],
        ]);
    }
}
