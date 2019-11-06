<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\Task;

$task = new Task(1, 'String', ' ', 3, '2019-11-03', 2,);
echo '<pre>';
print_r($task);
