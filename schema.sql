CREATE DATABASE doingsdone
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  USE doingsdone;
CREATE TABLE projects (
 id INT AUTO_INCREMENT PRIMARY_KEY,
 name CHAR(64),
 user_id INT
);
CREATE TABLE tasks (
 id INT AUTO_INCREMENT PRIMARY_KEY,
 сreate_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 complete_date TIMESTAMP,
 status INT DEFAULT 0 CHECK (status=0 and status=1),
 name CHAR(64),
 file CHAR(256),
 expire_date TIMESTAMP,
 user_id INT,
 project_id INT
);
CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY_KEY,
 reg_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 email CHAR(64) NOT NULL,
 usr_name CHAR(128),
 usr_pass CHAR(64)
);
