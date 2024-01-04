<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perm = [
            ['name' => 'show-comment', 'label' => ' نمایش نظرات'],
            ['name' => 'create-article', 'label' => 'ساخت مقاله'],
        ];

        // Insert roles into the roles table
        DB::table('permissions')->insert($perm);
    }
}
