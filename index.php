<?php
  require('data.php');
  require_once 'init.php';

    if(!isset($_SESSION['user'])){
        $page_content = include_template('guests.php', [
            ]);
          print($page_content);
          exit();
    }
    if ((isset($_GET['task_id'])) ){
        $task_id = (int) $_GET['task_id'];
        $data = [$task_id];
        $tasks = resultArray($link, 'UPDATE tasks SET status = 1 WHERE id = ?', $data );
                header("Location: /");
                exit();

    }

      if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $data = [$id, $user_id];
        $sql = 'SELECT * FROM tasks WHERE project_id = ? AND user_id = ?';
        $tasks_project = resultArray($link, $sql , $data );
      }
      else {
        $tasks_project = $tasks;
        $sql = 'SELECT * FROM tasks WHERE user_id = ?';
        $data = [$user_id];
      }
    $time = 0;
    if (isset($_GET['time'])) {
    $time = $_GET['time'];
    if ($time === 'today'){
        $sql = $sql . ' AND expire_date = CURDATE()';
    }
    elseif($time === 'tomorrow'){
        $sql = $sql . ' AND expire_date = ADDDATE(CURDATE(),INTERVAL 1 DAY)';
    }
    elseif($time === 'expired'){
        $sql = $sql . ' AND expire_date < CURDATE()';
    }
    $tasks_project = resultArray($link, $sql , $data );
    }

    if($tasks_project){
      $page_content = include_template('index.php', [
            'tasks' => $tasks,
            'id' => $id,
            'time' => $time,
            'show_complete_tasks' => $show_complete_tasks,
            'tasks_project' => $tasks_project
                ]);
          }
          else {
            $page_content = 'Задачи не найлены';
      }
      $layout_content = include_template('layout.php', [
            'tasks' => $tasks,
            'user' => $user,
            'projects' => $projects,
                'main' => $page_content,
                'title' => 'Дела в порядке'
                ]);
  echo $layout_content;
