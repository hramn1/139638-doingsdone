<?php
  require_once 'init.php';
  control_user($user);
    if ((isset($_GET['task_id'])) ){
        $task_id = (int) $_GET['task_id'];
        $data = [$task_id];
        $statuses = resultArray($link, 'SELECT status FROM tasks WHERE id = ?', $data );
        $status = $statuses[0]['status'];
        if ($status === 0) {
        $tasks = resultArray($link, 'UPDATE tasks SET status = 1 WHERE id = ?', $data );
      } else {
        $tasks = resultArray($link, 'UPDATE tasks SET status = 0 WHERE id = ?', $data );
      }
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

    if(isset($_GET['search'])) {
        $search = trim($_GET['search']);
        $data = [$user_id, $search];
        if(!empty($search)){
        $sql =  'SELECT * FROM tasks WHERE user_id = ? AND  MATCH(name) AGAINST(? IN BOOLEAN MODE)  ';
        $tasks_project = resultArray($link, $sql , $data );
        }
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
