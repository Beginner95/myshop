<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'firstName',
            'secondName',
            'lastName',
            'address',
             'email:email',
             'username',
             'discount',
             [
                 'attribute' => 'status',
                 'value'     => function ($data) {
                     return $data->status ? '<span class="text-success">Активный</span>' : '<span class="text-danger">Заблокирован</span>';
                 },
                 'format'    => 'html',
             ],
             'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
