<?php

namespace frontend\components;

use frontend\models\Feed;
use yii\base\Component;
use yii\base\Event;


class FeedService extends Component
{

    public function addToFeeds(Event $event)
    {
        $user = $event->getUser();
        $recipe = $event->getRecipe();

        $feedItem = new Feed();

        $feedItem->author_id = $user->id;
        $feedItem->author_name = $user->username;
        $feedItem->author_nickname = $user->getNickname();
        $feedItem->author_picture = $user->getPicture();

        $feedItem->recipe_id = $recipe->id;
        $feedItem->recipe_filename = $recipe->filename;
        $feedItem->recipe_description = $recipe->description;
        $feedItem->post_created_at = $recipe->created_at;

        $feedItem->save();

    }

}