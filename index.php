<?php
require_once __DIR__ . '\vendor\autoload.php';

use task_force\Task;

$task = new Task();
echo '<pre>';
echo $task->getNextStatus('выполнить');
echo '<pre>';
echo $task->getCurrentStatus();
echo '<pre>';
print_r($task->getStatuses());
echo '<pre>';
print_r($task->getActions());
