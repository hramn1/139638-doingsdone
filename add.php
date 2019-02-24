<?php
require_once 'functions.php';
$link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
mysqli_set_charset($link, "utf8");
$user_id = 1;
if (!empty($_POST)) {
    $task = $_POST;
    foreach ($task as $key => $value) {
        $task[$key] = trim($value);
    }
    // Обязательные поля
    if (empty($task['name'])) {
        $errors['name'] = 'Это поле надо заполнить';
    }
    // Проверка полей
    if (empty($errors['name']) and strlen($task['name']) > 128) {
        $errors['name'] = 'Название не может быть длиннее 128 символов';
    }
    if (empty($task['date'])) {
        $deadline = 'null';
    }
    elseif (empty($errors['date']) and strtotime($task['date']) < strtotime(date('Y-m-d'))) {
        $errors['date'] = 'Дата не может быть раньше текущей';
    }
    else {
        $deadline = '"' . $task['date'] . '"';
    }
    // Загрузка файла
    if (is_uploaded_file($_FILES['preview']['tmp_name'])) {
        $tmp_name = $_FILES['preview']['tmp_name'];
        $path = uniqid();
        move_uploaded_file($tmp_name, 'uploads/' . $path);
        $file = '"' . $path .'"';
    }
    else {
        $file = 'null';
    }
    if (empty($errors)) {
        $task_name = $task['name'];
        $project_name = 'null';
        if (!empty($task['project'])) {
            $project_name = $task['project'];
        }

        $sql = 'INSERT INTO tasks (сreate_date, complete_date, status, name, file, expire_date, user_id, project_id)
        VALUES (NOW(), NULL, 0, "' . $task_name .'", ' . $file . ' , ' . $deadline . ', ' . $user_id . ', ' . $project_name . ')';
        $result_task = mysqli_query($link, $sql);
        if ($result_task) {
            header("Location: /");
            exit();
        }
    }
}
if (!$link) {
    $error = mysqli_connect_error();
}
    $projects = resultArray($link, 'SELECT * FROM projects');
    $tasks = resultArray($link, 'SELECT * FROM tasks');



    $content = include_template('add-project.php', [
    'projects' => $projects,
    'errors' => $errors
    ]);


 $layout_content = include_template('layout.php', [
       'tasks' => $tasks,
       'projects' => $projects,
 			'main' => $content,
 			'title' => 'Добавление задачи'
 			]);

  echo  $layout_content;
