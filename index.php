<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\logic\AvailableActions;

$task = new AvailableActions(1,
    'String',
    AvailableActions::STATUS_WORK,
    3,
    '2019-11-03',
    2,);
echo '<pre>';
print_r($task->getAvailableActions(AvailableActions::ROLE_CUSTOMER));


