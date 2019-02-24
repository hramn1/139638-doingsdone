<?php
  date_default_timezone_set("Europe/Moscow");
  require('data.php');
  require('functions.php');
  $link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
  mysqli_set_charset($link, "utf8");
  $data =[1];
  $user = resultArray($link, 'SELECT usr_name FROM users WHERE id = ?',$data);
  $projects = resultArray($link, 'SELECT * FROM projects WHERE user_id = ?',$data);
  $tasks = resultArray($link, 'SELECT * FROM tasks WHERE user_id = ?',$data);
    if(!isset($_SESSION['user'])){
     $page_content = include_template('guests.php', [
        ]);
  print($page_content);
  exit();
}
  if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $data = [$id, 1];
    $tasks_project = resultArray($link, 'SELECT * FROM tasks WHERE project_id = ? AND user_id = ?', $data );
  }
  else {
    $tasks_project = $tasks;
}
if($tasks_project){
  $page_content = include_template('index.php', [
        'tasks' => $tasks,
  			'show_complete_tasks' => $show_complete_tasks,
        'tasks_project' => $tasks_project
  			]);
      }
      else {
        $page_content = 'ERROR 404';
  }
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks,
        'user' => $user,
        'projects' => $projects,
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo $layout_content;
