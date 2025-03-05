<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	protected $model = User::class;
	
	public function definition()
	{
		// Set default role to 'agent'
		return [
			'name' => $this->faker->name,
			'email' => $this->faker->unique()->safeEmail,
			'password' => Hash::make('password'), // default password
			'remember_token' => Str::random(10),
			'is_admin' => 2, // Default role 'agent'
		];
	}
	
	public function admin()
	{
		return $this->state([
			'is_admin' => 1, // admin role
		]);
	}
	
	public function superadmin()
	{
		return $this->state([
			'is_admin' => 3, // superadmin role
		]);
	}
}
