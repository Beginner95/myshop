<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Не подтвержден', '1' => 'Подтвержден', ]) ?>

    <?= $form->field($model, 'payment_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
