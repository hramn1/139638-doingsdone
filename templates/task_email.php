<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h1>Уведомление от сервиса «Дела в порядке»</h1>
<p>Уважаемый, <?= $user_name; ?>. У вас запланированы задачи:</p>
<table>
    <thead>
    <tr>
        <th>Номер</th>
        <th>Название задачи</th>
        <th>Время задачи</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $i => $task): ?>
        <tr>
            <td><?=$i+1;?></td>
            <td><?= $task['name']; ?></td>
            <td><?= $task['expire_date'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
