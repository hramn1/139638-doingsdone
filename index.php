<?php
  date_default_timezone_set("Europe/Moscow");
  require('data.php');
  require('functions.php');
  $link = mysqli_connect('localhost', 'root', '300685', 'doingsdone');
   mysqli_set_charset($link, "utf8");
  if ($link == true) {
   print('гуд');
  } else {
   print ('ошибка ' . mysqli_connect_error());
  };
  $sql_name ='SELECT usr_name FROM users WHERE id=1';
  $result_name = mysqli_query($link, $sql_name) or die (mysqli_error($link));
  $user_name = mysqli_fetch_assoc($result_name);
  var_dump($user_name);
  print($user_name["usr_name"]);
  $page_content = include_template('index.php', ['tasks' => $tasks,
  			'show_complete_tasks' => $show_complete_tasks
  			]);
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks,
        'user_name' => $user_name,
        'projects' => $projects, 
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo $layout_content;
