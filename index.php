<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\AvailableActions;

$task = new AvailableActions(1,
                            'String',
                            AvailableActions::STATUS_NEW,
                            3,
                            '2019-11-03',
                            2,);
echo '<pre>';
print_r($task->getAvailableActions(2));
