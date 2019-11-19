<?php


namespace src\logic;


class RefuseAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'refuse_action';
    }

    public static function verifyAccess(AvailableActions $availableActions): bool
    {
        if (AvailableActions::STATUS_WORK && AvailableActions::ROLE_EXECUTOR) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Отказаться';
    }
}
