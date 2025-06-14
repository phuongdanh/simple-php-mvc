<?php

namespace App\Model;
use App\Core\Model;
/**
 * UserModel - Handles user-related database operations
 */
class UserModel extends Model
{
	protected $table = 'users';

	/**
	 * Get dummy user data for testing
	 * @return array List of dummy users
	 */
	public function list_dummy() {
		return [
			[
				'id' => 1,
				'name' => 'John Doe',
				'email' => 'john.doe@example.com',
				'role' => 'admin',
				'status' => 'active',
				'created_at' => '2024-01-15 10:00:00',
				'avatar' => 'https://i.pravatar.cc/150?img=1'
			],
			[
				'id' => 2,
				'name' => 'Jane Smith',
				'email' => 'jane.smith@example.com',
				'role' => 'user',
				'status' => 'active',
				'created_at' => '2024-01-16 11:30:00',
				'avatar' => 'https://i.pravatar.cc/150?img=2'
			],
			[
				'id' => 3,
				'name' => 'Bob Johnson',
				'email' => 'bob.johnson@example.com',
				'role' => 'user',
				'status' => 'inactive',
				'created_at' => '2024-01-17 09:15:00',
				'avatar' => 'https://i.pravatar.cc/150?img=3'
			],
			[
				'id' => 4,
				'name' => 'Alice Brown',
				'email' => 'alice.brown@example.com',
				'role' => 'editor',
				'status' => 'active',
				'created_at' => '2024-01-18 14:45:00',
				'avatar' => 'https://i.pravatar.cc/150?img=4'
			],
			[
				'id' => 5,
				'name' => 'Charlie Wilson',
				'email' => 'charlie.wilson@example.com',
				'role' => 'user',
				'status' => 'pending',
				'created_at' => '2024-01-19 16:20:00',
				'avatar' => 'https://i.pravatar.cc/150?img=5'
			]
		];
	}
}