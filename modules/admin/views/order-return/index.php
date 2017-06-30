<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Возвраты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-return-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->firstName . ' ' . $data->user->secondName . ' ' . $data->user->lastName;
                }
            ],
            'date_added',
            'qty',
            [
                'attribute' => 'sum',
                'value' => function ($data) {
                    return number_format($data->sum, 2, ',', ' ');
                }
            ],

            [
                'attribute' => 'status',
                'value' => function($data) {
                    return !$data->status ? '<span class="text-danger">Не подтвержден</span>' : '<span class="text-success">Подтвержден</span>';
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
