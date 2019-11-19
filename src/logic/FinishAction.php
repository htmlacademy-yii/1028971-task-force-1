<?php


namespace src\logic;


class FinishAction extends AbstractAction
{

    public static function getAction()
    {
        return 'finish_action';
    }

    public static function verifyAccess(AvailableActions $availableActions)
    {
        if (AvailableActions::STATUS_WORK && AvailableActions::ROLE_CUSTOMER) {
            return true;
        }
        return false;
    }

    public static function getTitle()
    {
        return 'Завершить задание';
    }
}
