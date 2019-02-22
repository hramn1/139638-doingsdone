INSERT INTO users (email, usr_name, usr_pass)
VALUES
('goga@ya.ru', 'Вася', '$2y$10$wyVXbp2PY6rTKCIKPqBn0O.CJswQWcmV/S42Fx8DC6RfgIuFJDW9q'),
('goga1@ya.ru', 'Петя', '$2y$10$kDTzlf.vpBQ60Ku3Qe5xqekoTEqElXjWG75Az41oCgYHtVEnHA2wa');

INSERT INTO  (name, user_id)
VALUES
('Входящие','1'),
('Учеба','2'),
('Работа','1'),
('Домашние дела','2'),
('Авто','1');

INSERT INTO tasks (сreate_date, complete_date, status, name, file, expire_date, user_id, project_id)
VALUES
('2019-02-20', '2019-02-23', '0', 'Собеседование в IT компании', NULL, '2019-04-20', 1, 3),
('2019-02-20', '2019-02-22', '0', 'Выполнить тестовое задание', 'task.txt', '2019-03-20', 1, 3),
('2019-02-20', '2019-02-26', '1', 'Сделать задание первого раздела', NULL, '2019-04-20', 2, 2),
('2019-02-20', '2019-02-23', '0', 'Встреча с другом', NULL, '22.12.2019', 2, 1),
('2019-02-20', '2019-03-20', '0', 'Купить корм для кота', NULL, NULL, 1, 4),
('2019-02-20', '2019-04-20', '0', 'Заказать пиццу', NULL, NULL, 2, 4),
('2019-02-20', '2019-04-20', '0', 'Заказать пиццу для кота', NULL, NULL, 1, 1);
--получить список из всех проектов для одного пользователя
SELECT * FROM projects
WHERE user_id = '2';
--получить список из всех задач для одного проекта
SELECT t.name, t.id, u.usr_name FROM tasks t
JOIN  users u
ON t.user_id = u.id
WHERE project_id = '4';
--пометить задачу как выполненную
UPDATE tasks SET status = '1'
WHERE (id = 4);
--обновить название задачи по её идентификатору
UPDATE tasks SET name = 'Собеседование в Макдональдс'
WHERE id = 1 ;
