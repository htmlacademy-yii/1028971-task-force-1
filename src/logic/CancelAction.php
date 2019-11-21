<?php


namespace src\logic;


class CancelAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'cancel_action';
    }

    public static function verifyAccess(AvailableActions $availableActions, int $userId): bool
    {
        if ($availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW
            && $availableActions->getCustomerId() === $userId) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Отменить задание';
    }
}
