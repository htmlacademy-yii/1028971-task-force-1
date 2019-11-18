<?php


namespace src;


class CancelAction extends AbstractAction
{

    public static function getAction()
    {
        return 'cancel_action';
    }

    public static function verifyAccess(AvailableActions $availableActions): bool
    {
        if (AvailableActions::STATUS_NEW && AvailableActions::ROLE_CUSTOMER) {
            return true;
        }
        return false;
    }

    public static function getTitle()
    {
        return 'Отменить задание';
    }
}
