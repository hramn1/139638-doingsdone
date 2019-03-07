<?php
//require_once 'vendor/autoload.php';
require_once 'init.php';

// $transport = new Swift_SmtpTransport("phpdemo.ru", 25);
// $transport->setUsername("keks@phpdemo.ru");
// $transport->setPassword("htmlacademy");
//
// $mailer = new Swift_Mailer($transport);
//
// $logger = new Swift_Plugins_Loggers_ArrayLogger();
// $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

$sql = 'SELECT name, expire_date, user_id FROM tasks WHERE expire_date IN (ADDDATE(CURDATE(),INTERVAL 1 DAY), NOW())';
$data = [];
$tasks = resultArray($link, $sql, $data);

if ($tasks !== []) {
    $sql = "SELECT id, usr_name, email FROM users";
    $users = resultArray($link, $sql, []);
    $recipients = [];
    if ($users != []) {
      foreach ($tasks as $task) {
        foreach($users as $user){
          if($task['user_id'] === $user['id']){
            $recipients[$user['email']] = $user['usr_name'];
            print( $user['usr_name']);
          }
        }
      }
      var_dump( $recipients);
        // $message = new Swift_Message();
        // $message->setSubject("Напоминалка");
        // $message->setFrom(['keks@phpdemo.ru' => 'doingsdone']);
        // $message->setBcc($recipients);
        //
        // $msg_content = include_template('task_email.php', ['tasks' => $tasks]);
        // $message->setBody($msg_content, 'text/html');
        //
        // $result = $mailer->send($message);
        //
        // if ($result) {
        //     print("Рассылка успешно отправлена");
        // }
        // else {
        //     print("Не удалось отправить рассылку: " . $logger->dump());
        // }
    }
}
