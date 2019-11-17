<?php


namespace src;


class RefuseAction extends AbstractAction
{

    public static function getAction()
    {
        return 'refuse_action';
    }

    public static function verifyAccess(AvailableActions $availableActions)
    {
        if (AvailableActions::STATUS_WORK && AvailableActions::ROLE_EXECUTOR) {
            return true;
        }
        return false;
    }

    public static function getTitle()
    {
        return 'Отказаться';
    }
}
