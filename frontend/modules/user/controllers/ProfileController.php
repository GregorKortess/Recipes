<?php


namespace frontend\modules\user\controllers;

use Yii;
use Faker;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\modules\user\models\forms\PictureForm;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    public function actionView($nickname)
    {
        $currentUser = Yii::$app->user->identity;

        $modelPicture = new PictureForm();

        return $this->render('view', [
            'user' => $this->findUser($nickname),
            'currentUser' => $currentUser,
            'modelPicture' => $modelPicture,
        ]);
    }

    public function actionUploadPicture()
    {
        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model,'picture');

        if ($model->validate()) {

           $user = Yii::$app->user->identity;
           $user->picture = Yii::$app->storage->saveUploadedFile($model->picture);

           if ($user->save(false,['picture'])) {
               print_r($user->attributes);die;
           }
        }

        echo "<pre>";
        print_r($model->getErrors());
        echo "<pre>";
    }

    /**
     * @param $nickname
     * @return string id or nickname
     * @throws NotFoundHttpException
     */
    private function findUser($nickname)
    {
        if ($user = User::find()->where(['nickname' => $nickname])->orWhere(['id' => $nickname])->one()) {
            return $user;
        }

        throw new NotFoundHttpException();
    }

//    public function actionGenerate()
//    {
//        $faker = \Faker\Factory::create();
//
//        for ($i = 0; $i < 1000 ; $i++) {
//            $user = new User ([
//                'username' => $faker->name,
//                'email' => $faker->email,
//                'about' => $faker->text(500),
//                'nickname' => $faker->regexify('[A-Za-z0-9_]{5,15}'),
//                'rating' => $faker->randomNumber(5),
//                'auth_key' => Yii::$app->security->generateRandomString(),
//                'password_hash' => Yii::$app->security->generateRandomString(),
//                'created_at' => $time = time(),
//                'updated_at' => $time,
//            ]);
//            $user->save(false);
//        }
//    }

}