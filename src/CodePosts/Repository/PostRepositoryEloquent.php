<?php

namespace CodePress\CodePosts\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodePosts\Models\Post;

/**
 * Description of PostRepositoryEloquent
 *
 * @author gabriel
 */
class PostRepositoryEloquent extends AbstractRepository implements PostRepositoryInterface
{

    public function model()
    {
        return Post::class;
    }

}
