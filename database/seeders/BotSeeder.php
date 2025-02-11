<?php

namespace Database\Seeders;

use App\Models\Bot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bot::insert([
            ['space_id' => 1, 'name' => 'Clickise', 'slug' => 'clickise_bot', 'token' => ''],
        ]);
    }
}
