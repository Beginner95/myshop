<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'logotip',
            'phone',
            'name_company',
            'email:email',
             'address',
             'slogan',
             'usd',
             'rub',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],

        ],
    ]); ?>
</div>
