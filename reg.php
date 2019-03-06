<?php
require_once('init.php');
$data = [];
$errors = [];
$res = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Экранируем спецсимволы
    if (!empty($_POST)) {
        $data = $_POST;
        foreach ($data as $key => $value) {
            // Удаляет пробелы из начала и конца строки
            $data[$key] = trim($value);
        }
    }
    $required = ['email', 'password', 'name'];
    // Обязательные поля
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }
    // Проверка полей
    if (empty($errors['name']) and strlen($data['name']) > 128) {
        $errors['name'] = 'Имя не может быть длиннее 128 символов';
    }
    if (empty($errors['email']) and strlen($data['email']) > 128) {
        $errors['email'] = 'E-mail не может быть длиннее 128 символов';
    }
    if (empty($errors['password']) and strlen($data['password']) > 128) {
        $errors['password'] = 'Пароль не может быть длиннее 64 символов';
    }
    // Проверка email
    if (!empty($data['email'])) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'E-mail введён некорректно';
        }
        $dataSql = [$data['email']];
        $sql = 'SELECT id FROM users WHERE email = ?';
        $res = resultArray ($link, $sql, $dataSql );
        if ($res !==  []) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        }
    }
    // Пароль
    if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    if (empty($errors)) {
        $sql_user = 'INSERT INTO users (reg_dt, email, usr_name, usr_pass)
        VALUES (NOW(), ?, ?, ?)';
        $dataSql = [$data['email'],$data['name'],$password];
        $result_user = resultArray ($link, $sql_user, $dataSql );
            header("Location: /auth.php");
            exit();
    }
}
$layout_content = include_template('register.php', [
    'data' => $data,
    'errors' => $errors,
    'title' => 'Регистрация',
]);
print($layout_content);
