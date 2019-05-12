<?php

namespace frontend\modules\recipe\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\Recipe;
use frontend\models\User;
use  frontend\models\Comment;

class CommentForm extends Model
{

    const MAX_COMMENT_LENGTH = 1500;

    public $comment_text;


    private $user;
    private $recipeId;

    public function rules()
    {
        return [
            [['comment_text'], 'required'],
        ];
    }


    public function __construct(User $user, $id)
    {
        $this->user = $user;
        $this->recipeId = $id;

    }

    public function save()
    {
        if ($this->validate()) {

            $comment = new Comment();


            $comment->comment_author = $this->user->getUsername() ;
            $comment->comment_text = $this->comment_text;
            $comment->created_at = time();
            $comment->recipe_id = $this->recipeId ;


            return $comment->save(false);
        }
    }


}
