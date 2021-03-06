<?php


namespace src\logic;


abstract class AbstractAction
{
    abstract public static function getInnerName(): string ;

    abstract public static function verifyAccess(AvailableActions $availableActions, int
     $userId): bool;

    abstract public static function getTitle(): string;

}
