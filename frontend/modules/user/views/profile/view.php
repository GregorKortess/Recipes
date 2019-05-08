<?php

/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */
/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */


use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\fileupload\FileUpload;

?>

<img src="<?php echo $user->getPicture(); ?>" id="profile-picture" width="180px" height="200px" />


<?php if ($currentUser->equals($user)): ?>

<div class="alert alert-success" style="display: none" id="profile-image-success">Profile image updated</div>
    <div class="alert alert-danger" style="display: none" id="profile-image-fail"></div>

    <?= FileUpload::widget([
        'model' => $modelPicture,
        'attribute' => 'picture',
        'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
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


    <a href="<?php echo Url::to(['/user/profile/delete-picture']); ?>" class="btn btn-danger">Delete picture</a>
<?php endif; ?>
<hr/>



<hr>
<h3><?php echo html::encode($user->username); ?></h3>
Rating:<?php echo html::encode($user->rating); ?>
<br>
<hr>
<p><?php echo html::encode($user->about); ?></p>
<hr>


posts

<li class="kek"></li>