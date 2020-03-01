<?php
/**
 * class Controller
 * 
 * Classe exclusiva Controller
 * class exclusiva para os Controllers
 */

namespace Poupemais\Src\Core;

use Poupemais\Src\Core\View;

class Controller extends View
{  
  protected View $view;

  # Instancia a view
  public function __construct()
  {
    $this->view = new View();
  }
}