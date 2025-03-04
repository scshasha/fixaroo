<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        User::truncate();
        User::create([
          'name' => env('EXAMPLE_ADMIN_NAME', $faker->firstName),
          'email' => env('EXAMPLE_ADMIN_EMAIL', 'admin@example.com'),
          'password' => Hash::make(env('EXAMPLE_ADMIN_PASSWORD', 'Password123')),
          'is_admin' => 1,
        ]);
        User::create([
          'name' => env('EXAMPLE_AGENT1_NAME', $faker->firstName),
          'email' => env('EXAMPLE_AGENT1_EMAIL', 'agent@example.com'),
          'password' => Hash::make(env('EXAMPLE_AGENT1_PASSWORD', 'Password123')),
          'is_admin' => 2,
        ]);
        User::create([
          'name' => env('EXAMPLE_AGENT2_NAME', $faker->firstName),
          'email' => env('EXAMPLE_AGENT2_EMAIL', 'agent2@example.com'),
          'password' => Hash::make(env('EXAMPLE_AGENT2_PASSWORD', 'Password123')),
          'is_admin' => 2,
        ]);
		    User::create([
			    'name' => 'Root',
			    'email' => 'root@example.com',
			    'password' => 'Root123',
			    'is_admin' => 1,
		    ]);
    }
}
