<?php

namespace Poupemais\Src\Lib;

use Closure;
use Exception;
use Poupemais\Src\Core\{Model, Erro};

class Transaction extends Model
{
  final public function transactions(Closure $callback): void
  {
    $this->connection->beginTransaction();

    try {
    
      $callback();
    
      $this->connection->commit();
    
    } catch (Exception $e) {

      $this->connection->rollback();
      
      Erro::setErro($e->getMessage());
    
    }
  }

  final public function model(string $model): object
  {
    return new $model();
  }


  final public function __get(string $name): object
  {
    if(!property_exists($this, $name)) {
      $model = __NAMESPACE__ . ucfirst($name) . 'Model'; 
    }
    return new $model();
  }
}