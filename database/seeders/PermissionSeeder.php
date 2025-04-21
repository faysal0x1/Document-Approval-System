<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'dashboard_view', 'display_name' => 'View Dashboard', 'description' => 'Can view dashboard', 'category' => 'Dashboard'],

        ];

        DB::table('permissions')->insert($permissions);
    }
}
