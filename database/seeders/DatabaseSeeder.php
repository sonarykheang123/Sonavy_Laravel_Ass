<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 authors
        Author::factory()
            ->count(5)
            ->create()
            ->each(function ($author) {
                // For each author, create 3 books
                Book::factory()
                    ->count(3)
                    ->create([
                        'author_id' => $author->id
                    ]);
            });
    }
}
