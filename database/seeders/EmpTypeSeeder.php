<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmpTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=EmpTypeSeeder
     * @return void
     */
    public function run()
    {
        DB::table('employee_type')->insert([
            'name' => 'Super Admin'
        ]);
        DB::table('employee_type')->insert([
            'name' => 'Admin'
        ]);
        DB::table('employee_type')->insert([
            'name' => 'Enterprise'
        ]);
        DB::table('employee_type')->insert([
            'name' => 'Enterprise Admin'
        ]);
        DB::table('employee_type')->insert([
            'name' => 'Enterprise Employee'
        ]);
    }
}
