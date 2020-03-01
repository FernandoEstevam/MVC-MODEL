<?php
/**
 * class LoginController
 */

namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\{Controller, Erro, PasswordHash, Session};
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
      $this->view->render('header_login','/login/index',['nome' => 'Fernando Estevam'], 'footer_login');
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
    
    $loginDB = 'fernandoestevam23@gmail.com';
    $nomeDB = 'Fernando';
    $senha = '709244';
    $passwdDB = PasswordHash::hashPasswd($senha);
    
    $this->login = new Login(
      $_POST['login'],
      $_POST['password'],
      $loginDB,
      $passwdDB,
      $nomeDB
    );
      
      $this->login->iniciaSession();
      
      $this->redirect(($nomeDB));
    }
    
    # Redirect page
  private function redirect($nomeDB): void
  {
    if(!isset($_SESSION) || empty($_SESSION)) {
      $this->session->destructSession();
      Erro::setErro("Acesso não autorizado!");
    }
    
    if($_SESSION['name'] !== $nomeDB) {
      $this->session->destructSession();
      Erro::setErro("Acesso não autorizado!");
    }

    // http://www.example.com/
    header('Location: /dashboard');

  }
}