DROP DATABASE IF EXISTS task_force

CREATE DATABASE IF NOT EXISTS task_force
    DEFAULT CHARACTER SET 'utf8'
    DEFAULT COLLATE 'utf8_general_ci';

USE task_force;

CREATE TABLE IF NOT EXISTS city
(
    id         INT NOT NULL AUTO_INCREMENT,
    city       VARCHAR(100) NOT NULL,
    latitude   INT NOT NULL,
    longitude  INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS user
(
    id                INT NOT NULL AUTO_INCREMENT,
    name              VARCHAR(128) NOT NULL,
    reg_date          DATETIME     NOT NULL,
    birthday          DATE,
    email             VARCHAR(128) NOT NULL UNIQUE,
    password          VARCHAR(255) NOT NULL,
    avatar            VARCHAR(512),
    last_activity     DATETIME NOT NULL,
    portfolio         VARCHAR(512),
    info              VARCHAR(512),
    phone             INT,
    skype             VARCHAR(128),
    other_contacts    VARCHAR(128),
    city_id           INT NOT NULL,
    hide_contacts     TINYINT(1) NOT NULL DEFAULT 0,
    hide_profile      TINYINT(1) NOT NULL DEFAULT 0,
    is_executor       BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (city_id) REFERENCES city(id)
);

CREATE TABLE IF NOT EXISTS category
(
    id    TINYINT NOT NULL AUTO_INCREMENT,
    name  VARCHAR(128),
    icon  VARCHAR(20),
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS status
(
    id      INT NOT NULL AUTO_INCREMENT,
    name    VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS task
(
    id                INT NOT NULL AUTO_INCREMENT,
    name              VARCHAR(128) NOT NULL,
    description       TEXT,
    category_id       TINYINT NOT NULL,
    author_id         INT NOT NULL,
    files             VARCHAR(512) DEFAULT '',
    latitude          VARCHAR,
    longitude         VARCHAR,
    address           TEXT,
    creation_date     DATETIME NOT NULL,
    end_date          DATETIME,
    status_id         INT DEFAULT 1,
    budget            INT UNSIGNED,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (author_id) REFERENCES user(id),
    FOREIGN KEY (status_id) REFERENCES status(id)

);

CREATE TABLE IF NOT EXISTS work_task
(
  id                   INT NOT NULL AUTO_INCREMENT,
  task_id              INT NOT NULL,
  executor_id          INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (task_id) REFERENCES task(id),
  FOREIGN KEY (executor_id) REFERENCES user(id)
);



CREATE TABLE IF NOT EXISTS feedback
(
    id           INT NOT NULL AUTO_INCREMENT,
    executor_id  INT,
    customer_id  INT,
    comment      TEXT,
    rate         TINYINT,
    date         DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (executor_id) REFERENCES user(id),
    FOREIGN KEY (customer_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS bookmarked
(
    id          INT NOT NULL AUTO_INCREMENT,
    user_id                INT,
    bookmarked_user_id     INT,
    is_bookmarked     BOOLEAN DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS message
(
    id            INT NOT NULL AUTO_INCREMENT,
    time          DATETIME,
    sender_id     INT NOT NULL,
    recipient_id  INT NOT NULL,
    text          TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (sender_id) REFERENCES user(id),
    FOREIGN KEY (recipient_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS response
(
    id            INT NOT NULL AUTO_INCREMENT,
    time          DATETIME NOT NULL,
    executor_id   INT NOT NULL,
    task_id       INT NOT NULL,
    comment       TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (task_id) REFERENCES task(id),
    FOREIGN KEY (executor_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS notification
(
    id               INT NOT NULL AUTO_INCREMENT,
    name             VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS user_alerts
(
    id                     INT NOT NULL AUTO_INCREMENT,
    alert_id               INT NOT NULL,
    user_id                INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (alert_id) REFERENCES notification(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS user_portfolio
(
    id                INT NOT NULL AUTO_INCREMENT,
    photo_path        VARCHAR(512) NOT NULL,
    user_id           INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE user_specialization (
	id              INT(11) NOT NULL AUTO_INCREMENT,
	user_id         INT(11) NOT NULL,
	category_id     TINYINT NOT NULL DEFAULT '0',
	PRIMARY KEY (id),
	FOREIGN KEY (category_id) REFERENCES category(id),
	FOREIGN KEY (user_id) REFERENCES user(id)
);



CREATE FULLTEXT INDEX tasks_search ON task(name, description);


