<?php

/* @var $this yii\web\View */
/* @var $users frontend\models\user */
/* @var $feedItems[] frontend\models\feed */

use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = 'My Yii Application';
?>
<div class="site-index">

<?php if($feedItems): ?>
    <?php foreach ($feedItems as $feedItem): ?>
    <?php /* @var $feedItem \frontend\models\Feed */ ?>

    <div class="col-md-12">
        
        <div class="col-md-12">
            <img src="<?php echo $feedItem->author_picture; ?>" width="30" height="30">
            <a href="<?php echo Url::to(['/user/profile/view','nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id]) ?>">
                <?php echo Html::encode($feedItem->author_name); ?>
            </a>
        </div>

        <img src="<?php echo Yii::$app->storage->getFIle($feedItem->recipe_filename); ?>" width="700" height="500">
        <div class="col-md-12">
            <?php echo HtmlPurifier::process($feedItem->recipe_description); ?>
        </div>


        <div class="col-md-12">
            <?php echo Yii::$app->formatter->asDatetime($feedItem->post_created_at); ?>
        </div>

        <div class="col-md-12">
            Likes: <span class="likes-count"><?php echo $feedItem->countLikes(); ?></span>

            <a href="#" class="btn btn-primary button-unlike" style="<?php echo ($currentUser->likesRecipe($feedItem->recipe_id)) ? "" : "display:none"; ?>" data-id="<?php echo $feedItem->recipe_id; ?>">
                Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
            </a>
            <a href="#" class="btn btn-primary button-like" style="<?php echo ($currentUser->likesRecipe($feedItem->recipe_id)) ? "display:none" : ""; ?>" data-id="<?php echo $feedItem->recipe_id; ?>">
                Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
            </a>
        </div>


    </div>
    <div class="col-md-12"><hr/></div>
    <?php endforeach; ?>

    <?php else: ?>
    <div class="col-md-12">
        Рецептов нет.
    </div>
    
    <?php endif; ?>

</div>

<?php $this->registerJsFile('@web/js/like.js',[
  'depends' => \yii\web\JqueryAsset::className(),
]);

