<?php
require_once('init.php');
$data = [];
$errors = [];
    if (!empty($_POST)) {
        $data = $_POST;
        foreach ($data as $key => $value) {
            // Удаляет пробелы из начала и конца строки
            $data[$key] = trim($value);
        }
    $required = ['email', 'password'];
    // Обязательные поля
    foreach ($required as $key) {


            if (!empty($data[$key])) {
                $data[$key] = trim($data[$key]);
            }
            if (empty($data[$key])) {
                $errors[$key] = 'Это поле надо заполнить';
            }
        }
        // Проверка полей
        if (empty($errors['email']) and (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) or strlen($data['email']) > 128)) {
            $errors['email'] = 'E-mail введён некорректно';
        }
        if (empty($errors)) {
            $email = $data['email'];
            $sql = 'SELECT * FROM users WHERE email = "' . $email . '"';
            $res = mysqli_query($link, $sql);
            $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
            if ($user === null) {
                $errors['email'] = 'Такой пользователь не найден';
            }
            elseif (password_verify($data['password'], $user['usr_pass'])) {
                $_SESSION['user'] = $user;
                header("Location: /");
                   exit();
            }
            else {
                $errors['password'] = 'Неверный пароль';
             }
        }
    }
    $page_content = include_template('auth.php', [
        'data' => $data,
        'errors' => $errors
    ]);
    $layout_content = include_template('layout.php', [
        'main' => $page_content,
               'tasks' => $tasks,
               'projects' => $projects,
        'title' => 'Вход на сайт',
        'tasks_active' => '',
    ]);
    print($layout_content);
