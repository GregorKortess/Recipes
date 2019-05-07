<?php

/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @rar $currentUser frontend\model\User */
/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */


use yii\helpers\Html;
use dosamigos\fileupload\FileUpload;

?>

<img src="<?php echo $user->getPicture(); ?>" width="180px" height="180px">

<?= FileUpload::widget([
    'model' => $modelPicture,
    'attribute' => 'picture',
    'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
    'options' => ['accept' => 'image/*'],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    // Also, you can specify jQuery-File-Upload events
    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]);
?>

<hr>
<h3><?php echo html::encode($user->username); ?></h3>
Rating:<?php echo html::encode($user->rating); ?>
<br>
<hr>
<p><?php echo html::encode($user->about); ?></p>
<hr>


posts

<li class="kek"></li>