<?php if (0 == $model->status) : ?>
    <h3>Уважаемый <?php echo $model->firstName . ' ' . $model->secondName . ' ' . $model->lastName ; ?>!</h3>
    <p>Ваш аккаунт заблокирован</p>
    <a href="<?php echo \yii\helpers\Url::to(['/'], true); ?>">Магазин</a>
    <b>Дата:</b> <?php echo date('d-m-Y'); ?>
<?php else: ?>
    <h3>Уважаемый <?php echo $model->firstName . ' ' . $model->secondName . ' ' . $model->lastName ; ?>!</h3>
    <p>Вы отправили запрос на регистраци кабинета оптового клиента. Администрация магазина успешно активировала вашу учетную запись!</p>
    <a href="<?php echo \yii\helpers\Url::to(['client/default'], true); ?>">Перейти в личный кабинет</a>
    <b>Дата:</b> <?php echo date('d-m-Y'); ?>
<?php endif; ?>