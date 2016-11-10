<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users') -> insert([[
        	'name' => 'User 1',
        	'password' => '$2y$10$G0xy4izBcXidCEhrEyKNheM3c1KAtNtgNN918EuqhXa3LG3xHxuQ2',
        	'email' => 'test@test.com'
        ], 
        [
        	'name' => 'User 2',
        	'password' => '$2y$10$G0xy4izBcXidCEhrEyKNheM3c1KAtNtgNN918EuqhXa3LG3xHxuQ2',
        	'email' => 'pipos@pipos.com'	
        ]]);
    }
}
