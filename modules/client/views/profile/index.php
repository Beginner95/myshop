<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиент ' . $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstName',
            'secondName',
            'lastName',
            'address',
            'email:email',
            'username',
            'discount',
            'phone',
        ],
    ]) ?>
</div>
