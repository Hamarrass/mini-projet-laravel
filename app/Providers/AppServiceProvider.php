<?php

namespace App\Providers;

use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Models\Comment;
use App\Observers\PostObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer(['posts.index','posts.show'],ActivityComposer::class);
        // view()->composer(['posts.sidebar'],ActivityComposer::class);
        view()->composer('*',ActivityComposer::class);
        Comment::observe(CommentObserver::class);
        Post::observe(PostObserver::class);
        // CommentResource::withoutWrapping();
        
        JsonResource::withoutWrapping();


    }
}
