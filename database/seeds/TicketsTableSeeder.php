<?php

namespace Database\Seeders;

use App\Models\Ticket;  // Correct the import for Ticket model
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		// Create 100 tickets using the factory
		Ticket::factory()->count(100)->create();
	}
}