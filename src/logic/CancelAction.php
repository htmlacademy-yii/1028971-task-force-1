<?php


namespace src\logic;


class CancelAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'cancel_action';
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
        return 'Отменить задание';
    }
}
