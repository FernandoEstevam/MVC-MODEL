<?php
/**
 * class CRUD
 */
namespace Poupemais\Src\Lib;
use Poupemais\Src\Core\ConexaoDB;

class Crud extends ConexaoDB
{
  private $query;

  # Executa a consulta banco de dados
  private function prepareExec(string $prep, array $exec): void
  {
    $this->query = $this->conn->prepare($prep);
    $this->query->execute($exec);
  }

  # Select banco de dados
  protected function selectDB(string $fields, string $table, string $where, array $exec)
  {
    $this->prepareExec("SELECT {$fields} FROM {$table} {$where}", $exec);
    return $this->query;
  }
}