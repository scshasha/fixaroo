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
        // Truncate table
        User::truncate();

        // Create Admin User
        User::create([
            'name' => $faker->firstName,
            'email' => 'admin@example.com',
            'is_admin' => 1,
            'password' => 'fixaroo',
        ]);

        // Create 5 Agent Users
        for($i=1;$i <= 5;$i++) {
            User::create([
                'name' => $faker->firstName,
                'email' => sprintf('fixaroo%d@example.com', $i),
                'is_admin' => 2,
                'password' => 'fixaroo',
            ]);
        }
    }
}
