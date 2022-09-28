<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\TagTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\CommentsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 

       if($this->command->confirm('Do you want to refresh the database ?',true)){
          $this->command->call('migrate:refresh');
          $this->command->info('database was refreshed !');
       }

        $this->call([UsersTableSeeder::class,PoststableSeeder::class,CommentsTableSeeder::class,TagTableSeeder::class,PostTagTableSeeder::class]);

    }
}
