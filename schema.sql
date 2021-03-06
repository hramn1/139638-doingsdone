CREATE DATABASE doingsdone
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  USE doingsdone;
CREATE TABLE projects (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name CHAR(64),
 user_id INT
);
CREATE TABLE tasks (
 id INT AUTO_INCREMENT PRIMARY KEY,
 сreate_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 complete_date TIMESTAMP,
 status INT DEFAULT 0 CHECK (status=0 and status=1),
 name CHAR(64) UNIQUE,
 file CHAR(128),
 expire_date TIMESTAMP,
 user_id INT,
 project_id INT
);
CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 reg_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 email CHAR(64) NOT NULL UNIQUE,
 usr_name CHAR(128),
 usr_pass CHAR(64)
);
 CREATE UNIQUE INDEX t_name ON tasks(name);
 CREATE UNIQUE INDEX c_email ON users(email);
 CREATE FULLTEXT INDEX tasks_ft_search ON tasks(name);
