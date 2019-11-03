<?php
require_once __DIR__ . '\vendor\autoload.php';

use classes\Task;

$task = new Task(1, 'String', ' ', 3, '2019-11-03', 2,);
echo '<pre>';
echo $task->getAvailableActions(3);
