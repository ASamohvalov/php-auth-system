<?php

class Configuration
{
  private static ?string $baseUrl = null;
  
  /**
  * WARNING, call this method only in the base directory,
  * or else - undefined behavior (UB).
  */
  public static function init() : void
  {
    self::$baseUrl = dirname($_SERVER['SCRIPT_NAME']);
  }

  public static function getBaseUrl() : ?string
  {
    return self::$baseUrl; 
  }
}
