<?php

use Illuminate\Database\Seeder;
use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BooksTableSeeder::class);
    }
}
