<?php


namespace src;


class AddTaskAction extends AbstractAction
{

    public static function getAction()
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

    public static function getTitle()
    {
        return 'Добавить задание';
    }
}
