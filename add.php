<?php
require_once 'functions.php';
    $link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
    mysqli_set_charset($link, "utf8");
if (!$link) {
    $error = mysqli_connect_error();
}
    //$projects = resultArray($link, 'SELECT * FROM projects');
    $sql = 'SELECT * FROM projects';
        $result = mysqli_query($link, $sql);

        if ($result) {
            $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $content = include_template('add-project.php', ['projects' => $projects]);
    }
var_dump($projects);

//  $layout_content = include_template('layout.php', [
//        'tasks' => $tasks,
//        'user' => $user,
//        'projects' => $projects,
//  			'main' => $content,
//  			'title' => 'Дела в порядке'
//  			]);

  echo $content;

