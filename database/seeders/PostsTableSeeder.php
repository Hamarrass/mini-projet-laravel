<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        if($users->count() == 0){
            $this->command->info('please create some users !');
             return ;
        }

        $nmbrsPosts = $this->command->ask("how man post do you want generate ?", 50);
        $users= User::all() ;
        Post::factory($nmbrsPosts)->make()->each(
            function($post) use ($users){
                $post->user_id = $users->random()->id ; 
                $post->save();
            }
        );
    }
}
