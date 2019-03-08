<?php
require("mysql_helper.php");
/**
* Функция для подключения шаблона
*
* @param $name string название шаблона
* @param $data array данные для передачи в шаблон
* @return $result Шаблон
*/
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}
/**
 * Считает количество задач в проекте
 * @param $tasks_list array Список задач
 * @param $name_project integer id проекта
 *
 * @return $count_name_project integer Количество задач
 */
function countTask ($tasks, $project){
        $count = 0;
        foreach ($tasks as $task) {
            if($task['project_id'] === $project){
            $count = $count + 1;
            }
        }
            return $count;
    }
function isExpire($dateString) {
    if (!(bool)strtotime($dateString)){
        return false;
    }
$date =strtotime('+1 day', strtotime($dateString));
    if($date < time()){
        return true;
    }
        return false;
}
/**
* Функция для защииты от sql инъекций
*
* @param $link данные для соединения
* @param $sql обращение к БД
* @param $data массив из значений для $sql
* @return возвращает либо строки из БД в виде массива либо в случае неудачи булевое значение false
*/
function resultArray ($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
    return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    return false;
}
/**
* Функция для проверки формата даты
*
* @param $date Дата
* @return возвращает булевое значение true, если дата корректная, дибо false если некоректная
*/
function check_date_format($date) {
    $result = false;
    $regexp = '/(\d{2})\.(\d{2})\.(\d{4})/m';
    if (preg_match($regexp, $date, $parts) && count($parts) === 4) {
        $result = checkdate($parts[2], $parts[1], $parts[3]);
    }
    return $result;
}
/**
* Функция выполняет загрузку шаблона если пользователь отсутвует
*
* @param $user пользователь
*/
function control_user($user){
    if(empty($user)){
        $page_content = include_template('guests.php', [
            ]);
        print($page_content);
        exit();
    }
}
?>
