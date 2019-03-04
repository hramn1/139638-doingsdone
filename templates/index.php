<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="get">
    <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/<?php if (!empty($id)) : ?>?id=<?= $id; ?><?php endif; ?>" class="tasks-switch__item <?php if($time === 0) { print('tasks-switch__item--active'); }?>">Все задачи</a>
        <a href="/?<?php if (!empty($id)) : ?>id=<?= $id; ?>&<?php endif; ?>time=today" class="tasks-switch__item <?php if($time === 'today') { print('tasks-switch__item--active'); }?>">Повестка дня</a>
        <a href="/?<?php if (!empty($id)) : ?>id=<?= $id; ?>&<?php endif; ?>time=tomorrow" class="tasks-switch__item <?php if($time === 'tomorrow') { print('tasks-switch__item--active'); }?>">Завтра</a>
        <a href="/?<?php if (!empty($id)) : ?>id=<?= $id; ?>&<?php endif; ?>time=expired" class="tasks-switch__item <?php if($time === 'expired') { print('tasks-switch__item--active'); }?>">Просроченные</a>
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
    <tr class="tasks__item task <?php if($task['status']) { print ('task--completed'); }; if (isExpire($task['expire_date'])) {echo  (' task--important'); };?>" data-category = '<?= strip_tags($task['project_id'])  ?>' >
        <td class="task__select">
            <label class="checkbox task__checkbox">
                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="<?= strip_tags($task['id']) ?>">
                <span class="checkbox__text"><?= strip_tags($task['name']) ?></span>
            </label>
        </td>
        <td class="task__file">
          <?php if ($task['file']):  ?>
            <a class="download-link" href="<?= 'uploads/' . $task['file']; ?>">Файл</a>
          <?php endif; ?>
</td>
        <td class="task__date"><?= strip_tags($task['сreate_date'])  ?></td>
    </tr>
     <?php } ?>
    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
</table>
