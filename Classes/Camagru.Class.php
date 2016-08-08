<?php
class Camagru {
  static $dbbool = NULL;
  static function InitializeDatabase($DB_DSN, $DB_USER, $DB_PASSWORD) {
    if (!self::$dbbool)
      self::$dbbool = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
    return self::$dbbool;
  }
}
