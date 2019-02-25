<?php
require_once 'init.php';
if (!empty($_POST)) {
    $task = $_POST;
    $task['name'] = strip_tags($task['name']);
    $task['name'] = trim($task['name']);
    // Обязательные поля
    if (empty($task['name'])) {
        $errors['name'] = 'Это поле надо заполнить';
    }
    if (empty($errors)) {

        $sql = 'INSERT INTO projects (name, user_id)
        VALUES ( "' . $task['name'] .'",  ' . $user_id . ')';
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
 			'title' => 'Добавление проекта'
 			]);

  echo  $layout_content;
