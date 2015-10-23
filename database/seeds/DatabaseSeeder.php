<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->truncateTables([
			'users',
			'password_resets',
			'tickets',
			'ticket_votes',
			'ticket_comments'
		]);

		$this->call('UserTableSeeder');
	}

	private function truncateTables(array $tables)
	{
		$this->checkForeignKeys(false);

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}

		$this->checkForeignKeys(false);
	}

	private function checkForeignKeys($check)
	{
		$check  = ($check ? '1' : '0');
		DB::statement('SET FOREIGN_KEY_CHECKS = ' . $check);
	}

}
