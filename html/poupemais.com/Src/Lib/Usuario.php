<?php
/**
 * class Usuario
 * 
 * Classe exclusiva usuario
 * utilizacao no cadastro cliente
 */

namespace Poupemais\Src\Lib;

use Exception;
use Poupemais\Src\Core\{ValidaDados, Erro, PasswordHash};

class Usuario extends ValidaDados
{
  private string $email;
  private string $passwd;
  private string $data_cadastro;

  public function __construct(string $email, string $passwd, string $conf_email=null, string $conf_passwd=null)
{
    try {
      $this->email = $this->validaEmail($email, $conf_email);
      $this->passwd = $this->validaPassword($passwd, $conf_passwd);
      $this->data_cadastro = date("Y-m-d H:i:s");
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  # Verifica e retorna o email caso seja valido
  protected function validaEmail(string $post_email, string $conf_email=null): string
  {
    if(!isset($post_email) || empty($post_email)) {
      Erro::setErro("Email não informado!");      
    };

    # Fazer um filter_input producao
    $ret_email = filter_var($post_email, FILTER_VALIDATE_EMAIL);

    if(!$ret_email) {
      Erro::setErro("Email inválido!");
    }

    if(!empty($conf_email)) {
      $ret_conf_email = filter_var($conf_email, FILTER_VALIDATE_EMAIL);
      if($ret_email !== $ret_conf_email) {
        Erro::setErro("Email e confirmação de email não confere!");
      }
    }
    return $ret_email;
  }

  # Valida a senha e retorna em hash
  private function validaPassword(string $password, string $conf_passwd=null): string
  {
    # Verifica se a senha esta setada
    if(!isset($password) || empty($password)) {
      Erro::setErro("Senha não informada!");
    }

    # Verifica se a confirmacao de senha foi informada
    if($conf_passwd != null) {
      # Caso tenha sido informada
      if(!isset($conf_passwd) || empty($conf_passwd)) {
        Erro::setErro("Confirmação de senha não informado!");
      }
      # Verifica se a senha e conf senha sao iguais
      if($password !== $conf_passwd) {
        Erro::setErro("Senha e confirmação de senha não confere!");
      }
    }
    # Caso senha iguais retorna em hash a senha
    return PasswordHash::hashPasswd($password);
  }

  # Getter
  public function getLogin(): string 
  {
    return $this->email;
  }

  public function getPasswd(): string 
  {
    return $this->passwd;
  }
  
  public function getDataCadastro(): string
  {
    return $this->data_cadastro;
  }

  public function getInsert(): array
  {
    return [
      "email" => $this->getLogin(),
      "senha" => $this->getPasswd(),
      "data_cadastro" => $this->getDataCadastro(),
      "status" => "confirmar",
    ];
  }
}