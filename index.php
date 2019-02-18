<?php
  date_default_timezone_set("Europe/Moscow");
  require('data.php');
  require('functions.php');
  $link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
  mysqli_set_charset($link, "utf8");
  $sql ='SELECT usr_name FROM users WHERE id=1';
  $user = mysqli_fetch_assoc(resultArray($link, $sql));
  $sql = 'SELECT * FROM projects WHERE user_id=1';
  $projects = mysqli_fetch_all(resultArray($link, $sql),MYSQLI_ASSOC);
  $sql = 'SELECT * FROM tasks WHERE user_id=1';
  $tasks = mysqli_fetch_all(resultArray($link, $sql),MYSQLI_ASSOC);

  $page_content = include_template('index.php', ['tasks' => $tasks,
  			'show_complete_tasks' => $show_complete_tasks
  			]);
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks,
        'user' => $user,
        'projects' => $projects,
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo $layout_content;
