<?php

namespace App\Models;

use App\Models\User;
use App\Scopes\AdminShowDeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory, SoftDeletes;

     protected $fillable=['title','content','slug','active','user_id'];
    
     public function comments(){
       return $this->hasMany(Comment::class)->dernier() ;
     }

     public function user(){
       return $this->belongsTo(User::class);
     }

     public  function tags(){
       return $this->belongsToMany(Tag::class)->withTimestamps();
     }

     public function scopeMostCommented(Builder $query){
       return $query->withCount('comments')->orderBy('comments_count','desc');
     }

     public function scopePostWithUserCommentsTags(Builder $query){
       return $query->withCount('comments')->with(['user','tags']);
     }


    

    public static function boot(){
      static::addGlobalScope(new AdminShowDeleteScope); 
      parent::boot();

      static::addGlobalScope(new LatestScope);

      static::deleting(function(Post $post){
        $post->comments()->delete(); 
      });

     static::updating(function(Post $post){
            Cache::forget("post-show-{$post->id}");
     });
      
      
  
     static::restoring(function(Post $post){ 
       $post->comments()->restore();
     });

    }
}
