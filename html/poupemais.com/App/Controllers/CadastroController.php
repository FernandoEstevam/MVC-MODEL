<?php
/**
 * class CadastroController
 */

namespace Poupemais\App\Controllers;

use Exception;
use Poupemais\App\Models\{CadastroModel, InvestimentoModel, UsuarioModel};
use Poupemais\Src\Core\{Controller, Erro, ValidaDados};
use Poupemais\Src\Lib\{CPF,Endereco, Investimento, Usuario, ViewModel,Cliente};

class CadastroController extends Controller
{
  private Cliente $cliente;
  private ViewModel $viewDados;
  private CadastroModel $cad_db;

  public function index()
  { 
    try {
      $this->viewDados = new ViewModel();
      $plano = $this->viewDados->selectAllPlano();
      $this->view->render('','cadastro/index',['planos' => $plano],'');
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function validateCadastro():void
  {
    try {
      
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
      $this->cadastrado($this->cliente); 
      Erro::setSuccess("Cadastro efetuado com sucesso");
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  # Cadastro no banco de dados 
  private function cadastrado (Cliente $cliente): void
  {    
    if(!$this->user_db->existUser($cliente->getUsuario()->getLogin())) {
      Erro::setErro("Usuário já cadastrado!");
    }    
    
    (new UsuarioModel())->save($cliente);
    $id = (new InvestimentoModel())->save($cliente)->findByLastID();
    var_dump($id); 
    
    $this->cad_db = new CadastroModel();
    $this->cad_db->cadastraCliente($cliente);
    $this->cad_db->cadastraInvestimento($cliente);
    $this->cad_db->cadastraVencimentos($cliente);
  }
}