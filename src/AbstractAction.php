<?php


namespace src;


abstract class AbstractAction
{
    abstract public static function getAction();

    abstract public static function verifyAccess(AvailableActions $availableActions);

    abstract public static function getTitle();

}
