<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $customer app\models\Customer */
/* @var $current_meal app\models\Meal */
/* @var $customer_order app\models\Order */
/* @var $customer_previous_order app\models\Order */
/* @var $option_types array */
$model = $customer_order? : $customer_previous_order
?>

<?php if($customer != null ): ?>
<h3>Welcome! <?= $customer->name ?></h3>

    <?php if($current_meal): ?>

        <div class="row">
            <div class="col-md-4">
                <?php $form = ActiveForm::begin(); ?>
                <input type="hidden" name="location" id="location">
                <?php
                /** @var \app\models\OptionType $option_types */
                //Check box', 'Drop down list
                foreach($option_types as $option_type): ?>

                    <div class="form-group">
                        <label> <?=  $option_type->name ?> </label>
                        <?php if($option_type->type == 'Drop down list'):  ?>
                        <?php if($option_type->is_multiple):  ?>
                            <select required name="order_detail[<?= $option_type->id ?>][]" class="form-control" multiple>
                                <option value="" selected class="text-grey">--SELECT--</option>
                                <?php foreach($option_type->options as $option): ?>
                                    <option value="<?= $option->id ?>" <?= $model->hasOption($option->id)? 'selected': '' ?>><?= $option->value ?></option>
                                <?php endforeach;?>
                            </select>
                            <?php else:  ?>
                                <select required name="order_detail[<?= $option_type->id ?>]" class="form-control" >
                                    <option value="" selected class="text-grey">--SELECT--</option>
                                    <?php foreach($option_type->options as $option): ?>
                                        <option value="<?= $option->id ?>" <?= $model->hasOption($option->id)? 'selected': '' ?>><?= $option->value ?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif;  ?>
                        <?php elseif($option_type->type == 'Check box'):  ?>
                            <br>
                            <?php if($option_type->is_multiple):  ?>
                                    <?php foreach($option_type->options as $option): ?>
                                        <label style="font-weight: normal">
                                            <input type="checkbox" name="order_detail[<?= $option_type->id ?>][]" value="<?= $option->id ?>" <?= $model->hasOption($option->id)? 'checked': '' ?>>
                                            <?= $option->value ?>
                                        </label> &nbsp;
                                    <?php endforeach;?>
                            <?php else:  ?>
                                    <?php foreach($option_type->options as $option): ?>
                                        <label style="font-weight: normal">
                                             <input type="radio" name="order_detail[<?= $option_type->id ?>]" value="<?= $option->id ?>" <?= $model->hasOption($option->id)? 'checked': '' ?>>
                                            <?= $option->value ?>
                                        </label> &nbsp;
                                    <?php endforeach;?>
                            <?php endif;  ?>
                        <?php endif  ?>

                    </div>


                <?php endforeach;?>
                <div class="form-group">
                    <?= Html::submitButton((!$customer_order)? 'Save Order': 'Update Order', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4">
                <?php if($customer_order) :?>
                    <table class="table table-striped table->bordered">

                    <?php foreach($option_types as $option_type): ?>
                        <tr>
                            <td><b><?= $option_type->name ?></b></td>
                            <td>
                                <?php foreach ($customer_order->getOptions($option_type->id) as $option): ?>
                                    <span class="label label-default"><?= $option->value ?></span> &nbsp;
                                <?php endforeach; ?>
                            </td>
                            <
                        </tr>
                    <?php endforeach; ?>
                    </table>

                <?php endif;?>

            </div>
        </div>



    <?php else: ?>
        <div class="alert alert-warning">There is no meal available</div>

    <?php endif; ?>

<?php else: ?>
    <form class="row">
        <div class="form-group col-md-4">
            <input name="code" type="text" id="code" class="form-control" placeholder="Enter unique code here">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
    <div class="alert alert-warning">User account was not found</div>
<?php endif; ?>


<script>
    window.onload = function (ev) {
        var loc_display = $('#location_display');
        var loc_input = $('#location');
        var showPosition =  function (position) {
            loc_display.text( "Lat: " + position.coords.latitude + ", Lon: " + position.coords.longitude);
            loc_input.val( position.coords.latitude + "," + position.coords.longitude);
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
</script>
