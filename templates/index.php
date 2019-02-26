<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" <?php if($show_complete_tasks === 1){print('checked');  } ?>  type="checkbox">

        <span class="checkbox__text">Показывать выполненные </span>
    </label>
</div>

<table class="tasks">
<?php foreach ($tasks_project as $task) { ?>
 <?php if ($show_complete_tasks === 0 and $task['status']) { continue; } ?>
    <tr class="tasks__item task <?php if($task['status']) { print ('task--completed'); }; if (isExpire($task['expire_date'])) {echo  ('task--important'); };?>" data-category = '<?= strip_tags($task['project_id'])  ?>' >
        <td class="task__select">
            <label class="checkbox task__checkbox">
                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                <span class="checkbox__text"><?= strip_tags($task['name']) ?></span>
            </label>
        </td>
        <td class="task__file">
          <?php if ($task['file']): ?>
            <a class="download-link" href="<?= 'uploads/' . $task['file']; ?>">Файл</a>
          <?php endif; ?>
</td>
        <td class="task__date"><?= strip_tags($task['сreate_date'])  ?></td>
    </tr>
     <?php } ?>
    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
</table>
