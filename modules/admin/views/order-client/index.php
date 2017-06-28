<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы от клиетов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><a href="<?php echo \yii\helpers\Url::to(['order/index']); ?>">Заказы с сайта</a> | <?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'client_id',
                'value'     => function($data) {
                    return '<a href="' . \yii\helpers\Url::to(['order-client/view', 'id' => $data->id]) . '">' . $data->user->username . '</a>';
                },
                'format'    => 'html',
            ],
            'date_added',
            'date_update',
            'qty',

            [
                'attribute' => 'sum',
                'value' => function ($data) {
                    return number_format($data->sum, 2, ',', ' ');
                }
            ],
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

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
