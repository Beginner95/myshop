<?php if (!empty($session['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th style="text-align: center;">Кол-во</th>
                <th style="text-align: center;">Цена</th>
                <th style="text-align: center;">Сумма</th>
                <th style="text-align: center;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item) : ?>
                    <tr>
                        <td><?php echo \yii\helpers\Html::img("/web/img/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50]); ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td style="text-align: center;"><?php echo $item['qty']; ?></td>
                        <td style="text-align: center;"><?php echo number_format($item['price'], 2, ',', ' '); ?></td>
                        <td style="text-align: center;"><?php echo number_format($item['qty'] * $item['price'], 2, ',', ' '); ?></td>
                        <td style="text-align: center;"><span data-id="<?php echo $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td style="text-align: center;"><?php echo $session['cart.qty']; ?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td style="text-align: center;"><?php echo number_format($session['cart.sum'], 2, ',', ' '); ?></td>
                </tr>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>
