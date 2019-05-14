<?php

/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */

/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */


use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\fileupload\FileUpload;
use yii\helpers\HtmlPurifier;

?>

<div class="page-posts no-padding">
    <div class="row">
        <div class="page page-post col-sm-12 col-xs-12 post-82">


            <div class="blog-posts blog-posts-large">

                <div class="row">

                    <!-- profile -->
                    <article class="profile col-sm-12 col-xs-12">
                        <div class="profile-title">
                            <img src="<?php echo $user->getPicture(); ?>" id="profile-picture" class="author-image"/>
                            <div class="author-name"><?php echo Html::encode($user->username) ?></div>

                            <?php if ($currentUser && $currentUser->equals($user)): ?>



                                <?= FileUpload::widget([
                                    'model' => $modelPicture,
                                    'attribute' => 'picture',
                                    'url' => ['/user/profile/upload-picture'],
                                    'options' => ['accept' => 'image/*'],
                                    'clientEvents' => [
                                        'fileuploaddone' => 'function(e, data) {
                            if (data.result.success) {
                                $("#profile-image-success").show();
                                $("#profile-image-fail").hide();
                                $("#profile-picture").attr("src", data.result.pictureUri);
                            } else {
                                $("#profile-image-fail").html(data.result.errors.picture).show();
                                $("#profile-image-success").hide();
                            }
                        }',

                                    ],
                                ]); ?>


<!--                                <a href="--><?php //echo Url::to(['/user/profile/delete-picture']); ?><!--"-->
<!--                                   class="btn btn-default">Delete picture</a>-->
                            <?php endif; ?>

                            <!--                            <a href="#" class="btn btn-default">Upload profile image</a>-->
                            <br>
                            <div class="alert alert-success" style="display: none" id="profile-image-success">Profile
                                image updated
                            </div>
                            <div class="alert alert-danger" style="display: none" id="profile-image-fail"></div>

                        </div>

                        <div class="profile-description">
                            <p><?php echo HtmlPurifier::process($user->about) ?></p>
                        </div>
                        <div class="profile-bottom">
                            <div class="profile-post-count">
                                <span><?php echo $user->getRecipeCount(); ?> Рецептов</span>
                            </div>
                            <div class="profile-followers">
                                <span><?php echo html::encode($user->rating); ?> лайков</span>
                            </div>
                        </div>
                    </article>

                    <div class="col-sm-12 col-xs-12">
                        <div class="row profile-posts">
                            <?php foreach ($user->getRecipes() as $recipe): ?>
                            <div class="col-md-4 profile-post">
                                <a href="<?php echo Url::to(['/recipe/default/view','id' => $recipe->getId()])?>"><img src="<?php echo Yii::$app->storage->getFile($recipe->filename); ?>" class="author-image" width="300" height="220"></a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
</div>

