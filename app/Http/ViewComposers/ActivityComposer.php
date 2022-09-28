<?php
namespace App\Http\ViewComposers ;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View ;
use Illuminate\Support\Facades\Cache;

class ActivityComposer {
   public function compose(View $view){

      $mostComments = Cache::remember('mostComments',now()->addSecond(10),function(){
                return Post::mostCommented()->take(5)->get();
        }) ;
      $mostPosts    = Cache::remember('mostPosts',now()->addSecond(10),function(){
            return User::usersActive()->take(5)->get() ;
        });
      $mostUserActiveInlastMonth = Cache::remember('mostUserActiveInlastMonth',now()->addSecond(10),function(){
            return User::userActiveInLastMonth()->take(5)->get() ;
        });

        $view->with(['mostComments'=>$mostComments ,'mostPosts'=>$mostPosts ,'mostUserActiveInlastMonth'=>$mostUserActiveInlastMonth]);

   }
}