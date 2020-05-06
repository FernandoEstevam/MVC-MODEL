<?php

namespace Poupemais\Src\Lib;

use Poupemais\App\Models\InvestimentoModel;
use Poupemais\App\Models\VencimentosModel;

class Dashboard
{
  final public function listInvestAll($id): array
  {
    $invest = (new InvestimentoModel)->findAll("id, valor, data_contratacao,situacao", "id_cliente", $id);
    return $invest;
  }

  final public function listInvestAberto(string $nome): array
  {
    $aberto = (new VencimentosModel)->listVencimento($nome, "v.vencimento >= CURRENT_DATE() AND v.situacao = 'aberto'", "Não existe nenhum titulo em aberto.");
    return $aberto;
  }

  final public function listInvestVencidos(string $nome): array
  {
    $vencidos = (new VencimentosModel)->listVencimento($nome, "v.vencimento < CURRENT_DATE()", "Não existe nenhum titulo em vencido.");
    return $vencidos;
  }

  final public function listInvestLiquidado(string $nome): array
  {
    $liquidados = (new VencimentosModel)->listVencimento($nome, "v.situacao = 'pago'", "Não existe nenhum titulo liquidado.");
    return $liquidados;
  }

  final public function listInvestTitulo(int $id): array
  {
    $titulo = (new VencimentosModel)->findAll("parcela, vencimento, valor, data_pagamento, situacao", "id_investimento", $id);
    return $titulo;
  }

  final public function insertInvestimento(): void
  {
  }
}
