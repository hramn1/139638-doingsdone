<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'functions.php';
session_start();
date_default_timezone_set("Europe/Moscow");

if ((isset($_GET['show_completed'])) ){
    $show_completed = (int) $_GET['show_completed'];
    if ( $show_completed === 1) {
        $show_complete_tasks =  1;
    }
    else {
        $show_complete_tasks =  0;
    }
}
else {
    $show_complete_tasks =  0;
}
$link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
mysqli_set_charset($link, "utf8");

if (!empty($_SESSION['user'])){
    $user = $_SESSION['user'];
    }
else {
    $user = [];
    }
$user_id = !empty($user['id']) ? $user['id'] : '';
$id= $_GET['id'] ?? '';
$data = [$user_id];
  $projects = resultArray($link, 'SELECT * FROM projects WHERE user_id = ?',$data);
  $tasks = resultArray($link, 'SELECT * FROM tasks WHERE user_id = ?',$data);
?>
