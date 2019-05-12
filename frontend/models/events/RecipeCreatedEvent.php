<?php

namespace frontend\models\events;

use yii\base\Event;
use frontend\modules\User;
use frontend\models\Recipe;
use frontend\components\FeedService;

class RecipeCreatedEvent extends Event
{

    /**
     * @var \frontend\models\User
     */
    public $user;

    /**
     * @var Recipe;
     */
    public $recipe;

    public function getUser()
    {
        return $this->user;
    }

    public function getRecipe()
    {
        return $this->recipe;
    }
}
