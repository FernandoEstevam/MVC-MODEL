<?
/**
 * class View Model
 * serve para adicionar conteudo na view
 */
namespace Poupemais\Src\Lib;

use PDO;
use Poupemais\Src\Core\Erro;
use Poupemais\Src\Lib\Crud;

class ViewModel extends Crud
{
  private Object $viewDados;

  public function selectAllPlano(): array
  {
    $this->viewDados = $this->selectDB("*","planos","",array());

    $consulta = $this->viewDados->fetchAll(PDO::FETCH_ASSOC);

    $row = $this->viewDados->rowCount();

    if($row == 0) {
      Erro::setErro("Nenhum registro encontrado!");
    }
    return $consulta;
  }
}