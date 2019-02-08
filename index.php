<?php
  require('data.php');
  require('functions.php');

  $page_content = include_template('index.php', ['tasks' => $tasks,
  			'show_complete_tasks' => $show_complete_tasks
  			]);
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks,
        'projects' => $projects, 
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo $layout_content;
