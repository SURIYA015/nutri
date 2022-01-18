<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('blogers')->insert([
            "name" => 'First User',
            "email" => 'admin@test.com',
            "password" => bcrypt('password'),
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
