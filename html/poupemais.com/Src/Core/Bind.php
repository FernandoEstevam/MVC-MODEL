<?php

namespace Poupemais\Src\Core;

class Bind
{

  private static $bind = [];

  public static function bind(string $key, object $value): void
  {
    static::$bind[$key] = $value;
  }

  public static function get(string $key): object
  {
    return static::$bind[$key];  
  }
}