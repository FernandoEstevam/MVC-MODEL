<?php

namespace Poupemais\Src\Lib\Traits;

use Poupemais\Src\Lib\QueryBuilder\{Insert, Update};
use Poupemais\Src\Core\Erro;

trait PersisteDB
{
  final public function insert(array $arguments): bool
  {
    $sql = Insert::sql($this->table,$arguments);
  
    $stmt = $this->connection->prepare($sql);

    $stmt->execute($arguments);

    if($stmt->rowCount() === 0) {
      Erro::setErro("Erro ao cadastrar tente novamente!");
    }

    return true;
  }

  final public function update(array $attributes, array $where): bool
  {
    $sql = (new Update)->where($where)->sql($this->table, $attributes);

    $stmt = $this->connection->prepare($sql);

    $stmt->execute($attributes);

    if($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro alterado.");
    }

    return true;
  }
}