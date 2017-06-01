<table style="border: 1px solid #e0e0e0; width: 100%; border-collapse: collapse;">
    <thead>
    <tr style="background: #e3e3e3;">
        <th style="text-align: center; border: 1px solid #e0e0e0;">Наименование</th>
        <th style="text-align: center; border: 1px solid #e0e0e0; padding: 8px;">Кол-во</th>
        <th style="text-align: center; border: 1px solid #e0e0e0;">Цена</th>
        <th style="text-align: center; border: 1px solid #e0e0e0;">Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($session['cart'] as $id => $item) : ?>
        <tr  style="border: 1px solid #e0e0e0;">
            <td style="border: 1px solid #e0e0e0; padding: 8px;"><a href="<?php echo \yii\helpers\Url::to(['product/view', 'id' => $id], true); ?>"><?php echo $item['name']; ?></a></td>
            <td style="text-align: center; border: 1px solid #e0e0e0; padding: 8px;"><?php echo $item['qty']; ?></td>
            <td style="text-align: center; border: 1px solid #e0e0e0; padding: 8px;"><?php echo number_format($item['price'], 2, ',', ' '); ?></td>
            <td style="text-align: center; border: 1px solid #e0e0e0; padding: 8px;"><?php echo number_format($item['qty'] * $item['price'], 2, ',', ' '); ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3" style="border: 1px solid #e0e0e0; padding: 8px;">Итого: </td>
        <td style="text-align: center; border: 1px solid #e0e0e0; padding: 8px;">
            <?php echo $session['cart.qty']; ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border: 1px solid #e0e0e0; padding: 8px;">На сумму: </td>
        <td style="text-align: center; border: 1px solid #e0e0e0; padding: 8px;"><?php echo number_format($session['cart.sum'], 2, ',', ' '); ?></td>
    </tr>
    </tbody>
</table>
