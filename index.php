<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\import\Converter2;

$value_map = [
    'email' => 0,
    'name' => 1,
    'password' => 2,
    'reg_date' => 3,
    'city_id' => function(){return rand(1, 1008);},
    'is_executor' => function(){return rand(0,1);},
    'some_key' => function(){return rand(1, 100);}
];

var_dump(Converter2::getSqlFromCsv('data\users.csv', $value_map, 'user'));









