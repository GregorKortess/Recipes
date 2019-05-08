<?php

namespace frontend\modules\recipe\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\modules\recipe\models\forms\RecipeForm;


/**
 * Default controller for the `recipe` module
 */
class DefaultController extends Controller
{
    public function actionCreate()
    {

        $model = new RecipeForm(Yii::$app->user->identity);

        if ($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model,'picture');

            if($model->save()) {
                Yii::$app->session->setFlash('success','Рецепт создан !');
                return $this->goHome();
            }

        }

        return $this->render('create',[
            'model' => $model,
        ]);
    }

}
