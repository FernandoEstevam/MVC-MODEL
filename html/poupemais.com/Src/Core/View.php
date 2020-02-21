<?php
/**
 * class View
 * 
 * Classe exclusiva View
 * utilizacao para arquivos html com ou sem paramentros
 */
namespace Poupemais\Src\Core;
use Exception;

class View
{
  # Renderiza a view
  public function render(string $header, string $view, array $data=[], string $footer): void
  {
    if(!file_exists(VIEWS . '/' . $view . '.php')){
      throw new Exception(
        json_encode(
          array(
            "status" => "erro",
            "dados" => "Arquivo não existe!"
      )), 1);
      exit();
    }
    
    self::header($header);
    require_once VIEWS . '/' . $view . '.php';
    self::footer($footer);
  }

  # Renderiza o header das views
  private static function header(string $view_header, array $data=[]): void
  {    
    if(!file_exists(LAYOUT . $view_header .'.php')) {
      require_once LAYOUT . 'header_default.php';
      return;  
    }
    require_once LAYOUT . $view_header .'.php';
  }
  # Renderiza o footer das views
  private static function footer(string $view_footer='', array $data=[]): void
  {
    if(!file_exists(LAYOUT . $view_footer .'.php')) {
      require_once LAYOUT . 'footer_default.php';  
      return;
    }
    require_once LAYOUT . $view_footer .'.php';
  }
}