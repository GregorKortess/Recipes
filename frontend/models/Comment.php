<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $recipe_id
 * @property string $comment_text
 * @property string $comment_author
 * @property int $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipe_id' => 'Recipe ID',
            'comment_text' => 'Comment Text',
            'comment_author' => 'Comment Author',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Get recipe comments
     * @return \yii\db\ActiveQuery
     */
    public function getComments($id)
    {
       return Comment::find()->where(['recipe_id' => $id])->all();
    }

    public function getCommentsCount($id)
    {
        return Comment::find()->where(['recipe_id' => $id])->count();

    }
}
