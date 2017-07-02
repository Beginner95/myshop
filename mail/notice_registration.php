<h1><strong>Данные запроса</strong></h1>
<p><b>Фамилия: </b><?php echo $model->firstName; ?></p>
<p><b>Имя: </b><?php echo $model->secondName; ?></p>
<p><b>Отыество: </b><?php echo $model->lastName ; ?></p>
<p><b>E-mail: </b> <?php echo $model->email; ?></p>
<p><b>Логин: </b><?php echo $model->username; ?></p>
<p><b>Адрес: </b><?php echo $model->address; ?></p>
<p><b>Телефон: </b><?php echo $model->phone; ?></p>
<b>Дата запроса:</b> <?php echo date('d-m-Y'); ?>
<br>
<a href="<?php echo \yii\helpers\Url::to(['admin/user/index'], true); ?>">Перейти на страницу активации учетной записи</a>
