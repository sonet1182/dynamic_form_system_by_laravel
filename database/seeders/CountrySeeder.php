<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name' => 'United States'],
            ['name' => 'Canada'],
            ['name' => 'United Kingdom'],
            ['name' => 'Australia'],
            ['name' => 'Germany'],
            ['name' => 'France'],
            ['name' => 'Japan'],
            ['name' => 'India'],
            ['name' => 'Brazil'],
            ['name' => 'China'],
            ['name' => 'Bangladesh'],
            ['name' => 'United Arab Emirats'],
            ['name' => 'Pakistan'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
