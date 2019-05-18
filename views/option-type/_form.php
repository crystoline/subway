<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OptionType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="option-type-form">

    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->dropDownList([
                'Check box' => 'Check box', 'Drop down list' => 'Drop down list'
                //'Bread type', 'Bread size', 'Baked', 'Taste', 'Extras', 'Vegetables', 'Sauce'
            ]) ?>

            <?= $form->field($model, 'sort')->Input('number', ['min' => 0]) ?>

            <?= $form->field($model, 'is_multiple')->dropDownList([
                 0 => 'No', 1 => 'Yes'
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
