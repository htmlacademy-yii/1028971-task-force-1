<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\exe\ActionException;
use src\logic\AvailableActions;

try {
    $task = new AvailableActions(1,
        'String',
        AvailableActions::STATUS_NEW,
        3,
        '2019-11-03');

    echo $task->getNextStatus(AvailableActions::ACTION_SET_EXECUTOR);

} catch (ActionException $e) {
    die('В файле '.$e->getFile().' возникла ошибка '.' '.$e->getMessage().' '.' в строке '.$e->getLine());
}


    assert($task->getAvailableActions(AvailableActions::ROLE_CUSTOMER, AvailableActions::STATUS_NEW)
        === [AvailableActions::ACTION_CANCEL, AvailableActions::ACTION_SET_EXECUTOR], 'Если статус НОВЫЙ то для 
        заказчика доступны действия - Cancel и Set executor');

    assert($task->getAvailableActions(AvailableActions::ROLE_CUSTOMER, AvailableActions::STATUS_WORK)
        === [AvailableActions::ACTION_FINISHED, AvailableActions::ACTION_CHAT], 'Если статус В РАБОТЕ то для 
        заказчика доступны действия - Finish и Chat');

    assert($task->getAvailableActions(AvailableActions::ROLE_EXECUTOR, AvailableActions::STATUS_NEW)
        === [AvailableActions::ACTION_RESPOND], 'Если статус НОВЫЙ, то для исполнителя доступно действие Respond');

    assert($task->getAvailableActions(AvailableActions::ROLE_EXECUTOR, AvailableActions::STATUS_WORK)
        === [AvailableActions::ACTION_CHAT, AvailableActions::ACTION_REFUSE],
        'Если статус В РАБОТЕ, то для исполнителя доступно действие Chat и Refuse');


