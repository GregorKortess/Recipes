<?php

namespace frontend\models;

use Yii;
use yii\db\Connection;
/**
 * This is the model class for table "recipe".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $filename
 * @property string $description
 * @property int $created_at
 * @property string $recipe
 * @property string $ingredients
 * @property string $type
 * @property string $kitchen
 * @property int $calorie
 * @property string $difficulty
 * @property int $cooking_time
 */
class Recipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe';
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'filename' => 'Filename',
            'description' => 'Description',
            'created_at' => 'Created At',
            'recipe' => 'Recipe',
            'ingredients' => 'Ingredients',
            'type' => 'Type',
            'kitchen' => 'Kitchen',
            'calorie' => 'Calorie',
            'difficulty' => 'Difficulty',
            'cooking_time' => 'Cooking Time',
        ];
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);
    }

    /**
     * Ger recipe author
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param User $user
     */
    public function like(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->sadd("recipe:{$this->getId()}:likes", $user->getId());
        $redis->sadd("user:{$user->getId()}:likes",$this->getId());

        $sql = "UPDATE user SET rating=rating+1 WHERE id=".$this->getUserId(); ;
        return Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * @param User $user
     */
    public function unlike(User $user)
    {

        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->srem("recipe:{$this->getId()}:likes", $user->getId());
        $redis->srem("user:{$user->getId()}:likes",$this->getId());

        $sql = "UPDATE user SET rating=rating-1 WHERE id=".$this->getUserId(); ;
        return Yii::$app->db->createCommand($sql)->execute();
    }


    /**
     * @return mixed
     */
    public function countLikes()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard("recipe:{$this->getId()}:likes");
    }

    /**
     * Check whether given user liked current post
     * @param \frontend\models\User $user
     * @return integer
     */
    public function isLikedBy(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->sismember("recipe:{$this->getId()}:likes", $user->getId());
    }

    public function getId()
    {
        return $this->id;
    }

    private function getUserId()
    {
        return $this->user_id;
    }
}
