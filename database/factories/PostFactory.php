<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(67);
        //  $users   = User::all();
        //  foreach($users as  $user ){
        //    $users_id[] = $user->id ;
        //  }
  
        

        return [
              'title' => $title,
            'content' => $this->faker->text(),
             'active' => $this->faker->boolean(),
               'slug' => Str::Slug($title,'-'),
               'updated_at'=>$this->faker->dateTimeBetween('-3 years') 
            // 'user_id' => random_int($users_id[0],$users_id[count($users_id)-1])
        ]; 
    }
}
