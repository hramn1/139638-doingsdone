<?php
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
?>
