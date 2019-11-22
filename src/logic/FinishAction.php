<?php


namespace src\logic;


class FinishAction extends AbstractAction
{

    public static function getInnerName(): string
    {
        return 'finish_action';
    }

    public static function verifyAccess(AvailableActions $availableActions, $userId): bool
    {
        if (AvailableActions::STATUS_WORK === $availableActions->getCurrentStatus()
            && $availableActions->getCustomerId() === $userId) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Завершить задание';
    }
}
