<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OptionType */

$this->title = 'Create Option Type';
$this->params['breadcrumbs'][] = ['label' => 'Option Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
