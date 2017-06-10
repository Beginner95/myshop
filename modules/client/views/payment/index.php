<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
    /* @var $this yii\web\View */
    /* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="container">
    <div class="row">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'amount',
                'status',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    ?>
    </div>
</div>