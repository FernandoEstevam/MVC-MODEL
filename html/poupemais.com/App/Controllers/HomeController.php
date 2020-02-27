<?php

namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\{Controller,Erro};
use Poupemais\Src\Lib\{Cliente, Usuario, Endereco, CPF, Investimento};
use Exception;

class HomeController extends Controller
{
  private Cliente $cliente;

  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    try {
      $this->view->render('','/home/index',['nome' => 'Fernando Estevam'], '');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function arrayInputs(array $post): array
  {
    if(!isset($post) || empty($post) || !is_array($post)) {
      Erro::setErro("Dados inválidos!");
    }
    return $post;
  }

  public function cadastrar(): void
  {
    // $_POST['login'] = "fernandoestevam@gmail.com";
    // $_POST['conf_email'] = "fenranoestevam@gmail.com";
    // $_POST['passwd'] = "odnanref709244";
    // $_POST['confPasswd'] = "odnanref709244";
    // $_POST['nome'] = "fernando antonio estevam";
    // $_POST['cpf'] = "323.322.808-20";
    // $_POST['rg'] = "40.633.778-0";
    // $_POST['dataNasc'] = '23/07/1985';
    // $_POST['estadoCivil'] = "casado";
    // $_POST['telefone'] = "(11) 9.9582-1424";
    // $_POST['cep'] = "08253-655";
    // $_POST['rua'] = 'Rua Jacaré-Copaiba';
    // $_POST['numero'] = '171';
    // $_POST['bairro'] = 'Vila Marina';
    // $_POST['cidade'] = 'São Paulo';
    // $_POST['uf'] = 'sp';
    // $_POST['plano'] = 6;

    // $input = $this->arrayInputs($_POST);

    // $this->cliente = new Cliente(
    //   new Usuario(
    //     $input['login'], 
    //     $input['passwd'], null, $input['confPasswd']), 
    //   new Endereco($input['cep'], 
    //     $input['rua'], 
    //     $input['numero'],
    //     $input['bairro'], 
    //     $input['cidade'], 
    //     $input['uf']),
    //   new CPF($input['cpf']),
    //   $input['nome'],
    //   $input['rg'],
    //   $input['dataNasc'],
    //   $input['estadoCivil'],
    //   $input['telefone'],
    //   new Investimento(
    //   "6 meses",
    //   200.00,
    //   1,
    //   "5")
    // );
    try {
    //   echo json_encode(
    //     array(
    //       "status" => "success",
    //       "dados" => "Dados cadastrado com sucesso!"
    //     ),1);
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }
}