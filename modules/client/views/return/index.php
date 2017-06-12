<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Оформление возврата товаров';
?>
<div class="container-fluid">
    <div class="row">
        <h1><?php echo $this->title; ?></h1>
        <?php if (empty($items)) : ?>
            <div class="alert alert-info" role="alert">На данный момент у вас нет заказанных товаров</div>
        <?php else: ?>
        <table class="table table-bordered table-return">
            <tr>
                <th>#</th>
                <th>Наименование товара</th>
                <th>Дата</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['return/list'],
                ]);
            ?>
            <?php foreach ($items as $item) : ?>
                <?php
                    $startTime = new Datetime($item->date_added);
                    $endTime = new DateTime();
                    $diff = $endTime->diff($startTime);
                ?>
                <?php if ($diff->format('%a') < 183) : ?>
                    <tr>
                        <td>
                            <?php echo $form->field($item, 'id['.$item->id.']')->checkbox(['value' => $item->id]); ?>
                        </td>
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->date_added; ?></td>
                        <td><?php echo number_format($item->price, 2, ',', ' '); ?></td>
                        <td><?php echo $item->qty_item; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="5"><?php echo Html::submitButton('Вернуть', ['class' => 'btn btn-default']); ?></td>
            </tr>

            <?php $form = ActiveForm::end(); ?>
        </table>
        <?php endif; ?>
    </div>
</div>

