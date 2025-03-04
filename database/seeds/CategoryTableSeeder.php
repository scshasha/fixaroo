<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Category::truncate();
		
		$categories = [
			'Bug',
			'Backlog',
			'Feature Request',
			'Sales Question',
			'How To',
			'Cancellation',
			'Technical Issue',
			'Uncategorized',
			'Account Access Issue',
			'Password Reset',
			'System Outage',
			'Performance Issue',
			'Security Concern',
			'Data Loss/Recovery',
			'Integration Issue',
			'API Issue',
			'Database Issue',
			'Software Installation',
			'Network Connectivity',
			'Hardware Failure',
			'Email Issue',
			'Mobile App Issue',
			'Configuration Assistance',
			'Compliance Question',
			'Third-party Service Issue',
			'User Training Request',
			'Report/Data Request',
			'Billing Inquiry',
			'Product Feedback',
			'Upgrade Request',
		];
		
		foreach ($categories as $category) {
			Category::create(['name' => $category]);
		}
	}
}