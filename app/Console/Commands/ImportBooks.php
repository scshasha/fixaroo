<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Book;
use App\Helpers\BookImporter;

class ImportBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import books from stored csv files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filesInPath = resource_path('csv-import-queue/*.csv');

        // 4 = amount files to process at a time..
        foreach (array_slice(glob($filesInPath), 0, 4) as $file) {
            $data = array_map('str_getcsv', file($file));

            foreach ($data as $row) {
                $record = BookImporter::processFileDataRow($row);
                if ($record->valid) {
                    (new Book())->create($record->data);
                  // Book::firstOrCreate(
                  //   [
                  //     'publication_year'=>$record->data['publication_year'],
                  //     'language_code'=>$record->data['language_code'],
                  //     'thumbnail'=>$record->data['thumbnail'],
                  //     'title'=>$record->data['title'],
                  //     'average_rating'=>$record->data['average_rating'],
                  //     'original_title'=>$record->data['original_title'],
                  //     'isbn'=>$record->data['isbn'],
                  //     'image'=>$record->data['image'],
                  //     'total_ratings'=>$record->data['total_ratings'],
                  //   ], $record->data);
                }

                unlink($file);
            }
        }
    }
}
