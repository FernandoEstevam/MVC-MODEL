<?php

namespace Poupemais\App\Models;

use Poupemais\Src\Core\Model;
use Poupemais\Src\Core\Erro;


class VencimentosModel extends Model
{
  protected $table = "vencimentos";

  final public function listVencimento(string $nome, string $condicao): array
  {
    $sql = "SELECT v.parcela, v.valor, v.vencimento, v.data_pagamento, v.situacao FROM vencimentos AS v 
      INNER JOIN investimentos AS i ON v.id_investimento = i.id
      INNER JOIN clientes AS c ON i.id_cliente = c.id
      WHERE c.nome = '{$nome}' AND {$condicao}";

    $stmt = $this->connection->prepare($sql);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      Erro::setErro("Nenhum registro encontrado.");
    }

    return $stmt->fetchAll();
  }
}
