<?php


namespace src;


class SetExecutorAction extends AbstractAction
{

    public static function getAction()
    {
        return 'set_executor';
    }

    public static function verifyAccess(AvailableActions $availableActions)
    {
        if (AvailableActions::STATUS_NEW && AvailableActions::ROLE_CUSTOMER) {
            return true;
        }
        return false;
    }

    public static function getTitle()
    {
        return 'Выбрать исполнителя';
    }
}
