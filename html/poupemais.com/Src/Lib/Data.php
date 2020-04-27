<?php

namespace Poupemais\Src\Lib;

use Poupemais\Src\Core\Erro;

class Data
{

  public static function getDateAtual(): string
  {
    return date("d/m/Y");
  }

  public static function getFormatDate(): array
  {
    switch (date('N')) {
      case 1:
        return $data = [
          'semana' => "Domingo",
          'data' => date('d/m/Y')
        ];
        break;

      case 2:
        return $data = [
          'semana' => "Segunda-Feira",
          'data' => date('d/m/Y')
        ];
        break;

      case 3:
        return $data = [
          'semana' => "Terça-Feira",
          'data' => date('d/m/Y')
        ];
        break;

      case 4:
        return $data = [
          'semana' => "Quarta-Feira",
          'data' => date('d/m/Y')
        ];
        break;

      case 5:
        return $data = [
          'semana' => "Quinta-Feira",
          'data' => date('d/m/Y')
        ];
        break;

      case 6:
        return $data = [
          'semana' => "Sexta-Feira",
          'data' => date('d/m/Y')
        ];
        break;

      case 7:
        return $data = [
          'semana' => "Sábado",
          'data' => date('d/m/Y')
        ];
        break;

      default:
        Erro::setErro("Erro ao calcular a semana");
        break;
    }
  }
}
