<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use common\widgets\Alert;

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>

<body class="home page">
<div class="wrapper">
    <header>
        <div class="header-top">
            <div class="container">
                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 brand-logo">
                    <h1>
                        <a href="<?php echo Url::to(['/site/index']) ?>">
                            <img src="/img/logo.jpg" alt="">
                        </a>
                    </h1>
                </div>
                <div class="col-md-4 col-sm-4 navicons-topbar">
                    <ul>
                        <li class="blog-search">
                            <a href="#" title="Search"><i class="fa fa-search"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="header-main-nav">
            <div class="container">
                <div class="main-nav-wrapper">
                    <nav class="main-menu">
                        <?php

                        $menuItems = [
                            ['label' => 'Рецепты', 'url' => ['/site/index']],
                        ];
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => 'Регистрация', 'url' => ['/user/default/signup']];
                            $menuItems[] = ['label' => 'Вход', 'url' => ['/user/default/login']];
                        } else {
                            $menuItems[] = ['label' => 'Мой профиль', 'url' => ['/user/profile/view', 'nickname' => Yii::$app->user->identity->getNickname()]];
                            $menuItems[] = ['label' => 'Создать рецепт', 'url' => ['/recipe/default/create']];
                            $menuItems[] = '<li>'
                                . Html::beginForm(['/user/default/logout'], 'post')
                                . Html::submitButton(
                                    'Выход (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';
                        }
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => $menuItems,
                        ]);
                        ?>

                    </nav>
                </div>
            </div>
        </div>

    </header>

    <div class="container full">

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <div class="push"></div>
</div>

<footer>
    <div class="footer">
        <div class="back-to-top-page">
            <a class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
        <p class="text">Created by Gregor Cortess</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<body>

    <?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);

//    NavBar::end();
    ?>