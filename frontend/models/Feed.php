<?php

namespace frontend\models;

use Yii;
use yii\db\Connection;

/**
 * This is the model class for table "feed".
 *
 * @property int $id
 * @property int $author_id
 * @property string $author_name
 * @property int $author_nickname
 * @property string $author_picture
 * @property int $recipe_id
 * @property string $recipe_filename
 * @property string $recipe_description
 * @property int $post_created_at
 */
class Feed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feed';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'author_nickname' => 'Author Nickname',
            'author_picture' => 'Author Picture',
            'recipe_id' => 'Recipe ID',
            'recipe_filename' => 'Recipe Filename',
            'recipe_description' => 'Recipe Description',
            'post_created_at' => 'Post Created At',
        ];
    }

    /**
     * @param $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getFeed($limit)
    {
        $order = ['post_created_at' => SORT_DESC];
        return Feed::find()->orderBy($order)->limit($limit)->all();
    }

    public function countLikes()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard("recipe:{$this->recipe_id}:likes");
    }
}
