<?php

Route::name('admin.')
        ->prefix('admin/')
        ->middleware('web')
        ->namespace('CodePress\CodePosts\Controllers')
        ->group(function () {
            Route::resources([
                'posts' => 'AdminPostsController'
            ]);
        });
