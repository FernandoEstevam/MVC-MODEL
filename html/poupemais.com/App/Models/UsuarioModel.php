<?php

/**
 * class Usuario DB
 * retorna dados do usuarios
 */

namespace Poupemais\App\Models;

use PDO;
use PDOException;
use Poupemais\Src\Lib\{Crud, Cliente};
use Poupemais\Src\Core\Erro;

class UsuarioModel extends Crud 
{
  private $query;

  # Select Usuario pelo ID
  public function findById(int $id): array
  {
    try {
      $this->query = $this->selectDB(
        "id,email,status",
        "usuarios",
        "WHERE id = ?",
        array($id)
      );
     
      $row = $this->query->rowCount();
      if($row == 0) {
        Erro::setErro("Nenhum registro encontrado!");
      }
      $retorno = $this->query->fetch(PDO::FETCH_ASSOC);
      
      return $retorno;

    } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }

  # Select All Usuario
  public function find(): array
  {
    try {
      $this->query = $this->selectDB(
        "id,email,status",
        "usuarios",
        "",
        array()
      );

      $retorno = $this->query->fetchAll(PDO::FETCH_ASSOC);

      $row = $this->query->rowCount();
      if($row == 0) {
        Erro::setErro("Nenhum registro encontrado!");
      }
      return $retorno;

    } catch (PDOException $e) {
      exit(Erro::setErro($e->getMessage()));
    }
  }

  # Select pelo email
  public function existUser(string $email): bool
  {
    $this->query = $this->selectDB(
      "email",
      "usuarios",
      "WHERE email = ?",
      array($email)
    );

    $row = $this->query->rowCount();
    if($row > 0) {
      return false;
    }
    return true;
  }

  # Cadastro usuario
  public function save(Cliente $cliente): void
  {
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
      exit(Erro::setErro($e->getMessage()));
    }
  }
}