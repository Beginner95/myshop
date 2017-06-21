<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\client\controllers\OrderClientController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index row">
    <div class="col-md-3">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'date_added',
                    'value'     => function($data) {
                        return '<a href="/client/order-client/view?id=' . $data->id . '">Заказ ' . OrderClientController::getDate($data->date_added) . '</a>';
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'sum',
                    'value' => function ($data) {
                        return number_format($data->sum, 2, ',', ' ');
                    }
                ],
                [
                    'attribute' => 'status',
                    'value'     => function($data) {
                        return !$data->status ? '<span class="text-danger">В обработке</span>' : '<span class="text-success">Готов</span>';
                    },
                    'format'    => 'html',
                ],
            ],
        ]); ?>
    </div>
    <?php if (!empty($model)) : ?>
    <div class="col-md-9">
        
    </div>
    <?php endif; ?>
</div>
