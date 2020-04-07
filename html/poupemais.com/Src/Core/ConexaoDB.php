<?php
/**
 * class PDO - Conexao Banco de dados
 */
namespace Poupemais\Src\Core;

class ConexaoDB
{
  public static function connect(): object 
  {
    # Conexao banco de dados
    try {
      return new \PDO(
        DATA_LAYER_CONFIG['driver'].":host=".DATA_LAYER_CONFIG['host'].";dbname=".DATA_LAYER_CONFIG['dbname'],
        DATA_LAYER_CONFIG['username'],
        DATA_LAYER_CONFIG['passwd'],
        DATA_LAYER_CONFIG['options']
      );
    } catch (\PDOException $e) {
      exit($e->getMessage());
    }
  }
}