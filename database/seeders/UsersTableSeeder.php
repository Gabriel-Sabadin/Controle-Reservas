<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'Gabriel Sabadin',
                'email' => 'gabilucassabadin@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => Carbon::now()
            ]
            );
    }
}