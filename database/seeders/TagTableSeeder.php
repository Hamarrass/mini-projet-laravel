<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $tags = collect(['travel','Science','Games','Cars','Books','News','Training']);
         $tags->each(function($tag){
             $myTag = new Tag();
             $myTag->name =$tag;
             $myTag->save();
         });
    }
}
