<?php
/**
 * class Endereco
 * 
 * Classe exclusiva endereco
 * utilizacao no cadastro cliente
 */
namespace Poupemais\Src\Lib;
use Poupemais\Src\Core\ValidaDados;
use Exception;

class Endereco extends ValidaDados
{
  private string $cep;
  private string $rua;
  private string $numero;
  private string $compl;
  private string $bairro;
  private string $cidade;
  private string $uf;

  public function __construct(
    string $cep, 
    string $rua, 
    string $numero, 
    string $bairro,  
    string $cidade, 
    string $uf, 
    string $compl = null)
  {
    try {
      $this->cep = $this->quantidadeChars($this->validaInput($cep), 8, "CEP deve ter 8 digítos");
      $this->rua = ucwords($this->validaInput($rua));
      $this->numero = $this->validaInput($numero);
      $this->compl =  $this->verificaComplemento($compl);
      $this->bairro = ucwords($this->validaInput($bairro));
      $this->cidade = ucwords($this->validaInput($cidade));
      $this->uf = strtoupper($this->validaInput($uf));
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  # Verifica se complemento foi informado
  private function verificaComplemento($compl): string
  {
    if(!isset($compl) || empty($compl)) {
      return $compl = '';
    }

    return $this->validaInput($compl);
  }

  # Getters
  public function getCep(): string 
  {
    return $this->showCep($this->cep);
  }
 
  public function getRua(): string
  {
    return $this->rua;
  }  
  
  public function getNumero(): string 
  {
    return $this->numero;
  }

  public function getCompl(): string 
  {
    return $this->compl;
  }

  public function getBairro(): string
  {
    return $this->bairro;
  }
  
  public function getCidade(): string
  {
    return $this->cidade;
  }

  public function getUf(): string
  {
    return $this->uf;
  }

  public function showCep(string $cep): string
  {
    $cep = $this->removeCaracteres($cep);

    $cep = substr($cep, 0,5) . "-". substr($cep, 5,3);

    return $cep;
  }
}