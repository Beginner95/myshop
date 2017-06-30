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

//            'id',
            [
                'attribute' => 'identificationName',
                'value' => function ($data) {
                    return $data->identificationName ? '<a href="' . \yii\helpers\Url::to(['user/view', 'id' => $data->id]) . '">' . $data->identificationName . '</a>' : 'Не задано';
                },
                'format' => 'html',
            ],
            'companyName',
            'firstName',
            'secondName',
            'lastName',
            'address',
            'email:email',
            'username',
            'discount',
//            'credit',
//            'postponement',
            [
                'attribute' => 'status',
                'value'     => function ($data) {
                    return $data->status ? '<span class="text-success">Активный</span>' : '<span class="text-danger">Заблокирован</span>';
                },
                'format'    => 'html',
            ],
            'phone',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
