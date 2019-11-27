<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\exceptions\ConvertException;
use src\import\Converter2;

//$value_map = [
//    'email' => 0,
//    'name' => 1,
//    'password' => 2,
//    'reg_date' => 3,
//    'city_id' => function(){return rand(1, 1008);}
//];
//
//$sql = Converter2::getSqlFromCsv('data\users.csv', $value_map, 'user');
//Converter2::insertIntoDB($sql);

//$value_map = [
//    'name' => 0,
//    'icon' => 1
//];
//
//$sql = Converter2::getSqlFromCsv('data\categories.csv', $value_map, 'category');
//Converter2::insertIntoDB($sql);

//$value_map = [
//    'name' => 0,
//    'icon' => 1
//];
//
//$sql = Converter2::getSqlFromCsv('data\categories.csv', $value_map, 'category');
//try {
//    Converter2::insertIntoDB($sql);
//} catch (ConvertException $e) {
//}

//$value_map = [
//    'name' => 0
//];
//
//$sql = Converter2::getSqlFromCsv('data\statuses.csv', $value_map, 'status');
//try {
//    Converter2::insertIntoDB($sql);
//} catch (ConvertException $e) {
//}


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
    'author_id' => function() {return rand(1,20);},
    'status_id' => function() {return rand(1,5);}
];


var_dump($sql = Converter2::getSqlFromCsv('data\tasks.csv', $value_map, 'task'));

try {
    Converter2::insertIntoDB($sql);
} catch (ConvertException $e) {
}











