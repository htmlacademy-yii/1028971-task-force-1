<?php


namespace src\logic;


class AddTaskAction extends AbstractAction
{

    public static function getInnerName(): string
    {
        return 'add_task';
    }

    public static function verifyAccess(AvailableActions $availableActions, int $userId): bool
    {
        if (AvailableActions::STATUS_NEW === $availableActions->getCurrentStatus()
            && $availableActions->getCustomerId() === $userId) {
            return true;
        }
        return false;

    }

    public static function getTitle(): string
    {
        return 'Добавить задание';
    }
}
