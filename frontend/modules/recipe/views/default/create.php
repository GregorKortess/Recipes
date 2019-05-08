<?php
/* @var $this yii\web\View */

/* @var $model frontend\modules\recipe\models\forms\RecipeForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$listOfKitchens = ['Азиатская' => 'Азиатская', 'Русская' => 'Русская', 'Французкая' => 'Французская', 'Итальянская' => 'Итальянская', 'Американская' => 'Американская', 'Немецкая' => 'Немецкая', 'Восточная' => 'Восточная'];
$listOfTypes = ['Первое' => 'Первое','Второе' => "Второе",'Закуска' => 'Закуска','Дессерт'=> "Дессерт","Праздничное" => "Праздничное",'Напиток' => "Напиток"];
?>

<div class="recipe-default-index">

    <h1>Создать рецепт</h1>

    <?php $form = ActiveForm::begin(); ?>


    <?php echo $form->field($model, 'picture')->label('Изображение:')->fileInput(); ?>

    <?php echo $form->field($model, 'name')->label('Название:');; ?>

    <?php echo $form->field($model, 'description')->label('Краткое описание:')->textarea(['rows' => 5]); ?>

    <?php echo $form->field($model, 'ingredients')->hint('Каждый ингредиент вводите с новой строки и обязательно в таком порядке: название ингредиента - количество.')->label('Индегриенты')->textarea(['rows' => 10]); ?>

    <?php echo $form->field($model, 'recipe')->label('Рецепт приготовления:')->textarea(['rows' => 10]); ?>

    <?php echo $form->field($model, 'cooking_time')->label('Время приготовления')->hint('минут'); ?>

    <?php echo $form->field($model, 'calorie')->label('Калорийность:')->hint('ккал.'); ?>

    <?php echo $form->field($model, 'type')->label('Тип:')->dropDownList($listOfTypes); ?>


    <?php echo $form->field($model, 'kitchen')->label('Национальная кухня:')->dropDownList($listOfKitchens); ?>

    <?php echo $form->field($model, 'difficulty')->label('Сложность приготовления:')->dropDownList(['Простая' => "Простая", 'Средняя' => 'Средняя', 'Сложная' => 'Сложная']); ?>

    <?php echo Html::submitButton('Создать'); ?>


    <?php ActiveForm::end(); ?>

</div>
