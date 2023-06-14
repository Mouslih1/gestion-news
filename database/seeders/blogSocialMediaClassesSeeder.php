<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class blogSocialMediaClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_social_media')->insert([
            'bsm_facebook' => 'facebok',
            'bsm_instagram' => 'instagram',
            'bsm_youtube' => 'youtube',
            'bsm_linkedin' => 'linkdedin',
        ]);
    }
}
