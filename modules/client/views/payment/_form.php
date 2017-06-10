<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="category-form container">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'amount')->textInput(['maxlength' => true]); ?>
    <?php echo $form->field($model, 'payment_method')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
