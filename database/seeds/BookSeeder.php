<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Http;
use App\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @// TODO: Break func body into sub methods...
     */
    public function run($file = null)
    {

        if (!$file) {
            $file = env('BOOKS_CSV_API');
        }

        // Make the file smaller...
        \App\Helpers\BookImporter::prepareFileForImport($file, true);
        // Process the file...
        \App\Helpers\BookImporter::importFile();






























        // (new Book())->import();
    }
}
