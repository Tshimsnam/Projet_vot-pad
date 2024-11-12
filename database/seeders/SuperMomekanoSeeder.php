<?php

namespace Database\Seeders;

use Database\Factories\SuperMomekanoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperMomekanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuperMomekanoFactory::new()->create();
    }
}
