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
            if($task['category'] === $project){
            $count = $count + 1;
            }
        }
            return $count;
    }
?>
