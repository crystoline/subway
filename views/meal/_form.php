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

            <b>Current Location: <br></b> <span id="location_display"></span>
            <div class="form-group">
                <?= Html::submitButton('Create Meal', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
