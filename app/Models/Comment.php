<?php

namespace App\Models;
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


  
}
