<?php
spl_autoload_register("camagru_autoload");

function camagru_autoload($class) {
  require "Classes/$class.Class.php";
}

function rine(&$a, $default = "") {
    if (isset($a))
        return $a;
    return $default;
}