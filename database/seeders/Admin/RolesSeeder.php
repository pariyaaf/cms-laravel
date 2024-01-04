<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Define roles data
        $roles = [
            ['name' => 'Admin', 'label' => 'ادمین اصلی'],
            ['name' => 'Manager', 'label' => 'مدیر سایت'],
        ];

        // Insert roles into the roles table
        DB::table('roles')->insert($roles);
      
    }
}
