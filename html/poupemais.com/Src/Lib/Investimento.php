<?php
/**
 * class Investimento
 */

namespace Poupemais\Src\Lib;

use Poupemais\Src\Core\ValidaDados;
use Poupemais\Src\Core\Erro;
use Exception;

class Investimento extends ValidaDados
{
  private string $plano;
  private float $valorPlano;
  private array $vencimento;
  
  public function __construct(string $plano, float $valorPlano, string $dataPrimeiraParcela=null)
  {
    $this->plano = $this->converInt($plano);
    $this->valorPlano = $valorPlano;
    $this->vencimento = $this->vencimentos($this->plano, $this->valorPlano, $dataPrimeiraParcela);

  }
    
  # Cria vencimentos baseado no plano e valor
  private function vencimentos(int $nParcelas, float $v, string $dataPrimeiraParcela=null): array 
  {
    if(!isset($nParcelas) || !isset($v)) {
      if(empty($nParcelas) || empty($v))
      Erro::setErro("Informar número de parcelas, valor e data da primeira parcela");
    }

    $vencimentos = [];

    $parcela = ['A','B','C','D','E','F','G','H','I','J','K','L'];
    
    if($dataPrimeiraParcela != null){
        $dia = $dataPrimeiraParcela;
        $mes = date("m");
        $ano = date("Y");
    } else {
        $dia = date("d");
        $mes = date("m");
        $ano = date("Y");
    }
    
    for($x = 0; $x < $nParcelas; $x++){
        $dado = date("Y/m/d",strtotime("+".$x." month",mktime(0, 0, 0,$mes,$dia,$ano)));
        $valor = $v; 
        array_push($vencimentos, ['parcela' => $parcela[$x] , 'vencimento' => $dado ,'valor'=>$valor]); 
    }
    return $vencimentos;
  }

  # Getters
  public function getPlano(): int
  {
    return $this->plano . "Meses";
  }
  public function getVencimentos(): array
  {
    return $this->vencimento;
  }

  public function getValorPlano(): float 
  {
    return $this->valorPlano;
  }
  

}