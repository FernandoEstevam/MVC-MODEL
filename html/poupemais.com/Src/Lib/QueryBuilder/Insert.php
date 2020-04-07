<?php

namespace Poupemais\Src\Lib\QueryBuilder;

use Poupemais\Src\Core\Model;

class Insert extends Model
{
  public static function sql(string $table, array $arguments): string
  {
    $sql = "INSERT INTO {$table}(";

    $sql .= implode(", ", array_keys($arguments)) .") VALUES (:";

    $sql .= implode(", :", array_keys($arguments)) . ")";

    return $sql;
  } 
}