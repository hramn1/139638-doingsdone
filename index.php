<?php
  date_default_timezone_set("Europe/Moscow");
  require('data.php');
  require('functions.php');
  $link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
  mysqli_set_charset($link, "utf8");
  $sql ='SELECT usr_name FROM users WHERE id=1';
  $user = mysqli_fetch_assoc(reusltArray($link, $sql));
  $sql_projects = 'SELECT * FROM projects WHERE user_id=1';
  $result_projects = mysqli_query($link, $sql_projects) or die (mysqli_error($link));
  $projects_list = mysqli_fetch_all($result_projects, MYSQLI_ASSOC);
  $sql_tasks = 'SELECT * FROM tasks WHERE user_id=1';
  $result_tasks = mysqli_query($link, $sql_tasks) or die (mysqli_error($link));
  $tasks_list = mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);


  $page_content = include_template('index.php', ['tasks' => $tasks_list,
  			'show_complete_tasks' => $show_complete_tasks
  			]);
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks_list,
        'user' => $user,
        'projects' => $projects_list,
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo $layout_content;
