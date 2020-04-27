<?php

namespace Poupemais\Src\Core;

use Poupemais\Src\Core\Bind;
use Poupemais\Src\Lib\Traits\PersisteDB;

abstract class Model
{
  protected $connection;

  use PersisteDB;

  public function __construct()
  {
    $this->connection = Bind::get("connection");
  }

  # Busca
  final public function all(): array
  {
    $sql = "SELECT * FROM {$this->table}";

    $stmt = $this->connection->prepare($sql);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro encontrado.");
    }

    return $stmt->fetchAll();
  }

  # Busca paramentro ID
  final public function findByID(int $id): object
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = :id";

    $stmt = $this->connection->prepare($sql);

    $stmt->bindValue(":id", $id);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro encontrado.");
    }

    return $stmt->fetch();
  }

  # Encontrar  
  final public function find(string $column, string $field, string $value): object
  {
    $sql = "SELECT {$column} FROM {$this->table} WHERE {$field} = :{$field}";


    $stmt = $this->connection->prepare($sql);
    $stmt->bindValue(":{$field}", $value);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro encontrado.");
    }

    return $stmt->fetch();
  }

  # Encontrar All
  final public function findAll(string $column, string $field, string $value): array
  {
    $sql = "SELECT {$column} FROM {$this->table} WHERE {$field} = :{$field}";

    $stmt = $this->connection->prepare($sql);

    $stmt->bindValue(":{$field}", $value);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro encontrado.");
    }

    return $stmt->fetchAll();
  }

  # Deletar
  final public function delete(int $id): bool
  {
    $sql = "DELETE FROM {$this->table} WHERE id = :id";

    $stmt = $this->connection->prepare($sql);

    $stmt->bindValue(":id", $id);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro deletado.");
    }

    return true;
  }
}
