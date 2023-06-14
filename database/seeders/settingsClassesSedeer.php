<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class settingsClassesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'blog_name' => 'blog name',
            'blog_email' => 'blogemail@gmail.com',
            'blog_description' => 'blog description',
            'blog_logo' => 'logo.png',
            'blog_favicon' => 'favicon.icon',
        ]);
    }
}
