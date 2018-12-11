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
        $this->call(AuthorsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
    }
}
