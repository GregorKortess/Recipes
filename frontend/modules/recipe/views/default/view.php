<?php

/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $recipe frontend\models\Recipe */
/* @var $comments frontend\models\Comment */
/* @var $commentsCount \frontend\models\Comment */

/* @var $model frontend\modules\recipe\models\forms\CommentForm */


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;

?>

    <div class="recipe-default-index">


        <div class="page-posts no-padding">
            <div class="row">
                <div class="page page-post col-sm-12 col-xs-12 post-82">


                    <div class="blog-posts blog-posts-large">

                        <div class="row">

                            <!-- feed item -->
                            <article class="post col-sm-12 col-xs-12">
                                <div class="post-meta">

                                    <h1 align="center"><?php echo $recipe->name; ?></h1>

                                    <div class="post-title">
                                        <img src="<?php echo Yii::$app->storage->getFile($recipe->user->picture); ?>"
                                             class="author-image"/>
                                        <div class="author-name"><a
                                                    href="#"><?php echo $recipe->user->username ?></a></div>
                                    </div>
                                </div>
                                <div class="post-type-image">
                                    <a href="#">
                                        <img src="<?php echo $recipe->getImage(); ?>" alt="">
                                    </a>
                                </div>
                                <div class="post-description">
                                    <p>                <?php echo Html::encode($recipe->description); ?>
                                    </p>
                                </div>
                                <div class="recipe-cook">
                                    <h3 align="center">Приготовление</h3>
                                    <?php echo $recipe->recipe; ?>
                                    <br>
                                </div>
                                <div class="recipe-ingredients">
                                    <h3 align="center">Индегриенты</h3>
                                    <?php echo $recipe->ingredients; ?>
                                    <br><br>
                                </div>

                                <div class="recipe-info">
                                    <h4>Дополнительная информация:</h4>
                                    <ul class=list-group-flush">
                                        <li class="list-group-item">Тип блюда: <b><?php echo $recipe->type; ?></b></li>
                                        <li class="list-group-item">Сложность: <b><?php echo $recipe->difficulty; ?></b>
                                        </li>
                                        <li class="list-group-item"> Кухня: <b><?php echo $recipe->kitchen; ?></b></li>
                                        <li class="list-group-item">Каллорийность:
                                            <b><?php echo $recipe->calorie; ?></b> ккал.
                                        </li>
                                        <li class="list-group-item">Время приготовления:
                                            <b><?php echo $recipe->cooking_time; ?></b> мин.
                                        </li>
                                    </ul>
                                    <br>

                                </div>

                                <div class="post-bottom">
                                    <div class="post-likes"><i class="fa fa-lg fa-heart-o"></i>
                                        <span class="likes-count"><?php echo $recipe->countLikes(); ?></span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="btn btn-default button-unlike"
                                           style="<?php echo ($currentUser && $recipe->isLikedBy($currentUser)) ? "" : "display:none"; ?>""
                                        data-id="<?php echo $recipe->id; ?>">
                                        Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
                                        </a>
                                        <a href="#" class="btn btn-default button-like"
                                           style="<?php echo ($currentUser && $recipe->isLikedBy($currentUser)) ? "display:none" : ""; ?>"
                                           data-id="<?php echo $recipe->id; ?>">
                                            Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
                                        </a>
                                    </div>
                                    <div class="post-comments">
                                        <a href="#bottom"><?php echo $commentsCount;  ?> Комментариев</a>

                                    </div>
                                    <div class="post-date">
                                        <span><?php echo Yii::$app->formatter->asDatetime($recipe->created_at); ?></span>
                                    </div>
                                </div>
                            </article>
                            <!-- feed item -->


                            <div class="col-sm-12 col-xs-12">
                                <h4 align="center"><?php echo($commentsCount ? "$commentsCount комментариев" : "") ?> </h4>
                                <div class="comments-post">

                                    <div class="single-item-title"></div>
                                    <div class="row">
                                        <ul class="comment-list">

                                            <!-- comment item -->
                                            <?php foreach ($comments as $comment): ?>
                                                <li class="comment">

                                                    <div class="comment-info">
                                                        <h4 class="author"><a href="#"><?php echo $comment->comment_author; ?></a> <span>(<?php echo Yii::$app->formatter->asDatetime($comment->created_at) ?>)</span>
                                                        </h4>
                                                        <p><?php echo $comment->comment_text; ?></p>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                            <!-- comment item -->


                                        </ul>
                                    </div>

                                </div>
                                <!-- comments-post -->
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <div class="comment-respond">
                                    <h4>Оставить отзыв</h4>
                                    <form action="#" method="post">
                                        <p class="comment-form-comment">
                                            <?php $form = ActiveForm::begin(); ?>

                                            <?php echo $form->field($model, 'comment_text')->textarea(['rows' => 7]); ?>

                                            <?php echo Html::submitButton('Отправить', ['class' => 'btn btn-secondary']); ?>

                                            <?php ActiveForm::end(); ?>
                                        </p>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    <div id="bottom">

    </div>

<?php $this->registerJsFile('@web/js/like.js', [
    'depends' => JqueryAsset::className(),
]);
