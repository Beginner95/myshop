<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
    /* @var $this yii\web\View */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = 'История платежей';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
                    'date_added',
                    [
                        'attribute' => 'amount',
                        'value' => function ($data) {
                            return number_format($data->amount, 2, ',', ' ');
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($data) {
                            return $data->status == 1 ? '<span class="text-success">Подтвержден</span>' : '<span class="text-danger">Не подтвержден</span>';
                        },
                        'format' => 'html',
                    ],
                ],
            ]);
        ?>
        </div>
        <div class="col-md-9">
            mode
            mode
        </div>
    </div>
</div>