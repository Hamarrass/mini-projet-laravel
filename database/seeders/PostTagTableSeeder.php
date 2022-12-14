<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsCount = Tag::count();
        Post::all()->each(function($post) use($tagsCount){
              $take = random_int(1,$tagsCount);
              $tagsIds =Tag::inRandomOrder()->take($take)->get()->pluck('id');
              $post->tags()->sync($tagsIds);
        });
    }
}
