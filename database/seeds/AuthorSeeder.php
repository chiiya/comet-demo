<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(App\Models\Author::class, 5)->create([
            'country_code' => 'DE',
        ]);
        factory(App\Models\Author::class, 5)->create([
            'country_code' => 'US',
        ]);
        factory(App\Models\Author::class, 5)->create([
            'country_code' => 'FR',
        ]);
        factory(App\Models\Author::class, 5)->create([
            'country_code' => 'CH',
        ]);
    }
}
