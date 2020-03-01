<?php
/**
 * class Cadastro Model
 */

namespace Poupemais\App\Models;

use Poupemais\Src\Core\Erro;
use Poupemais\Src\Lib\{Cliente,Crud};
use PDO;
use PDOException;

class CadastroDB extends Crud
{
  private $query;

  public function cadastraUsuario(Cliente $cliente): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
      Erro::setErro("Valor passado inválido!");
    }
    try {
      $this->query = $this->insertDB(
        "usuarios(email,senha,data_cadastro,status)",
        "?,?,?,?",
        array(
          $cliente->getUsuario()->getLogin(),
          $cliente->getUsuario()->getPasswd(),
          $cliente->getUsuario()->getDataCadastro(),
          "ativo"
        )
      );
     } catch (PDOException $e) {
      echo json_encode(
        array(
          "status" => "erro",
          "dados" => $e->getMessage()
        )
      );
    }
  }

  # Retorna id
  public function selectID(string $table, string $condicao, string $value): int
  {
    try {
      $this->query = $this->selectDB(
        "id",
        $table,
        "where {$condicao} = ?",
        array(
          $value
        ),
      );
      $consulta = $this->query->fetch(PDO::FETCH_ASSOC);
  
      $row = $this->query->rowCount();
  
      if($row == 0) {
        Erro::setErro("Nenhum registro encontrado!");
      }
      return $consulta['id'];
    } catch (PDOException $e) {
      echo json_encode(
        array(
          "status" => "erro",
          "dados" => $e->getMessage()
        )
      );
    }
  } 
}