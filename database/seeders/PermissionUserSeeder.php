<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $total_permissions = DB::table('permissions')->count();

        for ($i = 1; $i <= $total_permissions; $i++) {
            DB::table('permission_user')->insert([
                'permission_id' => $i,
                'user_id' => 1,
                'user_type' => 'App\Models\User',
            ]);
        }
    }
}
