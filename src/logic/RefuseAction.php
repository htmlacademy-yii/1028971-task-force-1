<?php


namespace src\logic;


class RefuseAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'refuse_action';
    }

    public static function verifyAccess(AvailableActions $availableActions, $userId): bool
    {
        if ($availableActions->getCurrentStatus() === AvailableActions::STATUS_WORK
            && $availableActions->getExecutorId() === $userId) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Отказаться';
    }
}
