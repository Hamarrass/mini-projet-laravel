<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 


   public const LOCALES =[
      'en' => 'English',
      'ar' => 'Arabic',
      'fr' => 'French'
   ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
    
    public function image(){
        return $this->morphOne(Image::class,'imageable');
   }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'is_admin',
        'locale'
     ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeUsersActive(Builder $query){
       return $query->withCount('posts')->orderBy("posts_count",'desc');
    }

    public function scopeUserActiveInLastMonth(Builder $query){
       return $query->withCount(['posts'=>function(Builder $q){
           $q->whereBetween(static::CREATED_AT,[now()->subMonth(1),now()]);
       }])
       ->having('posts_count','>',7)
       ->orderBy('posts_count','desc');
    }
    
  
 
}
