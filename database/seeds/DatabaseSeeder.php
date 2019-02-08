<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(CountryLanguageSeeder::class);
         $this->call(AuthorSeeder::class);
         $this->call(BooksSeeder::class);
    }
}
