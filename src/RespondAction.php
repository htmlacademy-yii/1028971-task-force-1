<?php


namespace src;


class RespondAction extends AbstractAction
{

    public static function getAction()
    {
        return 'respond_action';
    }

    public static function verifyAccess(AvailableActions $availableActions)
    {
        if (AvailableActions::STATUS_NEW && AvailableActions::ROLE_EXECUTOR) {
            return true;
        }
        return false;
    }

    public static function getTitle()
    {
        return 'Откликнуться';
    }
}
