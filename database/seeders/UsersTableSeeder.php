<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'fk_department' => 1, // Marketing
                'fk_designation' => 1, // Marketing Manager
                'phone_number' => '1234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'fk_department' => 2, // Development
                'fk_designation' => 2, // Developer
                'phone_number' => '0987654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jim Brown',
                'fk_department' => 3, // Design
                'fk_designation' => 3, // Designer
                'phone_number' => '1122334455',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
