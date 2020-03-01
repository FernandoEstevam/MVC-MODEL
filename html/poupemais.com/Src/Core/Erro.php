<?php
/**
 * class Erro trown
 * 
 * // Exibe erros simples  
 * error_reporting(E_ERROR | E_WARNING | E_PARSE);
 * 
 * // Exibir E_NOTICE também pode ser bom para mostrar variáveis não iniciadas...
 * // ou com erros de digitação.
 * error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
 * 
 * // Exibe todos os erros, exceto E_NOTICE
 * error_reporting(E_ALL & ~E_NOTICE);
 * 
 * // Exibe todos os erros PHP
 * error_reporting(-1);
 * 
 */

namespace Poupemais\Src\Core;
use Exception;

class Erro extends Exception
{
  # Exibe ou oculta o erros
  public static function showErro()
  {
        
    if(defined('DEBUG') && DEBUG === true) {
      
      // Mesmo que error_reporting(E_ALL);
      ini_set('display_erros', 1);
      
      // Exibe todos os erros PHP (see changelog)
      error_reporting(E_ALL);
      
      return;
    }
  
    // Exibe todos os erros PHP (see changelog)
    error_reporting(0);
    
    // Mesmo que error_reporting(E_ALL);
    ini_set('display_erros', 0); 
  }

  # Seta erro 
  public static function setErro(string $msg): void
  {
    throw new Exception(
      json_encode(
        array(
          "status" => "erro",
          "dados" => $msg
      )), 1);
  }

  public static function setSuccess(string $msg): void
  {
    echo json_encode(
      array(
        "status" => "success",
        "dados" => $msg
    ), 1);
  }
}