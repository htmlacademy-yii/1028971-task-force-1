<?php


namespace src\logic;


class SetExecutorAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'set_executor';
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
        return 'Выбрать исполнителя';
    }
}
