<?php


namespace src;


class SendMessageAction extends AbstractAction
{

    public static function getAction()
    {
        return 'send_message';
    }

    public static function verifyAccess(AvailableActions $availableActions)
    {
        if (AvailableActions::STATUS_WORK && (AvailableActions::ROLE_CUSTOMER || AvailableActions::ROLE_EXECUTOR)) {
            return true;
        }
        return false;
    }

    public static function getTitle()
    {
        return 'Отправить сообщение';
    }
}
