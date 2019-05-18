<?php

/* @var $this yii\web\View */
/* @var $current_meal  app\models\Meal*/

$this->title = 'My Yii Application';
?>
<br>
<br>
<div class="site-index">
    <?php if($current_meal != null):?>
        <h3><b>Date</b>: <?php print $current_meal->date ?></h3>
        <table class="table table-striped">
            <caption><h3>Current Order</h3></caption>
            <thead>
            <tr>
                <th>User</th>
                <th>Location</th>
                <th>Orders</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($current_meal->orders as $order): ?>
                <tr>
                    <td><?= $order->customer->name ?></td>
                    <td><?= $order->location ?></td>
                    <td>
                        <?php foreach ( $order->orderDetails as $orderDetail):
                            if(!empty( $orderDetail->option->value)): ?>
                                <span class="badge badge-secondary"><?= $orderDetail->option->value ?></span>
                            <?php endif;
                        endforeach;?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"  style="text-align:center">No record available</td>
            </tr>
            </tfoot>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">The is no meal available</div>
    <?php endif ?>
</div>
