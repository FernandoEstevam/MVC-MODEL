<?php
/**
 * Class Investimento DB
 */

namespace Poupemais\App\Models;

use PDO;
use PDOException;
use Poupemais\Src\Lib\{Crud, Cliente};
use Poupemais\Src\Core\Erro;


class InvestimentoModel extends Crud
{
  private $query;
  
  # Busca por ID investimentos
  public function findByID(int $id): array
  {
    try {
      $this->query = $this->selectDB(
        "*",
        "investimento",
        "WHERE id = ?",
        array($id)
      );
  
      $row = $this->query->rowCount();
  
      if($row == 0) {
        Erro::setErro('Nenhum registro encontrado!');
      }
  
      $retorno = $this->query->fetch(PDO::FETCH_ASSOC);
  
      return $retorno;
  } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }
  
  # Busca o ultimo ID investimentos
  public function findByLastID(): int
  {
    try {
      $query = $this->selectDB(
        "*",
        "investimento",
        "",
        array()
      );

      return $query->lastInsertId();

    } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }


  # Busca por ID investimentos
  public function findByName($cliente): array
  {
    try {
      $this->query = $this->selectDB(
        "*",
        "clientes",
        "WHERE nome = ?",
        array($cliente)
      );
  
      $row = $this->query->rowCount();
  
      if($row == 0) {
        Erro::setErro('Nenhum registro encontrado!');
      }
  
      $retorno = $this->query->fetch(PDO::FETCH_ASSOC);
      
      return $retorno;
  
    } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }

  # Busca todos investimentos
  public function find(): array
  {
    try {
      $this->query = $this->selectDB(
        "*",
        "investimentos",
        "",
        array()
      );
      $row = $this->query->rowCount();
  
      if($row == 0) {
        Erro::setErro('Nenhum registro encontrado!');
      }
  
      $retorno = $this->query->fetch(PDO::FETCH_ASSOC);
  
      return $retorno;
    } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }

  # Salva investimento
  public function save(Cliente $cliente): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
     Erro::setErro("Valor passado inválido!");
    }
    
    try {
      # Retorno id 
      $id_cliente = $this->findByName($cliente);
      # cadastra investimento
      $this->query = $this->insertDB(
        "investimentos(valor,data_contratacao,situacao,id_cliente,id_plano,id_aporte)",
        "?,?,?,?,?,?",
        array(
          $cliente->getInvestimento()->getValorPlano(),
          $cliente->getInvestimento()->getDataContratacao(),
          "aberto",
          $id_cliente,
          $cliente->getInvestimento()->getPlano(),
          $cliente->getInvestimento()->getAporte()
        )
      );
    } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }
}