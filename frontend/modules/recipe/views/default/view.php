<?php

/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $recipe frontend\models\Recipe */
/* @var $model frontend\modules\recipe\models\forms\CommentForm */


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JqueryAsset;
?>

<div class="recipe-default-index">


    <div class="row">

        <div class="col-md-12">
            <h1><?php echo $recipe->name; ?></h1>
        </div>

        <div class="col-md-12">
            <?php if($recipe->user): ?>
                <h4><?php echo $recipe->user->username ?></h4>
                <?php echo date('Y-m-d',$recipe->created_at); ?>
            <?php endif; ?>
        </div>

        <div class="col-md-12">
            <img src="<?php echo $recipe->getImage(); ?>" alt="">
        </div>

        <div class="col-md-12">
            <?php echo Html::encode($recipe->description); ?>
            <hr/>
        </div>

        <div class="col-md-12">
            Likes: <span class="likes-count"><?php echo $recipe->countLikes(); ?></span>

            <a href="#" class="btn btn-primary button-unlike" style="<?php echo ($currentUser && $recipe->isLikedBy($currentUser)) ? "" : "display:none"; ?>"" data-id="<?php echo $recipe->id; ?>">
                Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
            </a>
            <a href="#" class="btn btn-primary button-like" style="<?php echo ($currentUser && $recipe->isLikedBy($currentUser)) ? "display:none" : ""; ?>" data-id="<?php echo $recipe->id; ?>">
                Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
            </a>

        </div>


        <div class="col-md-12">
            <hr>
            Индегриенты:
            <br>
            <b><?php echo $recipe->ingredients; ?></b>
            <hr>
        </div>

        <div class="col-md-12">
            Способ приготовления:
            <br>
            <?php echo $recipe->recipe; ?>
            <hr>
        </div>

        <div class="col-md-12">
            Дополнительная информация:
            <ul class=list-group-flush">
                <li class="list-group-item">Тип блюда: <b><?php echo $recipe->type; ?></b></li>
                <li class="list-group-item">Сложность: <b><?php echo $recipe->difficulty; ?></b></li>
                <li class="list-group-item"> Кухня: <b><?php echo $recipe->kitchen; ?></b></li>
                <li class="list-group-item">Каллорийность: <b><?php echo $recipe->calorie; ?></b></li>
                <li class="list-group-item">Время приготовления: <b><?php echo $recipe->cooking_time; ?></b> мин.</li>
            </ul>
        </div>

    </div>


    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'comment_text')->label('Текст комментария:')->textarea(['rows' => 7]); ?>

    <?php echo Html::submitButton('Отправить'); ?>

    <?php ActiveForm::end(); ?>

</div>

<div id="element_id">

</div>

<?php $this->registerJsFile('@web/js/like.js',[
        'depends' => JqueryAsset::className(),
]);
