<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use yii\web\Controller;
use frontend\models\Feed;



/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        $currentUser = Yii::$app->user->identity;

        $feedModel  = new Feed();

        $limit = Yii::$app->params['feedPostLimit'];

        $feedItems = $feedModel->getFeed($limit);

        return $this->render('index',[
            'feedItems' => $feedItems,
            'currentUser' => $currentUser,
        ]);
    }

}
