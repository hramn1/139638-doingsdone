<?php
require_once 'vendor/autoload.php';
require_once 'init.php';

 $transport = new Swift_SmtpTransport("phpdemo.ru", 25);
 $transport->setUsername("keks@phpdemo.ru");
 $transport->setPassword("htmlacademy");

 $mailer = new Swift_Mailer($transport);

 $logger = new Swift_Plugins_Loggers_ArrayLogger();
 $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

$sql = 'SELECT GROUP_CONCAT(CONCAT(name, " на ", DATE_FORMAT(expire_date, "%d.%m.%Y %H:%i:%s")) SEPARATOR "<li>") AS tasks, users.id, users.usr_name, users.email
        FROM tasks
        JOIN users ON tasks.user_id = users.id
        WHERE expire_date >= DATE_FORMAT(NOW(), "%Y-%m-%d 00:00:00")
        AND expire_date <= DATE_FORMAT(NOW(), "%Y-%m-%d 23:59:59")
        AND status = 0
        GROUP BY users.id';
        $data = [];
        $tasks = resultArray($link, $sql, $data);
        var_dump($tasks);
        if ($tasks !== []) {
        foreach ($tasks as $task) {
        $user_name = $task['usr_name'];
        $user_task = $task['tasks'];
        $recipients[$task['email']] = $task['usr_name'];
         $message = new Swift_Message();
         $message->setSubject("Напоминалка");
         $message->setFrom(['keks@phpdemo.ru' => 'doingsdone']);
         $message->setBcc($recipients);

             $msg_content = include_template('task_email.php',
             ['user_task' => $user_task,
             'user_name' => $user_name
             ]);

             $message->setBody($msg_content, 'text/html');
             $result = $mailer->send($message);

        }

         if ($result) {
             print("Рассылка успешно отправлена");
         }
         else {
             print("Не удалось отправить рассылку: " . $logger->dump());
         }
}


