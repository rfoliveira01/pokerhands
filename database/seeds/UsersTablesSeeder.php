<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'name'    => 'Rodrigo',
            'email'    => 'rfoliveira@rfoliveira.com',
            'password'   =>  Hash::make('password'),
            'remember_token' =>  '',
        ]);
    }
}
