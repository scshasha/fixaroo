<?php

use Database\Seeders\TicketsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories
        $this->call(CategoryTableSeeder::class);

        // Users
        $this->call(UsersTableSeeder::class);

        // Tickets
        $this->call(TicketsTableSeeder::class);
    }
}
