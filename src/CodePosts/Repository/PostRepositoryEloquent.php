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

    public function updateState(int $id, $state)
    {
        $post = $this->find($id);
        $post->state = $state;
        $post->save();
        return $post;
    }
    
    public function create(array $data)
    {
        /** @var Post $post */
        $post = parent::create($data);
        $post->user()->associate($data['user']);
        $post->save();
        
        $categories = $data['categories'];
        $tags = $data['tags'];
        $post->categories()->sync($categories);
        $post->tags()->sync($tags);
        
        return $post;
    }
    
    public function update(array $data, int $id)
    {
        /** @var Post $post */
        $post = parent::update($data, $id);
        $categories = $data['categories'];
        $tags = $data['tags'];
        $post->categories()->sync($categories);
        $post->tags()->sync($tags);
        
        return $post;
    }

}
