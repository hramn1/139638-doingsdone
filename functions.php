<?php
require("mysql_helper.php");
//$show_complete_tasks = rand(0, 1);
if ((isset($_GET['show_completed'])) ){
$show_completed = (int) $_GET['show_completed'];
 if ( $show_completed === 1) {
    $show_complete_tasks =  1;
    }
    else{
        $show_complete_tasks =  0;
    }
  }
else {
        $show_complete_tasks =  0;
}


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

function resultArray ($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
    return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    else {
    return false;
    }
}
function check_date_format($date) {
    $result = false;
    $regexp = '/(\d{2})\.(\d{2})\.(\d{4})/m';
    if (preg_match($regexp, $date, $parts) && count($parts) == 4) {
        $result = checkdate($parts[2], $parts[1], $parts[3]);
    }
    return $result;
}
?>
