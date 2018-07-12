<?php

namespace CodePress\CodePosts\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Validator;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeTag\Models\Tag;

/**
 * Description of Post
 *
 * @author gabriel
 */
class Post extends Model
{

    use Sluggable;

    protected $table = "codepress_posts";
    protected $fillable = [
        'title', 'content', 'slug'
    ];
    private $validator;

    function getValidator()
    {
        return $this->validator;
    }

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable', 'codepress_categorizables');
    }
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'codepress_taggables');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
