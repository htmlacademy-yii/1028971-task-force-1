<?php


namespace src\logic;


class SetExecutorAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'set_executor';
    }

    public static function verifyAccess(AvailableActions $availableActions, $userId): bool
    {
        if ($availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW
            && $availableActions->getCustomerId() === $userId) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Выбрать исполнителя';
    }
}
