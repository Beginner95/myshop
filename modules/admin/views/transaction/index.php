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

            'id',
            [
                'attribute' => 'amount',
                'value' => function ($data) {
                    return number_format($data->amount, 2, ',', ' ');
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if ( $data->status == 0 ) {
                        return '<span class="text-danger">Не подтвержден</span>';
                    } elseif ( $data->status == 1 ) {
                        return '<span class="text-success">Подтвержден</span>';
                    } else {
                        return '<span class="text-danger">Откланен</span>';
                    }
                },
                'format' => 'html',
            ],
            'payment_method',
            'date_added',
            // 'date_update',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->firstName . ' ' . $data->user->secondName . ' ' . $data->user->lastName;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
