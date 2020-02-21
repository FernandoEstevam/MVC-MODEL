<?php
/**
 * class PasswordHash
 * 
 * Classe exclusiva Password
 * codifica senha cliente ou usuario sistema
 */
namespace Poupemais\Src\Core;

class PasswordHash
{
  # Codifica senha em hash
  public static function hashPasswd(string $passwd): string
  {
    return password_hash($passwd, PASSWORD_DEFAULT);
  }

  # Descodifica senha em hash
  public static function verifyHash(string $conf_passwd, string $passwd): string
  {
    return password_verify($conf_passwd, $passwd);
  }
}