<?php

namespace CodePress\CodePosts\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Validator;

/**
 * Description of Category
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
        
        if($validator->fails())
        {
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

}
