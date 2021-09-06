<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QtyEmpTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=QtyEmpTypeSeeder
     * @return void
     */
    public function run()
    {
        DB::table('qty_emp_type')->insert([
            'qty' => 5,
            'price' => 0
        ]);
        DB::table('qty_emp_type')->insert([
            'qty' => 15,
            'price' => 200
        ]);
        DB::table('qty_emp_type')->insert([
            'qty' => 30,
            'price' => 350
        ]);
    }
}
