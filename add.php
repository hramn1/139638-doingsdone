<?php
require_once 'functions.php';
$link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
mysqli_set_charset($link, "utf8");
$user_id = 1;
$projects = resultArray($link, 'SELECT * FROM projects');
$id_project = [];
foreach ($projects as $project) {
   array_push($id_project,$project['id']);
}
$tasks = resultArray($link, 'SELECT * FROM tasks');
if (!empty($_POST)) {
    $task = $_POST;
    foreach ($task as $key => $value) {
        $task[$key] = trim($value);
    }
    $task['name'] = strip_tags($task['name']);
    // Обязательные поля
    if (empty($task['name'])) {
        $errors['name'] = 'Это поле надо заполнить';
    }
    // Проверка полей
    if (empty($errors['name']) and strlen($task['name']) > 128) {
        $errors['name'] = 'Название не может быть длиннее 128 символов';
    }
    $task_name = $task['name'];
    $project_id = 'null';
    if (!empty($task['project'])) {
        $project_id = $task['project'];
    }
    if (!in_array($_POST['project'], $id_project)) {
      $errors['project'] = 'Выберите одну из предложенных категорий';
    }
    if (empty($task['date'])) {
        $deadline = 'null';
    }
    elseif (empty($errors['date']) and strtotime($task['date']) < strtotime(date('Y-m-d'))) {
        $errors['date'] = 'Дата не может быть раньше текущей';
    }
    elseif (!check_date_format($task['date'])) {
      $errors['date'] = 'Неправильный формат даты';
    }
    else {
        $deadline = '"' . $task['date'] . '"';
    }
    // Загрузка файла
    if (is_uploaded_file($_FILES['preview']['tmp_name'])) {
        $tmp_name = $_FILES['preview']['tmp_name'];
        $file_size =  $_FILES['preview']['size'];
        $path = uniqid();
        $file = '"' . $path .'"';
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type === "application/javascript") {
        $errors['file'] = 'Загрузите файл в правильном формате';
        }
        if($file_size > 300000){
          $errors['file'] = 'Слишком большой';
        }
        else {
          move_uploaded_file($tmp_name, '/' . $path);
        }
    }
    else {
        $file = 'null';
    }
    if (empty($errors)) {

        $sql = 'INSERT INTO tasks (сreate_date, complete_date, status, name, file, expire_date, user_id, project_id)
        VALUES (NOW(), NULL, 0, "' . $task_name .'", ' . $file . ' , ' . $deadline . ', ' . $user_id . ', ' . $project_id . ')';
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

    $content = include_template('add-task.php', [
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
