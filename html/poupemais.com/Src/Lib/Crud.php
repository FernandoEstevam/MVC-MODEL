<?php
/**
 * class CRUD
 */
namespace Poupemais\Src\Lib;

use PDOException;
use Poupemais\Src\Core\ConexaoDB;

class Crud extends ConexaoDB
{
  private $crud;

  # Executa a consulta banco de dados
  private function prepareExec(string $prep, array $exec): void
  {
    try {
      $this->conn->beginTransaction();
      
      $this->crud = $this->conn->prepare($prep);
  
      try {
        $this->crud->execute($exec);
        
      } catch (PDOException $e) {
        exit($e->getMessage());
      }

      $this->conn->commit();

    } catch (PDOException $e) {
      
      $this->conn->rollBack();

      exit($e->getMessage());
    }
  }

  # Select banco de dados
  protected function selectDB(string $fields, string $table, string $where, array $exec)
  {
    $this->prepareExec("SELECT {$fields} FROM {$table} {$where}", $exec);
    return $this->crud;
  }

  # Insert banco de dados
  protected function insertDB(string $table, string $value, array $exec)
  {
    $this->prepareExec("INSERT INTO {$table} VALUES ({$value})", $exec);
    return $this->crud;
  }
}