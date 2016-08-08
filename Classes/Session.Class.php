<?php

/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 07/08/2016
 * Time: 20:46
 */
class Session
{
    static $sessionbool;
    static function getCurrent() {
        if (!$self::sessionbool)
            self::$sessionbool = new Session();
        return self::$sessionbool;
    }
    public function __construct()
    {
        session_start();
    }
}