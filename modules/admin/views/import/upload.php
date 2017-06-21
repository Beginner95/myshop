<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Загрузка прайс листа в базу данных';
?>

    <div class="row">
        <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php endif; ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?php echo $form->field($model, 'priceFile')->fileInput(); ?>

        <?php echo $form->field($model_category, 'id')->label('Категория')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name')); ?>

        <button>Загрузить</button>

        <?php ActiveForm::end() ?>
    </div>

