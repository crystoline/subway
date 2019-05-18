<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Meal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meal-form">
    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'status')->label('Activate?')->dropDownList([
                '1' => 'Yes',
                '0' => 'No',

            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Update meal', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
