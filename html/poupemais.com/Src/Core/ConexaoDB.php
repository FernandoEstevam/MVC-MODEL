<?php
/**
 * class PDO - Conexao Banco de dados
 */
namespace Poupemais\Src\Core;
use PDO;
use PDOException;

class ConexaoDB
{
  protected PDO $conn;

  public function __construct() 
  {
    # Conexao banco de dados
    try {
      $this->conn = new PDO(
        DATA_LAYER_CONFIG['driver'].":host=".DATA_LAYER_CONFIG['host'].";dbname=".DATA_LAYER_CONFIG['dbname'],
        DATA_LAYER_CONFIG['username'],
        DATA_LAYER_CONFIG['passwd'],
        DATA_LAYER_CONFIG['options']
      );
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }
}