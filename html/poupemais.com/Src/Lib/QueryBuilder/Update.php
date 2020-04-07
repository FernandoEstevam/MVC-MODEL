<?php

namespace Poupemais\Src\Lib\QueryBuilder;


class Update
{
 
  private $where;

  final public function where(array $where): object
  {
    $this->where = $where;
  
    return $this;
  }

  final public function sql($table, $attributes): string
  {
    $sql = "UPDATE {$table} SET ";

    unset($attributes[array_keys($attributes)[0]]);
    
    foreach($attributes as $key => $value) {
      $sql .= "{$key} = :{$key}, ";
    }
    
    $sql = rtrim($sql, ', ');
    
    $where =  array_keys($this->where);
    
    $sql .= " WHERE {$where[0]} = :{$where[0]}";

    return $sql;
  }
}