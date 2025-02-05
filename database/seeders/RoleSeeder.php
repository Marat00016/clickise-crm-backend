<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'Администратор', 'slug' => 'admin'],
            ['name' => 'Менеджер продаж', 'slug' => 'sales_manager'],
            ['name' => 'Аккаунт менеджер', 'slug' => 'account_manager'],
            ['name' => 'Руководитель менеджеров', 'slug' => 'top_manager'],
            ['name' => 'Поддержка', 'slug' => 'support'],
        ]);
    }
}
