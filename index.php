<?php
require_once __DIR__ . '\vendor\autoload.php';

use classes\Task;

$task = new Task(1, 'String', 'отказаться', 3, '2019-11-03', 2,);
echo '<pre>';
echo $task->getNextStatus($task::ACTION_REFUSE);
echo '<pre>';
echo $task->getCurrentStatus();
echo '<pre>';
print_r($task->getStatuses());
echo '<pre>';
print_r($task);
