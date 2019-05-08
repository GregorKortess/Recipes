<?php

namespace frontend\models;

use Yii;

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
}
