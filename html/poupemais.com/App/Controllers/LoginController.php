<?php
/**
 * class LoginController
 */

namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\{Controller, Erro, Session};
use Poupemais\Src\Lib\Login;
use Exception;

class LoginController extends Controller
{
  private Login $login;
  private Session $session;

  public function index(): void
  {
    try {
      $this->session = new Session();
      $this->view->render('header_login','/login/index',[''], 'footer_login');
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  # Autentica user
  public function authenticUser(): void
  {
    if(!isset($_POST['login']) || !isset($_POST['password'])){
      if(empty($_POST['login']) || empty($_POST['password'])){
        Erro::setErro("Informe usuário e/ou senha!");
      }
    }

    $this->login = new Login(
      $_POST['login'],
      $_POST['password']
    );
      
      $this->login->iniciaSession();
      
      $this->redirect();
    }
    
    # Redirect page
  private function redirect(): void
  {
    if(!isset($_SESSION) || empty($_SESSION)) {
      $this->session->destructSession();
      Erro::setErro("Acesso não autorizado!");
    }
    
    if($_SESSION['email'] !== $_POST['login']) {
      $this->session->destructSession();
      Erro::setErro("Acesso não autorizado!");
    }

    Erro::setSuccess("Login efetuado com sucesso, redirecionando...");

  }
}