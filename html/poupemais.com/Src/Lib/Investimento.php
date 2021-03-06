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
  private int $plano;
  private float $valorPlano;
  private array $vencimento;
  private int $aporte;
  private string $dataPrimeiraParcela;
  private string $data_contratacao;

  public function __construct(string $plano, float $valorPlano, int $aporte, string $dataPrimeiraParcela)
  {
    try {
      $this->plano = $this->validaInput($plano);
      $this->valorPlano = $this->validaInput($valorPlano);
      $this->dataPrimeiraParcela = $this->validaInput($dataPrimeiraParcela);
      $this->aporte = $this->validaInput($aporte);
      $this->vencimento = $this->vencimentos($this->plano, $this->valorPlano, $this->aporte, $this->dataPrimeiraParcela);
      $this->data_contratacao = date("Y-m-d");
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }
    
  # Cria vencimentos baseado no plano e valor
  private function vencimentos(int $nParcelas, float $v, int $aporte, string $dataPrimeiraParcela): array 
  {
    if(!isset($nParcelas) || !isset($v) || !isset($aporte)) {
      if(empty($nParcelas) || empty($v) || empty($aporte)) {
        Erro::setErro("Informar número de parcelas, valor e data da primeira parcela");
      }
      Erro::setErro("Informar número de parcelas, valor e data da primeira parcela");
    }

    $vencimentos = [];

    $parcela = ['A','B','C','D','E','F','G','H','I','J','K','L'];
    
    switch ($this->plano) {
      case 1:
        $nParcelas = 6;
      break;
      case 2:
        $nParcelas = 9;
      break;
      case 3:
        $nParcelas = 12;
      break;
      default:
      $nParcelas = 1;
      break;
    }
    if($aporte === 2) $nParcelas = 1;
    
    $dia = $dataPrimeiraParcela;
    $mes = date("m");
    $ano = date("Y");
    
    for($x = 0; $x < $nParcelas; $x++){
      $dado = date("Y-m-d",strtotime("+".($x+1)." month",mktime(0, 0, 0,$mes,$dia,$ano)));
      $valor = $v; 
      array_push($vencimentos, ['parcela' => $parcela[$x] , 'vencimento' => $dado ,'valor'=>$valor]); 
    }
    return $vencimentos;
  }

  # Getters
  public function getPlano(): int
  {
    return $this->plano;
  }
  public function getVencimentos(): array
  {
    return $this->vencimento;
  }

  public function getValorPlano(): float 
  {
    return $this->valorPlano;
  }

  public function getDataContratacao(): string
  {
    return $this->data_contratacao;
  }

  public function getAporte(): string
  {
    return $this->aporte;
  }

  public function getInsert(int $id_cliente): array
  {
    return [
      "valor" => $this->getValorPlano(),
      "data_contratacao" => $this->getDataContratacao(),
      "situacao" => "aberto",
      "id_cliente" => $id_cliente,
      "id_plano" => $this->getPlano(),
      "id_aporte" => $this->getAporte()
    ];
  }
} 