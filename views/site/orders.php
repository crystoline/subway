<?php

/* @var $this yii\web\View */
/* @var $model  app\models\Meal*/

$this->title = 'Current Order';
?>

<div class="site-index">
    <?php if ($model != null): ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <caption>  <h3><b>Date</b>: <?php print $model->date ?> |  Active: <?php print $model->active ?> </h3></caption>
                <thead>
                <tr>
                    <th>User</th>
                    <th>Telephone</th>
                    <th>Location</th>
                    <th>Order</th>
                </tr>
                </thead>

                <?php if (!empty($model->orders)): ?>
                    <tbody>
                    <?php foreach ($model->orders as $order): ?>
                        <tr>
                            <td style="min-width: 200px"><?= $order->customer->name ?></td>
                            <td><a href="tel:<?= $order->customer->telephone ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-phone"></i>
                                    <?= $order->customer->telephone ?></a>
                            </td>
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
    <?php else: ?>
    <div class="alert alert-warning">There are no active meal</div>
    <?php endif; ?>
</div>
