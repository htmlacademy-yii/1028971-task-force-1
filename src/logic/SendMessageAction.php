<?php


namespace src\logic;


class SendMessageAction extends AbstractAction
{

    public static function getAction(): string
    {
        return 'send_message';
    }

    public static function verifyAccess(AvailableActions $availableActions): bool
    {
        if (AvailableActions::STATUS_WORK && (AvailableActions::ROLE_CUSTOMER || AvailableActions::ROLE_EXECUTOR)) {
            return true;
        }
        return false;
    }

    public static function getTitle(): string
    {
        return 'Отправить сообщение';
    }
}
