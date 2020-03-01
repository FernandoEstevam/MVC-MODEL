<?php
/**
 * class Route
 * 
 * Classe exclusiva Route
 * define as rotas (Controllers, Metodos, Params)
 */
namespace Poupemais\Src\Core;
use Exception;

class Route 
{
  private $controller = "HomeController";
  private $metodo = "index";
  private array $params = [];
  private string $not_found = '/includes/404-Erro.php';

  public function __construct()
  {
    # Inicia na instancia
    try {
      $this->getUrl();
      $this->getRoute();
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  # Captura e seta os valores dos atributos da class
  private function getUrl(): void
  {
    # Verifica se a url esta setada
    if(!isset($_GET['url']) && empty($_GET['url'])) return;
    
    $ret = strip_tags(trim(filter_input(INPUT_GET,'url', FILTER_SANITIZE_URL), '/'));

    $url = explode('/', $ret);
    
    # Set controller
    $this->controller = ucfirst($url[0]) . 'Controller';
    array_shift($url);

    # Verifica se url e null
    if(empty($url[0])) {
      $url[0] = "index";
    }
    
    # Set metodo
    $this->metodo = $url[0];
    array_shift($url);
    
    # Set Params
    if(!is_array($url) && !isset($url)) return;
    $this->params = $url;
  }
  
  # Verifica se exite class e metodos e seta a class
  private function getRoute(): void
  {
    # Verifica se o arquivo existe
    if(!file_exists(CONTROLLERS . $this->controller . '.php')) {
      require_once DIR_ROOT . $this->not_found; 
    }
    
    # Verifica se a classe existe
    if(!class_exists("Poupemais\\App\\Controllers\\" . $this->controller)) {
      require_once DIR_ROOT . $this->not_found;
      Erro::setErro("Classe não existe!");
    };
    
    # Verifica se o metodo existe
    if(!method_exists("Poupemais\\App\\Controllers\\" . $this->controller, $this->metodo)) {
      require_once DIR_ROOT . $this->not_found;
      Erro::setErro("Método não existe!");
    }

    # Instancia a class
    $objController = "Poupemais\\App\\Controllers\\" . $this->controller;
    $this->controller = new $objController;

    # Chama a funcao e o metodo e seta o paramentro caso tenha
    call_user_func_array([$this->controller, $this->metodo], $this->params);
  }
}



  