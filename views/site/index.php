<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $customer app\models\Customer */
/* @var $current_meal app\models\Meal */
/* @var $customer_order app\models\Order */
/* @var $customer_previous_order app\models\Order */
/* @var $previous_orders array */
/* @var $option_types array */
/* @var $message string */
$model = $customer_order ?: $customer_previous_order
?>

<?php if ($customer != null): ?>
    <h3>Welcome! <?= $customer->name ?></h3>
    <ul id="customer-tab" class="nav nav-tabs">
        <li class="active"><a href="#new" data-toggle="tab">New Order</a></li>
        <li><a href="#current" data-toggle="tab">Current Order</a></li>
        <li><a href="#history" data-toggle="tab">History</a></li>

    </ul>

    <div class="tab-content">
        <div class="tab-pane active fade in" id="new">
            <?php if ($current_meal): ?>
                <div class="row">
                    <div class="col-md-4">
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> <?= $message ?>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif ?>
                        <?php $form = ActiveForm::begin(); ?>
                        <h3>Manage Order</h3>
                        <input type="hidden" name="location" id="location">
                        <?php
                        /** @var \app\models\OptionType $option_types */
                        //Check box', 'Drop down list
                        foreach ($option_types as $option_type): ?>

                            <div class="form-group">
                                <label> <?= $option_type->name ?> </label>
                                <?php if ($option_type->type == 'Drop down list'): ?>
                                    <?php if ($option_type->is_multiple): ?>
                                        <select required name="order_detail[<?= $option_type->id ?>][]"
                                                class="form-control"
                                                multiple>
                                            <option value="" selected class="text-grey">--SELECT--</option>
                                            <?php foreach ($option_type->options as $option): ?>
                                                <option value="<?= $option->id ?>" <?= $model && $model->hasOption($option->id) ? 'selected' : '' ?>><?= $option->value ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php else: ?>
                                        <select required name="order_detail[<?= $option_type->id ?>]"
                                                class="form-control">
                                            <option value="" selected class="text-grey">--SELECT--</option>
                                            <?php foreach ($option_type->options as $option): ?>
                                                <option value="<?= $option->id ?>" <?= $model && $model->hasOption($option->id) ? 'selected' : '' ?>><?= $option->value ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                <?php elseif ($option_type->type == 'Check box'): ?>
                                    <br>
                                    <?php if ($option_type->is_multiple): ?>
                                        <?php foreach ($option_type->options as $option): ?>
                                            <label style="font-weight: normal">
                                                <input type="checkbox" name="order_detail[<?= $option_type->id ?>][]"
                                                       value="<?= $option->id ?>" <?= $model && $model->hasOption($option->id) ? 'checked' : '' ?>>
                                                <?= $option->value ?>
                                            </label> &nbsp;
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php foreach ($option_type->options as $option): ?>
                                            <label style="font-weight: normal">
                                                <input type="radio" name="order_detail[<?= $option_type->id ?>]"
                                                       value="<?= $option->id ?>" <?= $model && $model->hasOption($option->id) ? 'checked' : '' ?>>
                                                <?= $option->value ?>
                                            </label> &nbsp;
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif ?>

                            </div>


                        <?php endforeach; ?>
                        <div class="form-group">
                            <?= Html::submitButton((!$customer_order) ? 'Save Order' : 'Update Order', ['class' => 'btn btn-success']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php else: ?>
                <p></p>
                <div class="alert alert-warning">There is no meal available</div>
            <?php endif; ?>

        </div>

        <div class="tab-pane fade in" id="current">
            <div class="row">
                <?php if ($customer_order) : ?>
                    <div class="col-md-4">

                        <table class="table table-striped table->bordered">
                            <caption><h3>Current Order</h3></caption>
                            <?php foreach ($option_types as $option_type): ?>
                                <tr>
                                    <td><b><?= $option_type->name ?></b></td>
                                    <td>
                                        <?php foreach ($customer_order->getOptions($option_type->id) as $option): ?>
                                            <span class="label label-default"><?= $option->value ?></span> &nbsp;
                                        <?php endforeach; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><b>Rating</b></td>
                                <td>
                                     <span id="current-<?= $customer_order->id ?>">
                                         <?= $customer_order->ratingHtml ?>
                                         <?php if (!isset($customer_order->rating)): ?>
                                             <button type='button' class="btn btn-sm btn-primary"
                                                     onclick="rating('current-<?= $customer_order->id ?>', <?= $customer_order->id ?>)">Rate this meal</button>
                                         <?php endif ?>
                                     </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                <?php else: ?>
                    <p></p>
                    <div class="alert alert-warning">You haven't ordered yet</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="tab-pane fade in" id="history">
            <div class="row">
                <div class="col-md-10">

                    <table class="table table-striped">
                        <caption><h3>Order History</h3></caption>
                        <thead>
                        <tr>
                            <th>Date/time</th>
                            <th>Location</th>
                            <th>Orders</th>
                            <th>Ratings</th>
                        </tr>
                        </thead>

                        <?php if (!empty($customer->orders)): ?>
                            <tbody>
                            <?php foreach ($customer->orders as $i => $order): ?>
                                <tr>

                                    <td><?= date('D jS M, y, g:h A', strtotime($order->date)) ?></td>
                                    <td>
                                        <?php if ($order->location): ?>
                                            <?= $order->location ?>
                                            <a target="_blank"
                                               href="https://www.google.com/maps/@<?= $order->location ?>,18z?hl=en"
                                               class="btn btn-sm btn-primary" title="view on map"> <i
                                                        class="fa fa-map "> view</i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php foreach ($order->orderDetails as $orderDetail):
                                            if (!empty($orderDetail->option->value)): ?>
                                                <span class="badge badge-secondary"><?= $orderDetail->option->optionType->name . ': ' . $orderDetail->option->value ?></span>
                                            <?php endif;
                                        endforeach; ?>
                                    </td>
                                    <td>
                                            <span id="history<?= $order->id ?>">

                                                <?= $order->ratingHtml ?>
                                                <?php if (!isset($order->rating)): ?>
                                                    <button type='button' class="btn btn-sm btn-primary"
                                                            onclick="rating('history<?= $order->id ?>', <?= $order->id ?>)">Rate this meal</button>
                                                <?php endif ?>
                                            </span>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        <?php else: ?>
                            <tfoot>
                            <tr>
                                <td colspan="3" style="text-align:center">No previous order</td>
                            </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


<?php else: ?>
    <form class="row">
        <fieldset>
            <legend>Login to make an order</legend>
            <div class="form-group col-md-4">
                <input name="code" type="text" id="code" class="form-control" placeholder="Enter unique code here">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Login</button>
            </div>
        </fieldset>

    </form>

    <?php if (Yii::$app->request->get('code')): ?>
        <p></p>
        <div class="alert alert-warning">User account was not found</div>
    <?php endif; ?>
<?php endif; ?>


<script>
    window.onload = function (ev) {
        // $('#myTab a:first').tab('show')
        var loc_display = $('#location_display');
        var loc_input = $('#location');
        var showPosition = function (position) {
            loc_display.text("Lat: " + position.coords.latitude + ", Lon: " + position.coords.longitude);
            loc_input.val(position.coords.latitude + "," + position.coords.longitude);
        };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            loc_display.text("Geolocation is not supported by this browser.");
        }


    };


    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }

    var selected_feeling;

    function rating(target, order_id) {
        selected_feeling = null;
        swal({
            title: "",
            text: '<p>How would you like to rate this meal?</p><span onclick="event.preventDefault();reply(\'sad\')" type="button" value="sad" class="btn feel">' +
            '<i class="fa fa-frown fa-3x"></i></span><span onclick="event.preventDefault();reply(\'neutral\')" type="button" value="neutral" class="btn feel">' +
            '<i class="fa fa-meh fa-3x"></i></span><span onclick="event.preventDefault();reply(\'happy\')" type="button" value="happy" class="btn feel">' +
            '<i class="fa fa-smile fa-3x"></i></span><hr>',
            icon: "info",
            className: '',
            closeOnClickOutside: false,
            html: true,
            buttons: {
                confirm: {
                    text: "Close",
                    value: '',
                    visible: true,
                    className: "btn btn-default",
                    closeModal: true
                }
            }
        }, function (value) {
            var rating = null;
            var feeling_html = '';

            if (selected_feeling === 'sad') {
                swal("Sorry!", {
                    icon: "error",
                    buttons: false
                });
                rating = 0;
                feeling_html = '<span class="feel"><i class="fa fa-frown fa-3x"></i></span>';
            } else if (selected_feeling === 'neutral') {
                swal("Okay!", {
                    icon: "warning",
                    buttons: false
                });
                rating = 1;
                feeling_html = '<span class="feel"><i class="fa fa-meh fa-3x"></i></span>';
            } else if (selected_feeling === 'happy') {
                swal("Hooray!", {
                    icon: "success",
                    buttons: false
                });
                rating = 2;
                feeling_html = '<span class="feel"><i class="fa fa-smile fa-3x"></i></span>';
            }

            if (feeling_html) {
                fetch('/site/rate?rating=' + rating + '&order_id=' + order_id).then(function (respone) {
                    $('#' + target).html(feeling_html);
                })
            }
        });
    }

    function reply(feel) {
        selected_feeling = feel;
    }

</script>
