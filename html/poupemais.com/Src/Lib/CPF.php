<?php
/**
 * 
 * class CPF 
 * Faz a validacao do CPF
 */
namespace Poupemais\Src\Lib;
use Poupemais\Src\Core\{Erro,ValidaDados};
use Exception;

class CPF extends ValidaDados
{
  private $cpf;

  public function __construct(string $cpf)
  {
    try {
      $this->cpf = $this->validaDigito($cpf);
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  private function validaDigito(string $cpf): string
  {
    if(!isset($cpf) || empty($cpf)){
      Erro::setErro("CPF é obrigatorio!");
    }

    # Valida input CPF
    $cpf = $this->validaInput($cpf);

    # Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    
    # Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
      Erro::setErro("O Cpf deve ter 11 digítos!");
    }
  
    # Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
      Erro::setErro("CPF não aceita números sequências!"); 
    }
    
    # Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
          $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        Erro::setErro("CPF Inválido!"); 
      }
    }

    return $cpf;
  }
  
  # exibe telefone xxx.xxx.xxx-xx
  private function showCPF(string $cpf): string
  {
    if(!isset($cpf) || empty($cpf)) {
      Erro::setErro("CPF em branco! Tente novamente");
    }

    # Mostra o cpf estilizado
    return substr($cpf, 0,3). '.' .substr($cpf, 3,3). '.' . substr($cpf, 6,3). '-' .substr($cpf, 9,2);
  }

  public function getCPF():string
  {
    return $this->showCPF($this->cpf);
  }
}