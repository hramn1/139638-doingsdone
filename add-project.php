<?php
require_once 'init.php';
$errors = [];
control_user($user);
if (!empty($_POST)) {
    $task = $_POST;
    $task['name'] = strip_tags($task['name']);
    $task['name'] = trim($task['name']);
    // Обязательные поля
    if (empty($task['name'])) {
        $errors['name'] = 'Это поле надо заполнить';
    }
    if (empty($errors)) {
      $data = [$user_id,$task['name']];
      $sql = 'SELECT name FROM projects WHERE user_id = ? AND name =?';
      $result_task = resultArray($link, $sql, $data);
      if ($result_task !== []) {
          $errors['name'] = 'Такой проект уже есть';
      } else {
        $sql = 'INSERT INTO projects (name, user_id)
        VALUES (?,  ?)';
        $data = [$task['name'],$user_id];
        $result_task = resultArray($link, $sql, $data);
        header("Refresh:0");
        }
    }
}
if (!$link) {
    $error = mysqli_connect_error();
}
    $content = include_template('add-project.php', [
    'projects' => $projects,
    'errors' => $errors
    ]);

 $layout_content = include_template('layout.php', [
    'tasks' => $tasks,
    'projects' => $projects,
    'user' => $user,
    'main' => $content,
    'title' => 'Добавление проекта'
        ]);
  echo  $layout_content;
