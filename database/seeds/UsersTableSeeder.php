<?php

use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
	/**
	 * @var int
	 */
	private const ROLE_ADMIN = 1;
	
	/**
	 * @var int
	 */
	private const ROLE_AGENT = 2;
	
	/**
	 * @var int
	 */
	private const ROLE_SUPERADMIN = 3;
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$faker = FakerFactory::create();
		
		User::truncate();
		
		echo "=== User Creation ===\n\n";
		
		// Create mandatory users
		$this->createUser('Admin', self::ROLE_ADMIN, $faker, true, 'admin@example.com');
		$this->createUser('Agent', self::ROLE_AGENT, $faker, true, 'agent@example.com');
		
		// Optional additional users
		$additionalCount = (int) readline('How many additional users would you like to create? (Enter 0 for none): ') ?: 0;
		
		for ($i = 1; $i <= $additionalCount; $i++) {
			echo "\nCreating Additional User #$i\n";
			$this->createUser('Additional User', null, $faker, false);
		}
		
		echo "\nUser seeding complete!\n";
	}
	
	/**
	 * Creates and saves a new user record.
	 *
	 * @param string $roleName
	 * @param int|null $fixedRoleValue
	 * @param \Faker\Generator $faker
	 * @param bool $isMandatory
	 * @param string|null $defaultEmail
	 * @return void
	 */
	private function createUser(
		string $roleName,
		?int $fixedRoleValue,
		\Faker\Generator $faker,
		bool $isMandatory = false,
		?string $defaultEmail = null
	): void {
		$defaultPassword = $faker->password;
		
		// Determine role if not fixed
		if ($fixedRoleValue === null) {
			$roleName = ucfirst(strtolower($this->readInput('Enter role for user (admin, agent, superadmin)', 'agent')));
			$roleValue = $this->mapRoleToAdminValue($roleName);
		} else {
			$roleValue = $fixedRoleValue;
		}
		
		echo "Creating {$roleName} User\n";
		
		$name = $this->readInput("Enter {$roleName} Name", $faker->firstName);
		$email = $this->readInput("Enter {$roleName} Email", $defaultEmail ?? $faker->unique()->safeEmail);
		$password = $this->readInput("Enter {$roleName} Password", $defaultPassword);
		
		$email = $this->ensureUniqueEmail($email, $roleValue, $faker, "{$roleName} Email");
		
		User::firstOrCreate(
			['email' => $email],
			[
				'name' => $name,
				'password' => Hash::make($password),
				'is_admin' => $roleValue,
			]
		);
		
		echo "User {$name} has been successfully created!\n\n";
	}
	
	/**
	 * Prompts the user for feedback and captures the input.
	 *
	 * @param string $prompt
	 * @param string $default
	 * @return string
	 */
	private function readInput(string $prompt, string $default): string
	{
		$input = readline("{$prompt} (default: {$default}): ");
		return $input !== '' ? $input : $default;
	}
	
	/**
	 * Verifies that the account email is unique by ensuring it does not already exist.
	 *
	 * @param string $email
	 * @param int $roleValue
	 * @param \Faker\Generator $faker
	 * @param string $label
	 * @return string
	 */
	private function ensureUniqueEmail(string $email, int $roleValue, \Faker\Generator $faker, string $label): string
	{
		$existingUser = User::where('email', $email)->first();
		
		if ($existingUser && $existingUser->is_admin !== $roleValue) {
			echo "Email {$email} is already in use by a user with a different role.\n";
			$suggestedEmail = $faker->unique()->safeEmail;
			echo "Suggested alternative: {$suggestedEmail}\n";
			$email = $this->readInput("Enter a different {$label}", $suggestedEmail);
		}
		
		return $email;
	}
	
	/**
	 * Maps account roles to predefined role identifiers.
	 *
	 * @param string $role
	 * @return int
	 */
	private function mapRoleToAdminValue(string $role): int
	{
		switch (strtolower($role)) {
			case 'admin':
				return self::ROLE_ADMIN;
			case 'superadmin':
				return self::ROLE_SUPERADMIN;
			case 'agent':
			default:
				return self::ROLE_AGENT;
		}
	}
}