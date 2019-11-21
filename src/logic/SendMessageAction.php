<?php


namespace src\logic;


class SendMessageAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'send_message';
    }

    public static function verifyAccess(AvailableActions $availableActions, $userId): bool
    {
        if ($availableActions->getCurrentStatus() === AvailableActions::STATUS_WORK
            && ($availableActions->getCustomerId() === $userId
                || $availableActions->getExecutorId() === $userId)) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Отправить сообщение';
    }
}
