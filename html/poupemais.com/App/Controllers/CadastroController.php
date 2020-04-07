<?php
/**
 * class CadastroController
 */

namespace Poupemais\App\Controllers;

use Exception;
use Poupemais\App\Models\{ClienteModel, UserModel, InvestimentoModel, VencimentosModel};
use Poupemais\Src\Core\{Controller, Erro, ValidaDados};
use Poupemais\Src\Lib\{CPF,Endereco, Investimento, Usuario, PlanoView,Cliente, Transaction};

class CadastroController extends Controller
{
  private PlanoView $showPlanos;
  private Transaction $transaction;  
  private Cliente $cliente;
  
  public function __construct()
  {
    parent::__construct();
    $this->showPlanos = new PlanoView;
  } 

  public function index()
  { 
    try {      
      $planos = $this->showPlanos->all();
      $this->view->render('','cadastro/index',['planos' => $planos],'');
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
    $this->transaction = new Transaction;
    
    $this->transaction->transactions(function() use($cliente) {
      # Cadastra Usuario
      $this->transaction->model(UserModel::class)->insert($cliente->getUsuario()->getInsert());

      # Cadastra Cliente
      $user = (new UserModel)->find("id","email",$cliente->getUsuario()->getLogin());
      $this->transaction->model(ClienteModel::class)->insert($cliente->getInsert($user->id));

      # Cadastra Invetimento
      $clt = (new ClienteModel)->find("id","cpf",$cliente->getCPF()->getCPF());
      $this->transaction->model(InvestimentoModel::class)->insert($cliente->getInvestimento()->getInsert($clt->id));
      
      # Cdadastra Vencimentos
      $id_invest = (new InvestimentoModel)->find("id","id_cliente",$clt->id);
      $vecimentos = $cliente->getInvestimento()->getVencimentos();  
        foreach($vecimentos as $vecimento) {
          $this->transaction->model(VencimentosModel::class)->insert(
            [
              "parcela" => $vecimento["parcela"],
              "vencimento" => $vecimento["vencimento"],
              "valor" => $vecimento["valor"],
              "data_pagamento" => null,
              "situacao" => "aberto",
              "id_investimento" => $id_invest->id,
            ]
          );
        }
    });
  }
}