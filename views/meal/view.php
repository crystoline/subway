<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Meal */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="row">
    <div class="col-md-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'date',
                'active',
            ],
        ]) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-8">
        <table class="table table-striped">
            <caption><h3>Meal Order</h3></caption>
            <thead>
            <tr>
                <th>User</th>
                <th>Telephone</th>
                <th>Location</th>
                <th>Order</th>
            </tr>
            </thead>
            <?php if ($model != null): ?>
                <tbody>
                <?php foreach ($model->orders as $order): ?>
                    <tr>
                        <td><?= $order->customer->name ?></td>
                        <td><?= $order->customer->telephone ?></td>
                        <td>
                            <?php  if($order->location):?>
                                <?= $order->location ?>
                                <a target="_blank" href="https://www.google.com/maps/@<?= $order->location ?>,18z?hl=en" class="btn btn-sm btn-primary" title="view on map"> <i class="fa fa-map "> view</i></a>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php foreach ($order->orderDetails as $orderDetail):
                                if (!empty($orderDetail->option->value)): ?>
                                    <span class="badge badge-secondary"><?=  $orderDetail->option->optionType->name.': '.$orderDetail->option->value ?></span>
                                <?php endif;
                            endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tfoot>
                <tr>
                    <td colspan="3" style="text-align:center">No record available</td>
                </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>



</div>
