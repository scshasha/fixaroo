<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
		
		// Clear existing users to start fresh.
		User::truncate();
		
		echo "=== User Creation ===\n\n";
		
		// Ensure at least 1 admin (first user).
		echo "Creating Admin User (Mandatory)\n";
		$admin_default_pswd = $faker->password;
		$adminName = readline('Enter Admin Name (default: ' . $faker->firstName . '): ') ?: env('SAMPLE_USER_NAME', $faker->firstName);
		$adminEmail = readline('Enter Admin Email (default: ' . env('SAMPLE_USER_EMAIL', 'admin@example.com') . '): ') ?: env('SAMPLE_USER_EMAIL', 'admin@example.com');
		$adminPassword = readline('Enter Admin Password (default: ' . env('SAMPLE_USER_PASSWORD', $admin_default_pswd) . '): ') ?: env('SAMPLE_USER_PASSWORD', $admin_default_pswd);
		
		User::create([
			'name' => $adminName,
			'email' => $adminEmail,
			'password' => Hash::make($adminPassword),
			'is_admin' => 1, // Admin role
		]);
		
		echo "\nAdmin user created successfully!\n\n";
		
		// Ensure at least 1 agent (second user).
		echo "Creating Support Desk Agent User (Mandatory)\n";
		$agent_default_pswd = $faker->password;
		$agentName = readline('Enter Agent Name (default: ' . $faker->firstName . '): ') ?: env('SAMPLE_USER_NAME', $faker->firstName);
		$agentEmail = readline('Enter Agent Email (default: ' . env('SAMPLE_USER_EMAIL', 'agent@example.com') . '): ') ?: env('SAMPLE_USER_EMAIL', 'agent@example.com');
		$agentPassword = readline('Enter Agent Password (default: ' . env('SAMPLE_USER_PASSWORD', $agent_default_pswd) . '): ') ?: env('SAMPLE_USER_PASSWORD', $agent_default_pswd);
		
		User::create([
			'name' => $agentName,
			'email' => $agentEmail,
			'password' => Hash::make($agentPassword),
			'is_admin' => 2, // Agent role
		]);
		
		echo "\nAgent user created successfully!\n\n";
		
		// Ask if additional users should be created.
		$additionalCount = (int) readline('How many additional users would you like to create? (Enter 0 for none): ') ?: 0;
		
		for ($i = 1; $i <= $additionalCount; $i++) {
			$default_pswd = $faker->password;
			echo "\nCreating Additional User #$i\n";
			
			$role = readline('Enter role for user (admin, agent, superadmin - default: agent): ') ?: 'agent';
			
			if (!in_array($role, ['admin', 'agent', 'superadmin'])) {
				echo "Invalid role. Defaulting to agent.\n";
				$role = 'agent';
			}
			
			$name = readline('Enter name (default: ' . $faker->firstName . '): ') ?: $faker->firstName;
			$email = readline('Enter email (default: ' . $faker->email . '): ') ?: $faker->email;
			
			$password = readline('Enter password (default: ' . $default_pswd . '): ') ?: $default_pswd;
			
			// Map role to is_admin value using switch instead of match().
			$isAdmin = 2; // Default to agent
			
			switch ($role) {
				case 'admin':
					$isAdmin = 1;
					break;
				case 'superadmin':
					$isAdmin = 3;
					break;
				case 'agent':
				default:
					$isAdmin = 2;
					break;
			}
			
			User::create([
				'name' => $name,
				'email' => $email,
				'password' => Hash::make($password),
				'is_admin' => $isAdmin,
			]);
			
			echo "User #$i created successfully!\n";
		}
		
		echo "\nUser seeding complete!\n";
	}
}