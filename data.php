<?php
$show_complete_tasks = rand(0, 1);
$projects = ['Входящие', "Учеба", "Работа", "Домашние дела", "Авто" ];
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
?>
