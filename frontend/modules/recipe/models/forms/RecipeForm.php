<?php

namespace frontend\modules\recipe\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\Recipe;
use frontend\models\User;
use frontend\models\events\RecipeCreatedEvent;

class RecipeForm extends Model
{

    const MAX_DESCRIPTION_LENGTH = 1500;
    const EVENT_RECIPE_CREATED = 'recipe_created';

    public $picture;
    public $description;
    public $name;
    public $recipe;
    public $ingredients;
    public $type;
    public $kitchen;
    public $calorie;
    public $difficulty;
    public $cooking_time;

    private $user;

    public function rules()
    {
        return [
            [['picture', 'description', 'name', 'recipe', 'ingredients'], 'required'],
            [['picture'], 'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg','png'],
                'checkExtensionByMimeType' => true,
                'maxSize' => $this->getMaxFileSize()],
            [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGTH],
            [['name', 'kitchen', 'type', 'difficulty'], 'string', 'max' => 255],
            [['calorie', 'cooking_time'], 'integer'],
        ];
    }


    public function __construct(User $user)
    {
        $this->user = $user;
        $this->on(self::EVENT_RECIPE_CREATED,[Yii::$app->feedService,'addToFeeds']);
    }

    public function save()
    {
        if ($this->validate()) {

            $recipe = new Recipe();

            $recipe->user_id = $this->user->getId();
            $recipe->name = $this->name;
            $recipe->filename = Yii::$app->storage->saveUploadedFile($this->picture);
            $recipe->description = $this->description;
            $recipe->created_at = time();
            $recipe->recipe = $this->recipe;
            $recipe->ingredients = $this->ingredients;
            $recipe->type = $this->type;
            $recipe->kitchen = $this->kitchen;
            $recipe->calorie = $this->calorie;
            $recipe->difficulty = $this->difficulty;
            $recipe->cooking_time = $this->cooking_time;

            if ($recipe->save(false)){

                $event = new RecipeCreatedEvent();
                $event->user = $this->user;
                $event->recipe = $recipe;

                $this->trigger(self::EVENT_RECIPE_CREATED,$event);
                return true;
            }
        }
        return false;
    }

    private function getMaxFileSize()
    {
        return Yii::$app->params['maxFileSize'];
    }
}
