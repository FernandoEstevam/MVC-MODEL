<?php

namespace Poupemais\Src\Lib;

use Poupemais\App\Models\InvestimentoModel;


class Dashboard 
{
  public function listInvestAll($id)
  { 
    $invest = (new InvestimentoModel)->findAll("id, valor, data_contratacao,situacao", "id_cliente",$id);
    return $invest;
  }
}