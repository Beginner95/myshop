<h3>Уважаемый <?php echo $model->firstName . ' ' . $model->secondName . ' ' . $model->lastName ; ?></h3>
<p>Вы отправили запрос на регистраци кабинета оптового клиента. Администрация магазина в кратчайшие сроки расмотрит вашу заявку, Вы получите уведомление по почте</p>
<strong>Данные запроса</strong>
<p><b>E-mail: </b> <?php echo $model->email; ?></p>
<p><b>Логин: </b><?php echo $model->username; ?></p>
<p><b>Адрес: </b><?php echo $model->address; ?></p>
<p><b>Телефон: </b><?php echo $model->phone; ?></p>
<b>Дата запроса:</b> <?php echo date('d-m-Y'); ?>
