<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderReturn */

$this->title = 'Create Order Return';
$this->params['breadcrumbs'][] = ['label' => 'Order Returns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-return-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
