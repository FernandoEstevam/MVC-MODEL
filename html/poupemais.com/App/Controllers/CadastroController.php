<?php
/**
 * class CadastroController
 */

namespace Poupemais\App\Controllers;

use Exception;
use Poupemais\Src\Core\Controller;
use Poupemais\Src\Core\ValidaDados;
use Poupemais\Src\Lib\Cliente;
use Poupemais\Src\Lib\CPF;
use Poupemais\Src\Lib\Endereco;
use Poupemais\Src\Lib\Investimento;
use Poupemais\Src\Lib\Usuario;
use Poupemais\Src\Lib\ViewModel;

class CadastroController extends Controller
{
  private Cliente $cliente;
  private ViewModel $viewDados;
  
  public function index()
  { 
    try {
      $this->viewDados = new ViewModel();
      $plano = $this->viewDados->selectAllPlano();
      $this->view->render('','cadastro/index',['planos' => $plano],'');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function validateCadastro():void
  {
    ValidaDados::verificaCampos($_POST);

    $this->cliente = new Cliente(
      new Usuario(
       $_POST['email'],
       $_POST['password'],
       $_POST['conf-email'],
       $_POST['conf-password'] 
      ),
      new Endereco(
        $_POST['cep'],
        $_POST['logradouro'],
        $_POST['numero'],
        $_POST['bairro'],
        $_POST['cidade'],
        $_POST['uf'],
        $_POST['complemento']
      ),
      new CPF(
        $_POST['cpf']
      ),
      $_POST['nome'],
      $_POST['rg'],
      $_POST['nascimento'],
      $_POST['estado-civil'],
      $_POST['telefone'],
      new Investimento(
        $_POST['plano'],
        $_POST['valor'],
        $_POST['aporte'],
        $_POST['vencimento'],
      )
    );

    echo "<pre>";
    print_r($this->cliente->getInvestimento());
  }
}