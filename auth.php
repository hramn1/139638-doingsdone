<?php
require_once('functions.php');
$data = [];
$errors = [];
$link = mysqli_connect('localhost', 'doing', '300685', 'doingsdone') or die (mysqli_connect_error($link));
mysqli_set_charset($link, "utf8");
$layout_content = include_template('auth.php', [
    'data' => $data,
    'errors' => $errors,
    'title' => 'Регистрация',
]);
print($layout_content);
