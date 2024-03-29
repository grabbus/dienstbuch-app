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
            'name' => 'MLeonhard',
            'email' => 'matthias.leonhard@feuerwehr-ezelsdorf.de',
            'password' => Hash::make('PI%mq&1fR#*,3IuoFA_uf?Z&iXop3w'),
        ]);
        DB::table('users')->insert([
            'name' => 'FMeyer',
            'email' => 'florian.meyer@feuerwehr-ezelsdorf.de',
            'password' => Hash::make(':,^VoPXlzYk7%=DMvdGy&fBn5}>V!2'),
        ]);
    }
}
