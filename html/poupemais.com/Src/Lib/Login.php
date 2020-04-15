<?php
/**
 * class Login
 */

namespace Poupemais\Src\Lib;

use Exception;
use Poupemais\App\Models\ClienteModel;
use Poupemais\App\Models\UserModel;
use Poupemais\Src\Core\{Erro, PasswordHash, Session, ValidaDados};

class Login extends ValidaDados
{
  private string $login;
  private string $passwd;
  private string $nome;
  private bool $authentic;
  private Session $session;
  private UserModel $userModel;
  private ClienteModel $clienteModel;
  
  public function __construct(string $login, string $passwd)
  {
    try {
      $this->login = $this->validaEmail($login);
      $this->passwd = $this->validaInput($passwd);
      $this->authentic = $this->authenticUser($this->login, $this->passwd);
    } catch (Exception $e) {
      exit($e->getMessage());
    }
    $this->session = new Session();
  }

  # Getters
  public function getLogin(): string
  {
    return $this->login;
  }
  
  public function getPasswd(): string
  {
    return $this->passwd;
  }


  private function authenticUser(string $login, string $passwd): bool
  {
    if(!isset($passwd) || !isset($login)){
      Erro::setErro("Usuário ou senha não informada!");
    }
    if(empty($passwd) || empty($login)){
      Erro::setErro("Usuário ou senha não informada!");
    }

    $this->userModel = new UserModel;
    $this->clienteModel = new ClienteModel;

    $user = $this->userModel->find("id,email,senha","email",$login);
    
    if(!PasswordHash::verifyHash($this->getPasswd(), $user->senha)){
      Erro::setErro("Usuário e/ou senha inválido!");
    }
    
    $cliente = $this->clienteModel->find("nome","id_usuario", $user->id);
    $this->nome = $cliente->nome;
    
    return true;
  }

  public function iniciaSession():void
  {
    if(!$this->authentic) {
      Erro::setErro("Login não iniciado!");
    }

    $this->session->setSession($this->nome, $this->getLogin());
  }
}