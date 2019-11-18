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
print_r($task->getAvailableActions(3));


function get_hundred_values() {
    for ($i = 1; $i <= 100; $i++) {
        yield $i;
    }
}
foreach (get_hundred_values() as $value) {
    print($value);
}
