<?php

use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(App\Models\Book::class, 5)->create([
            'country_code' => 'DE',
            'language_code' => 'de',
            'author_id' => random_int(1, 5),
        ]);
        factory(App\Models\Book::class, 5)->create([
            'country_code' => 'US',
            'language_code' => 'en',
            'author_id' => random_int(6, 10),
        ]);
        factory(App\Models\Book::class, 5)->create([
            'country_code' => 'FR',
            'language_code' => 'fr',
            'author_id' => random_int(11, 15),
        ]);
        factory(App\Models\Book::class, 5)->create([
            'country_code' => 'CH',
            'language_code' => 'de',
            'author_id' => random_int(16, 20),
        ]);
        factory(App\Models\Book::class, 5)->create([
            'country_code' => 'CH',
            'language_code' => 'fr',
            'author_id' => random_int(11, 20),
        ]);
    }
}
