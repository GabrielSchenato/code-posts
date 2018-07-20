<?php

Route::name('admin.')
        ->prefix('admin/')
        ->middleware('web', 'auth', 'authorization:access_posts')
        ->namespace('CodePress\CodePosts\Controllers')
        ->group(function () {
            Route::get('posts/deleted', 'AdminPostsController@deleted')->name('posts.deleted');
            Route::get('posts/deleted/restore/{post}', 'AdminPostsController@restore')->name('posts.restore');
            Route::patch('posts/update-state/{post}', 'AdminPostsController@updateState')->name('posts.update_state')->middleware('authorization:publish_post');
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

