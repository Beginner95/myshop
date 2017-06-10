<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Transaction */

$this->title = 'Платеж №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'amount',
                'value' => number_format($model->amount, 2, ',', ' '),
            ],
            [
                'attribute' => 'status',
                'value' =>  $model->status == 1 ? '<span class="text-success">Подтвержден</span>' : '<span class="text-danger">Не подтвержден</span>',
                'format' => 'html',
            ],
            'payment_method',
            'date_added',
            'date_update',
            [
                'attribute' => 'user_id',
                'value' => $model->user->firstName . ' ' . $model->user->secondName . ' ' . $model->user->lastName,
            ],
        ],
    ]) ?>

</div>
