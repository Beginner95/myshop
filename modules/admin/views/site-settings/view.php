<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SiteSettings */

$this->title = 'Данные сайта';
$this->params['breadcrumbs'][] = ['label' => 'Site Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'logotip',
            'phone',
            'name_company',
            'email:email',
            'address',
            'slogan',
            'usd',
            'rub',
        ],
    ]) ?>

</div>
