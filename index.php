<?php
  require('functions.php');
  $show_complete_tasks = rand(0, 1);
  $tasks = [
          [
          'task' => 'Собеседование в IT компании',
          'date' => '01.12.2019',
          'category' => 'Работа',
          'complete' => false
          ],
          [
          'task' => 'Выполнить тестовое задание',
          'date' => '25.12.2019',
          'category' => 'Работа',
          'complete' => false
          ],
          [
          'task' => 'Сделать задание первого раздела',
          'date' => '21.12.2019',
          'category' => 'Учеба',
          'complete' => true
          ],
          [
          'task' => 'Встреча с другом',
          'date' => '22.12.2019',
          'category' => 'Входящие',
          'complete' => false
          ],
          [
          'task' => 'Купить корм для кота',
          'date' => 'Нет',
          'category' => 'Домашние дела',
          'complete' => false
          ],
          [
          'task' => 'Заказать пиццу',
          'date' => 'Нет',
          'category' => 'Домашние дела',
          'complete' => false
          ]
  ];
  $page_content = include_template('index.php', ['tasks' => $tasks,
  			'show_complete_tasks' => $show_complete_tasks
  			]);
  $layout_content = include_template('layout.php', [
        'tasks' => $tasks,
  			'main' => $page_content,
  			'title' => 'Дела в порядке'
  			]);
  echo($layout_content);

?>
