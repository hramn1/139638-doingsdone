INSERT INTO users SET email = 'goga@ya.ru', usr_name = 'Вася', usr_pass = '$2y$10$wyVXbp2PY6rTKCIKPqBn0O.CJswQWcmV/S42Fx8DC6RfgIuFJDW9q';
INSERT INTO users  SET email = 'goga1@ya.ru', usr_name = 'Петя', usr_pass = '$2y$10$kDTzlf.vpBQ60Ku3Qe5xqekoTEqElXjWG75Az41oCgYHtVEnHA2wa';

INSERT INTO projects SET name = 'Входящие', user_id = '1';
INSERT INTO projects SET name = 'Учеба', user_id = '2';
INSERT INTO projects SET name = 'Работа', user_id = '1';
INSERT INTO projects SET name = 'Домашние дела', user_id = '2';
INSERT INTO projects SET name = 'Авто', user_id = '1';

INSERT INTO tasks (сreate_date, complete_date, status, name, file, expire_date, user_id, project_id)
VALUES
('12-02-2019', '12-03-2019', '0', 'Собеседование в IT компании', NULL, '01.02.2019', 1, 3),
('12-02-2019', '22-03-2019', '0', 'Выполнить тестовое задание', 'task.txt', '25.12.2019', 1, 3),
('12-02-2019', '23-02-2019', '1', 'Сделать задание первого раздела', NULL, '22.12.2019', 2, 2),
('12-02-2019', '13-06-2019', '0', 'Встреча с другом', NULL, '22.12.2019', 2, 1),
('12-02-2019', '14-04-2019', '0', 'Купить корм для кота', NULL, NULL, 1, 4),
('12-02-2019', '15-09-2019', '0', 'Заказать пиццу', NULL, NULL, 2, 4);
--получить список из всех проектов для одного пользователя
SELECT * FROM projects
WHERE user_id = '2';
--получить список из всех задач для одного проекта
SELECT t.name, u.usr_name FROM tasks t
JOIN  users u
ON t.user_id = u.id
WHERE project_id = '4';
--пометить задачу как выполненную
UPDATE tasks SET status = '1'
WHERE (project_id = 4);
--обновить название задачи по её идентификатору
UPDATE tasks SET name = 'Собеседование в Макдональдс'
WHERE id = 1 ;
