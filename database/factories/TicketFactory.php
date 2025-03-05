<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
	protected $model = Ticket::class;
	
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$priority = ['low', 'medium', 'high'];
		
		return [
			'title' => $this->faker->sentence,
			'message' => $this->faker->paragraph,
			'priority' => $this->faker->randomElement($priority),
			'status' => 'Open',
			'user_id' => User::query()->inRandomOrder()->first()->id,
			'ticket_id' => strtoupper(Str::random(15)),
			'category_id' => Category::query()->inRandomOrder()->first()->id,
			'author_name' => $this->faker->name,
			'author_email' => $this->faker->email,
		];
	}
}