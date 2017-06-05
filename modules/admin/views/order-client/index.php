<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы с сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?> | <a href="#">Заказы от клиетов</a> </h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_added',
            'date_update',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value'     => function($data) {
                    return !$data->status ? '<span class="text-danger">Активен</span>' : '<span class="text-success">Заверщен</span>';
                },
                'format'    => 'html',
            ],
//            'status',
            // 'name',
            // 'email:email',
            // 'phone',
            // 'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
