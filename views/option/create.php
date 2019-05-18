<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Option */
/* @var $option_types array */

$this->title = 'Create Option';
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'option_types' => $option_types
    ]) ?>

</div>
