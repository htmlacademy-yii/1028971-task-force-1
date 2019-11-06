CREATE DATABASE IF NOT EXISTS task_force
    DEFAULT CHARACTER SET 'utf8'
    DEFAULT COLLATE 'utf8_general_ci';

USE task_force;

CREATE TABLE IF NOT EXISTS users
(
    user_id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_name              VARCHAR(128) NOT NULL,
    user_reg_date          DATETIME     NOT NULL,
    user_birthday          DATE,
    user_email             VARCHAR(128) NOT NULL UNIQUE,
    user_password          VARCHAR(255) NOT NULL,
    user_avatar            VARCHAR(512),
    user_last_activity     DATETIME NOT NULL,
    user_portfolio         VARCHAR(512),
    user_info              VARCHAR(512),
    user_phone             VARCHAR(128),
    user_skype             VARCHAR(128),
    user_other_contacts    VARCHAR(128),
    user_location          INT NOT NULL,
    user_specialization    VARCHAR(128) NULL,
    user_notify            VARCHAR(128),
    PRIMARY KEY (user_id),
    FOREIGN KEY (user_location) REFERENCES locations(location_id),
    FOREIGN KEY (user_specialization) REFERENCES categories(category_id)
);

CREATE TABLE IF NOT EXISTS task
(
    task_id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
    task_name              VARCHAR(128) NOT NULL,
    task_description       VARCHAR(512) NOT NULL,
    task_category          INT UNSIGNED NOT NULL,
    task_author            INT UNSIGNED NOT NULL,
    task_executor          INT DEFAULT NULL,
    task_files             VARCHAR(512) DEFAULT '',
    task_user_location     INT DEFAULT 0,
    task_creation_date     DATETIME NOT NULL,
    task_end_date          DATETIME,
    task_status            INT DEFAULT 1,
    task_budget            INT UNSIGNED,
    PRIMARY KEY (task_id),
    FOREIGN KEY (task_category) REFERENCES categories(category_id),
    FOREIGN KEY (task_author) REFERENCES users(user_id),
    FOREIGN KEY (task_executor) REFERENCES users(user_id),
    FOREIGN KEY (task_user_location) REFERENCES locations(location_id),
    FOREIGN KEY (task_status) REFERENCES statuses(status_id)

);

CREATE TABLE IF NOT EXISTS categories
(
    category_id    TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_name  VARCHAR(128),
    PRIMARY KEY (category_id)
);



CREATE TABLE IF NOT EXISTS statuses
(
    status_id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    status_name    VARCHAR(20) NOT NULL,
    PRIMARY KEY (status_id)
);



CREATE FULLTEXT INDEX tasks_search ON task (task_name, task_description);

--todo:
-- создать таблицу локации
-- создать сообщения
-- создать отзывы
-- создать отклики
-- таблица уведомления - нужна ли? связь с юзером - дополнительные колонки в таблице юзеров
-- нужна ли колонка роль у юзера?
