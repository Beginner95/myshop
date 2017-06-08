<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <?php echo GridView::widget([
            'dataProvider' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
            ]
        ]);
    ?>
    </div>
</div>