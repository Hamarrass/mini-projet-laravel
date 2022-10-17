<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content','user_id'] ;

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public  function tags(){
        return $this->morphToMany(Tag::class,'taggable')->withTimestamps();
      } 

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentable(){
        return $this->morphTo();
    }
 

    public function scopeDernier(Builder $query){
          return $query->orderBy(static::UPDATED_AT,'asc');
    }


    public static function boot(){
        parent::boot();

        static::creating(function(Comment $comment){
        if($comment->commentable != null){
            Cache::forget("post-show-{$comment->commentable->id}");
        }
     });
      
  
      }
}
