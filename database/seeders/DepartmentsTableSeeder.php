<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            ['name' => 'Marketing', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Design', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
