<?php
require_once 'functions.php';
session_start();
date_default_timezone_set("Europe/Moscow");
$link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
mysqli_set_charset($link, "utf8");

if (!empty($_SESSION['user'])){
$user = $_SESSION['user'];
}
else {
$user = [];
}
$user_id = !empty($user['id']) ? $user['id'] : '';
$data =[$user_id];
  $projects = resultArray($link, 'SELECT * FROM projects WHERE user_id = ?',$data);
  $tasks = resultArray($link, 'SELECT * FROM tasks WHERE user_id = ?',$data);

?>
