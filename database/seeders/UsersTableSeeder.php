<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        $nbrsUsers =$this->command->ask('How many of user you want generate ? ' , 10 );
        User::factory($nbrsUsers)->create();

    }
}
