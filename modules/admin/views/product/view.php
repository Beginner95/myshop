<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = $model->getImage(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'category_id',
            [
                'attribute' => 'category_id',
                'value'     => $model->category->name,
            ],
            'name',
            'model',
            [
                'attribute' => 'image',
                'value' => "<img src='{$img->getUrl('268x270')}'>",
                'format' => 'html',
            ],
            'price',
            'wholesale_price',
            [
                'attribute' => 'status',
                'value'     => $model->status ? '<span class="text-success">Опубликован</span>' : '<span class="text-danger">Не опубликован</span>',
                'format'    => 'html',
            ],
            [
                'attribute' => 'sale',
                'value'     => $model->sale ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>',
                'format'    => 'html',
            ],
            [
                'attribute' => 'new',
                'value'     => $model->new ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>',
                'format'    => 'html',
            ],
            [
                'attribute' => 'hit',
                'value'     => $model->hit ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>',
                'format'    => 'html',
            ],
            'content:html',
            'keywords',
            'description',
            'date_added',
            'date_update',
        ],
    ]) ?>

</div>
