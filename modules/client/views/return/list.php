<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Список возвращаемых товаров';
?>
<div class="container-fluid">
    <div class="row">
        <h1><?php echo $this->title; ?></h1>
        <?php if (false === $items) : ?>
            <div class="alert alert-info" role="alert">На данный момент у вас нет списко возвращаемых товаров</div>
        <?php else: ?>
        <table class="table table-bordered table-return">
            <tr>
                <th>Наименование товара</th>
                <th>Дата покупки</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
                <th>Причина возврата</th>
            </tr>
            <?php
                $foo = 0;
                $sum = 0;
                $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['return/return'],
                ])
            ;?>

            <?php foreach ($items as $item) : ?>
                    <tr>
                        <td>
                            <?php
                                echo $form->field($item, 'id[' . $item->id . ']')->hiddenInput(['value' => $item->id]);
                                echo $item->name;
                            ?>
                        </td>
                        <td>
                            <?php echo $item->date_added; ?>
                        </td>
                        <td>
                            <?php
                                echo number_format($item->price, 2, ',', ' ');
                            ?>
                        </td>
                        <td>
                            <?php
                                $foo += $item->qty_item;
                                echo $form->field($item, 'qty')->hiddenInput(['value' => $foo]);
                                echo $item->qty_item;

                            ?>
                        </td>
                        <td>
                            <?php
                                $sum += $item->price * $item->qty_item;
                                echo $form->field($item, 'sum')->hiddenInput(['value' => $sum]);
                                echo number_format($item->price * $item->qty_item, 2, ',', ' ');

                            ?>
                        </td>
                        <td><?php echo $form->field($item, 'description[' . $item->id . ']')->textarea(['size'=>10, 'required' => 'required']);?></td>
                    </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">Итого</td>
                <td><?php echo $foo; ?></td>
                <td><?php echo number_format($sum, 2, ',', ' '); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6"><?php echo Html::submitButton('Оформить возврат', ['class' => 'btn btn-default']); ?></td>
            </tr>

            <?php $form = ActiveForm::end(); ?>
        </table>
        <?php endif; ?>
    </div>
</div>