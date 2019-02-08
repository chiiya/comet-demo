<?php

use Illuminate\Database\Seeder;

class CountryLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create countries
        $germany = \App\Models\Country::create([
            'code' => 'DE',
            'name' => 'Germany',
        ]);
        $us = \App\Models\Country::create([
            'code' => 'US',
            'name' => 'United States of America',
        ]);
        $france = \App\Models\Country::create([
            'code' => 'FR',
            'name' => 'France',
        ]);
        $switzerland = \App\Models\Country::create([
            'code' => 'CH',
            'name' => 'Switzerland',
        ]);

        // Create languages
        $de = \App\Models\Language::create([
            'code' => 'de',
            'name' => 'German'
        ]);
        $en = \App\Models\Language::create([
            'code' => 'en',
            'name' => 'English'
        ]);
        $fr = \App\Models\Language::create([
            'code' => 'fr',
            'name' => 'French'
        ]);

        // Sync relations
        $germany->languages()->attach($de->id);
        $us->languages()->attach($en->id);
        $france->languages()->attach($fr->id);
        $switzerland->languages()->attach($de->id);
        $switzerland->languages()->attach($fr->id);
    }
}
