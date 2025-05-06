<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modelRoles = [
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 1],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 2],
            ['role_id' => 3, 'model_type' => 'App\\Models\\User', 'model_id' => 3],
            ['role_id' => 4, 'model_type' => 'App\\Models\\User', 'model_id' => 4],
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 5],
            ['role_id' => 6, 'model_type' => 'App\\Models\\User', 'model_id' => 6],
            ['role_id' => 7, 'model_type' => 'App\\Models\\User', 'model_id' => 7],
            ['role_id' => 6, 'model_type' => 'App\\Models\\User', 'model_id' => 8],
            ['role_id' => 7, 'model_type' => 'App\\Models\\User', 'model_id' => 9],
        ];

        DB::table('model_has_roles')->insertOrIgnore($modelRoles);
    }
}
