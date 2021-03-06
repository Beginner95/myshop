<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Платежы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return '<a href="' . \yii\helpers\Url::to(['transaction/view', 'id' => $data->id]) . '">' . $data->user->identificationName . '</a>';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'amount',
                'value' => function ($data) {
                    return number_format($data->amount, 2, ',', ' ');
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return $data->status == 0 ? '<span class="text-danger">Не подтвержден</span>' : '<span class="text-success">Подтвержден</span>';
                },
                'format' => 'html',
            ],
            'payment_method',
            'date_added',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
