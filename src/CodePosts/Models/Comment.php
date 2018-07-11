<?php

namespace CodePress\CodePosts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Validator;

/**
 * Description of Comment
 *
 * @author gabriel
 */
class Comment extends Model
{

    protected $table = "codepress_comments";
    protected $fillable = [
        'content', 'post_id'
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
    
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
