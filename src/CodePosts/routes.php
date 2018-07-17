<?php

Route::name('admin.')
        ->prefix('admin/')
        ->middleware('web', 'auth')
        ->namespace('CodePress\CodePosts\Controllers')
        ->group(function () {
            Route::get('posts/deleted', 'AdminPostsController@deleted')->name('posts.deleted');
            Route::get('posts/deleted/restore/{post}', 'AdminPostsController@restore')->name('posts.restore');
            Route::resources([
                'posts' => 'AdminPostsController'
            ]);
        });
        
Route::name('admin.')
        ->prefix('admin/')
        ->middleware('web', 'auth')
        ->namespace('CodePress\CodePosts\Controllers')
        ->group(function () {
            Route::get('comments/deleted', 'AdminCommentsController@deleted')->name('comments.deleted');
            Route::get('comments/deleted/restore/{comment}', 'AdminCommentsController@restore')->name('comments.restore');
            Route::resources([
                'comments' => 'AdminCommentsController'
            ]);
        });

