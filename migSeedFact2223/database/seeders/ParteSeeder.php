<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Parte::factory(20)->create();
    }
}
