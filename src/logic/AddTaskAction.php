<?php


namespace src\logic;


class AddTaskAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'add_task';
    }

    public static function verifyAccess(AvailableActions $availableActions): bool
    {
        if (AvailableActions::STATUS_NEW && AvailableActions::ROLE_CUSTOMER) {
            return true;
        }
        return false;

    }

    public static function getTitle(): string
    {
        return 'Добавить задание';
    }
}
