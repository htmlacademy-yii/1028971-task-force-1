<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use src\import\Converter2;


$value_map = [
    'city' => 0,
    'latitude' => 1,
    'longitude' => 2
];

$sql = Converter2::getSqlFromCsv('data/cities.csv', $value_map, 'city');

Converter2::writeInSqlFile('data/sql/city.sql', $sql);

$value_map = [
    'email' => 0,
    'name' => 1,
    'password' => 2,
    'reg_date' => 3,
    'city_id' => function () {
        return rand(1, 1008);
    }
];

$sql = Converter2::getSqlFromCsv('data/users.csv', $value_map, 'user');


Converter2::writeInSqlFile('data/sql/user.sql', $sql);


$value_map = [
    'name' => 0,
    'icon' => 1
];

$sql = Converter2::getSqlFromCsv('data/categories.csv', $value_map, 'category');

Converter2::writeInSqlFile('data/sql/category.sql', $sql);


$value_map = [
    'name' => 0
];

$sql = Converter2::getSqlFromCsv('data/statuses.csv', $value_map, 'status');

Converter2::writeInSqlFile('data/sql/status.sql', $sql);


$value_map = [
    'creation_date' => 0,
    'category_id' => 1,
    'description' => 2,
    'end_date' => 3,
    'name' => 4,
    'address' => 5,
    'budget' => 6,
    'latitude' => 7,
    'longitude' => 8,
    'author_id' => function () {
        return rand(1, 20);
    },
    'status_id' => function () {
        return rand(1, 5);
    }
];

$sql = Converter2::getSqlFromCsv('data/tasks.csv', $value_map, 'task');

Converter2::writeInSqlFile('data/sql/task.sql', $sql);

$value_map = [
    'executor_id' => function () {
        return rand(11, 20);
    },
    'customer_id' => function () {
        return rand(1, 10);
    },
    'date' => 0,
    'rate' => function () {
        return rand(1, 5);
    },
    'comment' => 2
];

$sql = Converter2::getSqlFromCsv('data/opinions.csv', $value_map, 'feedback');

Converter2::writeInSqlFile('data/sql/feedback.sql', $sql);

$value_map = [
    'executor_id' => function () {
        return rand(11, 20);
    },
    'task_id' => function () {
        return rand(1, 10);
    },
    'time' => 0,
    'comment' => 2
];

$sql = Converter2::getSqlFromCsv('data/replies.csv', $value_map, 'response');

Converter2::writeInSqlFile('data/sql/response.sql', $sql);
