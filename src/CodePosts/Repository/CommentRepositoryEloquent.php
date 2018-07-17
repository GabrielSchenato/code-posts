<?php

namespace CodePress\CodePosts\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodePosts\Models\Comment;

/**
 * Description of CommentRepositoryEloquent
 *
 * @author gabriel
 */
class CommentRepositoryEloquent extends AbstractRepository implements CommentRepositoryInterface
{

    public function model()
    {
        return Comment::class;
    }

}
