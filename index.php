<?php
  date_default_timezone_set("Europe/Moscow");
  require('data.php');
  require('functions.php');
  $link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
  mysqli_set_charset($link, "utf8");
  $user = resultArray($link, 'SELECT usr_name FROM users WHERE id = ?',[1]);
  $projects = resultArray($link, 'SELECT * FROM projects WHERE user_id = ?',[1]);
  $tasks = resultArray($link, 'SELECT * FROM tasks WHERE user_id = ?',[1]);
  if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    foreach ($tasks as $key => $value) {
        if ($id == $value['id']) {
          print ($id);
          $tasks_project = resultArray($link, 'SELECT * FROM tasks WHERE project_id = ? AND user_id = ?', [$id, 1] );
        }
        else {
            http_response_code(404);
        }
    }
}
else {
  $tasks_project = $tasks;
}
  $page_content = include_template('index.php', [
        'tasks' => $tasks,
  			'show_complete_tasks' => $show_complete_tasks,
        'tasks_project' => $tasks_project
  			]);
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks,
        'user' => $user,
        'projects' => $projects,
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo $layout_content;
