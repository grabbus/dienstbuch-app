<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'MGrabinger',
            'email' => 'michael.grabinger@feuerwehr-ezelsdorf.de',
            'password' => Hash::make('APv%:t3nP8}-Fk7NcrWR'),
        ]);
    }
}
