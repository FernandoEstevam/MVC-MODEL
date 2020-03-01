<?php
/**
 * class Cliente
 */
namespace Poupemais\Src\Lib;

use Exception;
use Poupemais\Src\Lib\{Usuario, Endereco, CPF, Investimento};
use Poupemais\Src\Core\{ValidaDados, Erro};

class Cliente extends ValidaDados
{
  private Usuario $usuario;
  private Endereco $endereco;
  private CPF $cpf;
  private Investimento $investimento;
  private string $nome;
  private string $rg;
  private string $dataNasc;
  private string $estadoCivil;
  private string $telefone;

  public function __construct(
    Usuario $usuario, 
    Endereco $endereco, 
    CPF $cpf, 
    string $nome, 
    string $rg, 
    string $dataNasc,
    string $estadoCivil,
    string $telefone,
    Investimento $investimento
    )
  {
    try {
      $this->usuario = $usuario;
      $this->endereco = $endereco;
      $this->cpf = $cpf;
      $this->nome = ucwords($this->quantidadeChars($this->validaInput($nome), 5, "Nome deve ter pelo menos 5 caracteres!", false));
      $this->rg = $this->validaInput($rg);
      $this->dataNasc = $this->validaInput($dataNasc);
      $this->estadoCivil = ucfirst($this->validaInput($estadoCivil));
      $this->telefone = $this->quantidadeChars($this->validaInput($telefone), 10, "Telefone deve ter pelo menos 10 digítos!");
      $this->investimento = $investimento;
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  # Getters Endereco
  public function getEndereco(): Endereco
  {
    return $this->endereco;
  }

  # Getters Usuario
  public function getUsuario(): Usuario
  {
    return $this->usuario;
  }

  # Getters CPF
  public function getCPF(): CPF
  {
    return $this->cpf;
  }

  # Getters Investimento
  public function getInvestimento(): Investimento
  {
    return $this->investimento;
  }
  # Getters Cliente
  public function getNome(): string
  {
    return $this->nome;
  }
  
  public function getShowRG(): string
  {
    return $this->showRG($this->rg);
  }

  public function getRG(): string
  {
    return $this->removeCaracteres($this->rg);
  }

  public function getDataNasc(): string
  {
    return $this->dataNasc;
  }

  public function getEstadoCivil(): string
  {
    return $this->estadoCivil;
  }

  public function getTelefone(): string
  {
    return $this->removeCaracteres($this->telefone);
  }

  public function getShowTelefone(): string
  {
    return $this->showTelefone($this->telefone);
  }

  public function getPrimeiroNome(): string
  {
    $primeiroNome = explode(" ", $this->getNome());
    
    return $primeiroNome[0];
  }

  
  # exibe telefone xx.xxx.xxx-x
  private function showRG(string $rg): string
  {
    if(!isset($rg) || empty($rg)) {
      Erro::setErro("RG não informado");
    }
    
    $rg = $this->removeCaracteres($rg);

    if(strlen($rg) < 9) {
      return "0".substr($rg, 0,1). '.' . substr($rg, 1,3) . '.' . substr($rg, 4,3) .'-'.   substr($rg, 7,1);    
    }

    return substr($rg, 0,2). '.' . substr($rg, 2,3) . '.' . substr($rg, 5,3) .'-'.   substr($rg, 8,1);
  }

  # exibe telefone (xx) x.xxxx-xxxx || (xx) xxxx-xxxx 
  public function showTelefone(string $telefone): string
  {
    if(!isset($telefone) || empty($telefone)) {
      Erro::setErro("Telefone não informado");
    }

    $telefone = $this->removeCaracteres($telefone);

    if(strlen($telefone) < 11) {
      $telefone = "(".substr($telefone, 0,2).") " . substr($telefone, 2,4). "-" . substr($telefone, 6,4);  
      return $telefone;
    }

    $telefone = "(".substr($telefone, 0,2).") " . substr($telefone, 2,1). ".".substr($telefone, 3,4). "-" . substr($telefone, 7,4);

    return $telefone;
  }
}