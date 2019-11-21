<?php


namespace src\logic;


class RespondAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'respond_action';
    }

    public static function verifyAccess(AvailableActions $availableActions, $userId): bool
    {
        if ($availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW
            && $availableActions->getExecutorId() === $userId) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Откликнуться';
    }
}
