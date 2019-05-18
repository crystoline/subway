<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Option */
/* @var $option_types array */

$this->title = 'Update Option: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option_types' => $option_types
    ]) ?>

</div>
