<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Option */
/* @var $form yii\widgets\ActiveForm */
/* @var $option_types array */
//die(print_r($option_types));
?>

<div class="option-form">

    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'option_type_id')->label('Option Type')->dropDownList($option_types) ?>

            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
