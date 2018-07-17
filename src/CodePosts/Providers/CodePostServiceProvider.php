<?php

namespace CodePress\CodePosts\Providers;

use CodePress\CodePosts\Repository\PostRepositoryEloquent;
use CodePress\CodePosts\Repository\PostRepositoryInterface;
use CodePress\CodePosts\Repository\CommentRepositoryEloquent;
use CodePress\CodePosts\Repository\CommentRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Ktquez\Tinymce\TinymceServiceProvider;

/**
 * Description of CodePostServiceProvider
 *
 * @author gabriel
 */
class CodePostServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('database/migrations')], 'migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codepost', 'codepost');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codecomment', 'codecomment');
        require __DIR__ . '/../routes.php';
    }

    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepositoryEloquent::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepositoryEloquent::class);
        $this->app->register(TinymceServiceProvider::class);
    }

}
