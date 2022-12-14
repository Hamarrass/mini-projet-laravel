<?php

namespace App\Models;

use App\Models\User;
use App\Scopes\AdminShowDeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{

    use HasFactory, SoftDeletes;

     protected $fillable=['title','content','slug','active','user_id'];
       /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
     'created_at',
     'updated_at',
     'active',
     'user_id',
     'deleted_at',
     'slug'
   ];
    
     public function comments(){
       return $this->morphMany(Comment::class,'commentable')->dernier() ;
     }

     public function user(){
       return $this->belongsTo(User::class);
     }

     public  function tags(){
       return $this->morphToMany(Tag::class,'taggable')->withTimestamps();
     }

     public function image(){
          return $this->morphOne(Image::class,'imageable');
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

    }
}
