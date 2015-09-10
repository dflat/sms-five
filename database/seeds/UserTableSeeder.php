<?php 

use App\User;
use Illuminate\Database\Seeder;

/**
* 
*/
class UserTableSeeder extends Seeder
{
	
	public function run()
	{
		$faker = Faker\Factory::create();

			
			User::create(
				[

				'name' => 'Jeff Lessin',
				'email' => 'jeff@gmail.com',
				'password' => Hash::make('password')

				]);
			
			User::create(
				[

				'name' => 'Alan Lessin',
				'email' => 'alan@gmail.com',
				'password' => Hash::make('password')

				]);
				
	}
}



