<?php
/**
 * class Session
 */
namespace Poupemais\Src\Core;
use Poupemais\Src\Core\GetIP;

class Session
{ 
  private int $timeSession = 1200; // 20minutos
  private int $timeCanary = 300; // 5 minutos

  public function __construct() 
  {
    if(session_id() == '') {
      ini_set("session.save_handler","files");
      ini_set("session.use_cookies",1);
      ini_set("session.use_only_cookies",1);
      ini_set("session.cookie_domain",DOMAIN);
      ini_set("session.cooke_httponly",1);
      if(DOMAIN != "poupemais.com") {
        ini_set("session.cookie_secure",1);
      }
      if (session_status() !== PHP_SESSION_ACTIVE) {
        //Verificar se a sessão não já está aberta.
        session_name(md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
        session_cache_expire(10);
        session_start();
        session_name();
      }
    }
  }

  # Protege contra roubo de sessão
  private function setSessionCanary($par = null)
  {
    session_regenerate_id(true);
    if($par == null) {
      $_SESSION['canary'] = [
        "birth" => time(),
        "IP" => GetIp::getuserIp()
      ];
    } else {
      $_SESSION['canary']['birth'] = time();
    }
  }

  # Verifica a integridade da sessão
  private function verifyIdSession()
  {
    if(!isset($_SESSION['canary'])) {
      $this->setSessionCanary();
    }

    if($_SESSION['canary']['IP'] !== GetIp::getUserIp()) {
      $this->destructSession();
      $this->setSessionCanary();
    }

    if($_SESSION['canary']['birth'] < time() - $this->timeCanary) {
      $this->setSessionCanary("time");
    }
  }

  # Seta as sessões no sistema
  public function setSession(string $name, string $email='')
  { 
    $this->verifyIdSession();
    $_SESSION['login'] = true;
    $_SESSION['time'] = time();
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;

    return $_SESSION;
  }
  
  # Validar as págnas internas do sistema
  public function verifyInsedeSession()
  {
    $this->verifyIdSession();
    if(!isset($_SESSION['login']) || !isset($_SESSION['canary'])) {
      $this->destructSession();
      Erro::setErro("Acesso negado. Efetue o login e tente novamente");
      return;
    } 
    
    if($_SESSION['time'] >= time() - $this->timeSession) {
      $_SESSION['time'] = time();
      return;
    }
      $this->destructSession();
      Erro::setErro("Sua sessão expirou. Faça o login novamente!");
  }

  # Destruir a session existente
  public function destructSession()
  {
    foreach (array_keys($_SESSION) as $key) {
      unset($_SESSION[$key]);
    }
    session_unset();
  }
}