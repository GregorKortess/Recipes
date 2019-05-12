<?php

namespace frontend\modules\recipe\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\Recipe;
use frontend\models\Comment;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use frontend\modules\recipe\models\forms\RecipeForm;
use frontend\modules\recipe\models\forms\CommentForm;


/**
 * Default controller for the `recipe` module
 */
class DefaultController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        if(Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        $model = new RecipeForm(Yii::$app->user->identity);

        if ($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model, 'picture');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Рецепт создан !');
                return $this->goHome();
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $model = new CommentForm(Yii::$app->user->identity, $id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect('/recipe/' . $id . '#bottom');
        }

        $commentsModel = new Comment();

        $comments = $commentsModel->getComments($id);

        return $this->render('view', [
            'recipe' => $this->findRecipe($id),
            'currentUser' => $currentUser,
            'model' => $model,
            'comments' => $comments
        ]);
    }

    /**
     * @return array|Response
     * @throws NotFoundHttpException
     */
    public function actionLike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $recipe = $this->findRecipe($id);

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $recipe->like($currentUser);

        return [
            'success' => true,
            'likesCount' => $recipe->countLikes(),
        ];
    }

    /**
     * @return array|Response
     * @throws NotFoundHttpException
     */
    public function actionUnlike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $recipe = $this->findRecipe($id);

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $recipe->unlike($currentUser);

        return [
            'success' => true,
            'likesCount' => $recipe->countLikes(),
        ];
    }


    /**
     * @param $id
     * @return Recipe|null
     * @throws NotFoundHttpException
     */
    private function findRecipe($id)
    {
        if ($user = Recipe::findOne($id)) {
            return $user;
        }
        throw new NotFoundHttpException();
    }


}
