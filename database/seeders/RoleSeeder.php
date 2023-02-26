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
        Role::create([
            'title' => 'Admin'
        ]);

        Role::create([
            'title' => 'Workman'
        ]);

        Role::create([
            'title' => 'Chief'
        ]);

        Role::create([
            'title' => 'Director'
        ]);

        Role::create([
            'title' => 'Accountant'
        ]);
    }
}
