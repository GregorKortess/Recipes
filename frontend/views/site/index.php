<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $feedItems[] frontend\models\Feed */

use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = 'Newsfeed';
?>

    <div class="page-posts no-padding">
        <div class="row">
            <div class="page page-post col-sm-12 col-xs-12">
                <div class="blog-posts blog-posts-large">

                    <div class="row">

                        <?php if ($feedItems): ?>
                            <?php foreach ($feedItems as $feedItem): ?>
                                <?php /* @var $feedItem Feed */ ?>


                                <!-- feed item -->
                                <article class="post col-sm-12 col-xs-12">
                                    <div class="post-meta">
                                        <div class="post-title">
                                            <img src="<?php echo $feedItem->author_picture; ?>" class="author-image" />
                                            <div class="author-name">
                                                <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id]); ?>">
                                                    <?php echo Html::encode($feedItem->author_name); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-type-image">
                                        <a href="<?php echo Url::to(['/recipe/default/view', 'id' => $feedItem->recipe_id]); ?>">
                                            <img align="center" src="<?php echo Yii::$app->storage->getFile($feedItem->recipe_filename); ?>" alt="" width="600" height="200" />
                                        </a>
                                    </div>
                                    <div class="post-description">
                                        <p><?php echo HtmlPurifier::process($feedItem->recipe_description); ?></p>
                                    </div>
                                    <div class="post-bottom">
                                        <div class="post-likes">
                                            <i class="fa fa-lg fa-heart-o"></i>
                                            <span class="likes-count"><?php echo $feedItem->countLikes(); ?></span>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="#" class="btn btn-default button-unlike <?php echo ($currentUser->likesRecipe($feedItem->recipe_id)) ? "" : "display-none"; ?>" data-id="<?php echo $feedItem->recipe_id; ?>">
                                                Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
                                            </a>
                                            <a href="#" class="btn btn-default button-like <?php echo ($currentUser->likesRecipe($feedItem->recipe_id)) ? "display-none" : ""; ?>" data-id="<?php echo $feedItem->recipe_id; ?>">
                                                Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
                                            </a>
                                        </div>
                                        <div class="post-comments">
                                            <a href="#">0 Comments</a>
                                        </div>
                                        <div class="post-date">
                                            <span><?php echo Yii::$app->formatter->asDatetime($feedItem->post_created_at); ?></span>
                                        </div>
                                    </div>
                                </article>
                                <!-- feed item -->

                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="col-md-12">
                                Nobody posted yet!
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
$this->registerJsFile('@web/js/like.js', [
    'depends' => JqueryAsset::className(),
]);
