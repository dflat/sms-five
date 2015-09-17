<?php 

use App\Ticket;
use App\User;
use Illuminate\Database\Seeder;

/**
* 
*/
class TicketTableSeeder extends Seeder
{
	
	public function run()
	{
		$faker = Faker\Factory::create();
		$users = User::all()->lists('id');

		$rows = [];

		$publicPath = public_path();

		$file = fopen($publicPath . "/files/TicketInformation.txt","r");
		while(! feof($file))
		  {
		  $rows[]=(fgetcsv($file));
		  }

		fclose($file);

		foreach ($rows as $row){
			Ticket::create(
			[
			'user_id' => $faker->randomElement($users),
			'name' => $row[0],
			'form' => $row[1],
			'price' => $row[4],
			'cost' => 2.99,
			'ticket_count' => (int)$row[3],
			'take_in' => $row[3],
			'pay_out' => $row[6],
			'qoh' => 0
			]);
		}
			





		// }

		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Jumpin Joeys',
		// 	'form' => 'TC2575',
		// 	'price' => 5.99,
		// 	'cost' => 2.99,
		// 	'ticket_count' => 1060,
		// 	'take_in' => 1060,
		// 	'pay_out' => 795,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Playing The Ponies',
		// 	'form' => 'TC2278',
		// 	'price' => 15.99,
		// 	'cost' => 10.99,
		// 	'ticket_count' => 2240,
		// 	'take_in' => 2240,
		// 	'pay_out' => 1670,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Running With The Big Dogs',
		// 	'form' => 'TC5425',
		// 	'price' => 12.99,
		// 	'cost' => 8.99,
		// 	'ticket_count' => 2680,
		// 	'take_in' => 2680,
		// 	'pay_out' => 2065,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Monday Night Money',
		// 	'form' => 'TC0169',
		// 	'price' => 13.99,
		// 	'cost' => 6.99,
		// 	'ticket_count' => 1200,
		// 	'take_in' => 1200,
		// 	'pay_out' => 927,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Cowabunga',
		// 	'form' => 'TC2485',
		// 	'price' => 18.99,
		// 	'cost' => 12.99,
		// 	'ticket_count' => 1935,
		// 	'take_in' => 1935,
		// 	'pay_out' => 1520,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Speedtrap',
		// 	'form' => 'TC9035',
		// 	'price' => 7.99,
		// 	'cost' => 3.99,
		// 	'ticket_count' => 420,
		// 	'take_in' => 420,
		// 	'pay_out' => 300,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Pot Of Gold',
		// 	'form' => 'AI582D',
		// 	'price' => 11.99,
		// 	'cost' => 4.99,
		// 	'ticket_count' => 400,
		// 	'take_in' => 400,
		// 	'pay_out' => 280,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Maiden'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Pot Of Gold',
		// 	'form' => 'AI899Q',
		// 	'price' => 8.99,
		// 	'cost' => 2.99,
		// 	'ticket_count' => 600,
		// 	'take_in' => 600,
		// 	'pay_out' => 400,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Maiden'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Fast Draw',
		// 	'form' => 'AI8A30',
		// 	'price' => 13.99,
		// 	'cost' => 10.99,
		// 	'ticket_count' => 230,
		// 	'take_in' => 230,
		// 	'pay_out' => 150,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Maiden'
		// 	]);
		// Ticket::create(
		// 	[
		// 	'user_id' => $faker->randomElement($users),
		// 	'name' => 'Cash In A Flash',
		// 	'form' => 'TC0176',
		// 	'price' => 10.99,
		// 	'cost' => 7.99,
		// 	'ticket_count' => 220,
		// 	'take_in' => 220,
		// 	'pay_out' => 150,
		// 	'qoh' => 0,
		// 	'reorder_point' => 10,
		// 	'vendor'=> 'Milton'
		// 	]);
			
	}
	
}



