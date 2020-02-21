<?php
/**
 * class Login
 */

namespace Poupemais\Src\Lib;

use Poupemais\Src\Core\{Erro, PasswordHash, Session, ValidaDados};
use Exception;

class Login extends ValidaDados
{
  private string $login;
  private string $passwd;
  private string $nome;
  private string $loginDB;
  private string $passwdDB;
  private bool $authentic;
  private Session $session;

  public function __construct(string $login, string $passwd, string $loginDB, string $passwdDB, string $nome)
  {
    try {
      $this->login = $this->validaEmail($login);
      $this->passwd = $this->validaInput($passwd);
      $this->nome = $this->validaInput($nome);
      $this->loginDB = $this->validaInput($loginDB);
      $this->passwdDB = $this->validaInput($passwdDB);
      $this->authentic = $this->authenticUser($this->loginDB, $this->passwdDB);
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


  private function authenticUser(string $loginDB, string $passwdDB): bool
  {
    if(!isset($passwdDB) || !isset($loginDB)){
      Erro::setErro("Usuário ou senha não informada!");
    }
    if(empty($passwdDB) || empty($loginDB)){
      Erro::setErro("Usuário ou senha não informada!");
    }
    
    if($this->getLogin() !== $loginDB){
      Erro::setErro("Usuário e/ou senha inválido!");
    }
    
    if(!PasswordHash::verifyHash($this->getPasswd(), $passwdDB)){
      Erro::setErro("Usuário e/ou senha inválido!");
    }
    
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