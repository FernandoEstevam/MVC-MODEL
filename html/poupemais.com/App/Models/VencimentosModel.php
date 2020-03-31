<?php

namespace Poupemais\App\Models;

use PDO;
use PDOException;
use Poupemais\Src\Lib\{Crud, Cliente, Investimento};
use Poupemais\Src\Core\Erro;

class VencimentosModel extends Crud
{

  public function cadastraVencimentos(Cliente $cliente, Investimento $id_investimento): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
      Erro::setErro("Valor passado inválido!");
    }

    try {
      # cadastra investimento
      foreach($cliente->getInvestimento()->getVencimentos() as $vencimento) {
        $this->query = $this->insertDB(
          "vencimentos(parcela,vencimento,valor,data_pagamento, situacao, id_investimento)",
          "?,?,?,?,?,?",
          array(
            $vencimento['parcela'],
            $vencimento['vencimento'],
            $vencimento['valor'],
            $vencimento['vencimento'],
            "aberto",
            $id_investimento,
          )
        );
      }
    } catch (PDOException $e) {
      exit(json_encode(
        array(
          "status" => "erro",
          "banco_dados" => $e->getMessage(),
          "query" => "Erro ao cadastrar vencimento"
        )
      ));
    }
  }

}