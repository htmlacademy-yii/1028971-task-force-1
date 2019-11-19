<?php


namespace src\logic;


class RespondAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'respond_action';
    }

    public static function verifyAccess(AvailableActions $availableActions): bool
    {
        if (AvailableActions::STATUS_NEW && AvailableActions::ROLE_EXECUTOR) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Откликнуться';
    }
}
