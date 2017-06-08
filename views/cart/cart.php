<?php if (empty(Yii::$app->session['cart'])) : ?>
    <ul>
        <li style="padding-left: 35px">
            <a href="#" onclick="return getCart()">
                <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
        </li>
        <li style="margin-top: 8px;">Корзина пуста!</li>
    </ul>

<?php else: ?>
    <ul>
        <li>
            <a href="#" onclick="return getCart()">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                <span class="qty count-qty"><?php echo Yii::$app->session['cart.qty']; ?></span>
            </a>
        </li>
        <li>
            Ваша корзина <br>
            <?php echo Yii::$app->session['cart.qty']; ?>
            товаров -
            <?php echo number_format(Yii::$app->session['cart.sum'], 2, ',', ' '); ?>р.
        </li>
    </ul>
<?php endif; ?>