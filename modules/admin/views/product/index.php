<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Списко товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'category_id',
                'value'     => function($data) {
                    return $data->category->name;
                },
            ],
            'name',
            'price',
            'wholesale_price',
            [
                'attribute' => 'status',
                'value'     => function($data) {
                    return $data->status ? '<span class="text-success">Опубликован</span>' : '<span class="text-danger">Не опубликован</span>';
                },
                'format'    => 'html',
            ],
            [
                'attribute' => 'sale',
                'value'     => function($data) {
                    return $data->sale ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>';
                },
                'format'    => 'html',
            ],
            [
                'attribute' => 'new',
                'value'     => function($data) {
                    return $data->new ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>';
                },
                'format'    => 'html',
            ],
            [
                'attribute' => 'hit',
                'value'     => function($data) {
                    return $data->hit ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>';
                },
                'format'    => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
