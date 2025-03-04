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
		
		// Check if admin email exists and if the role differs.
		$existingAdmin = User::where('email', $adminEmail)->first();
		if ($existingAdmin && $existingAdmin->is_admin != 1) {
			echo "Email $adminEmail is already in use by a user with a different role. Suggested alternative: " . $faker->email . "\n";
			$adminEmail = readline('Enter a different Admin Email: ') ?: $faker->email;
		}
		
		User::firstOrCreate(
			['email' => $adminEmail],
			[
				'name' => $adminName,
				'password' => Hash::make($adminPassword),
				'is_admin' => 1, // Admin role
			]
		);
		
		echo "\nAdmin user created or already exists!\n\n";
		
		// Ensure at least 1 agent (second user).
		echo "Creating Support Desk Agent User (Mandatory)\n";
		$agent_default_pswd = $faker->password;
		$agentName = readline('Enter Agent Name (default: ' . $faker->firstName . '): ') ?: env('SAMPLE_USER_NAME', $faker->firstName);
		$agentEmail = readline('Enter Agent Email (default: ' . env('SAMPLE_USER_EMAIL', 'agent@example.com') . '): ') ?: env('SAMPLE_USER_EMAIL', 'agent@example.com');
		$agentPassword = readline('Enter Agent Password (default: ' . env('SAMPLE_USER_PASSWORD', $agent_default_pswd) . '): ') ?: env('SAMPLE_USER_PASSWORD', $agent_default_pswd);
		
		// Check if agent email exists and if the role differs.
		$existingAgent = User::where('email', $agentEmail)->first();
		if ($existingAgent && $existingAgent->is_admin != 2) {
			echo "Email $agentEmail is already in use by a user with a different role. Suggested alternative: " . $faker->email . "\n";
			$agentEmail = readline('Enter a different Agent Email: ') ?: $faker->email;
		}
		
		User::firstOrCreate(
			['email' => $agentEmail],
			[
				'name' => $agentName,
				'password' => Hash::make($agentPassword),
				'is_admin' => 2, // Agent role
			]
		);
		
		echo "\nAgent user created or already exists!\n\n";
		
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
			
			// Check if the user with the email exists and if the role differs.
			$existingUser = User::where('email', $email)->first();
			if ($existingUser && $existingUser->is_admin != $isAdmin) {
				echo "Email $email is already in use by a user with a different role. Suggested alternative: " . $faker->email . "\n";
				$email = readline('Enter a different email: ') ?: $faker->email;
			}
			
			User::firstOrCreate(
				['email' => $email],
				[
					'name' => $name,
					'password' => Hash::make($password),
					'is_admin' => $isAdmin,
				]
			);
			
			echo "User #$i created or already exists!\n";
		}
		
		echo "\nUser seeding complete!\n";
	}
}