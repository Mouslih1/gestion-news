<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        DB::table('users')->insert([
            'name' => 'mouslih',
            'email' => 'mouslih@gmail.com',
            'password' => Hash::make('mouslih2001'),
            'username' => 'maro00',
            'type' => 1 ,
            'blocked' => 0 ,
            'direct_publish' => 1 ,
        ]);*/
        DB::table('users')->insert([
            'name' => 'marouane',
            'email' => 'maromouslih@gmail.com',
            'password' => Hash::make('mouslih2001'),
            'username' => 'mouslihmarouane00',
            'type' => 1 ,
            'blocked' => 0 ,
            'direct_publish' => 1 ,
        ]);
    }
}
