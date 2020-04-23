<?php
/**
 * class Dashboard
 */
namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\{Controller, Erro, Session};
use Exception;
use Poupemais\App\Models\ClienteModel;
use Poupemais\App\Models\InvestimentoModel;
use Poupemais\Src\Lib\Dashboard;

class DashboardController extends Controller
{
  private Session $session;
  private Dashboard $dashboard;
  private ClienteModel $clienteModel;

  public function __construct()
  {
    parent::__construct();
    $this->session = new Session();
    $this->clienteModel = new ClienteModel();
    if(!isset($_SESSION['name']) || empty($_SESSION['name'] || !isset($_SESSION) || empty($_SESSION))){
      exit("<script>
          alert('Acesso negado. Efetue o login');
          window.location.href = '/login';
        </script>");
    }
  }
  
  public function index()
  {
    try {
      $this->session->verifyInsedeSession();

      $id =  $this->clienteModel->find("id", "nome", $_SESSION['name']);

      $this->dashboard = new Dashboard();
      $invests = $this->dashboard->listInvestAll($id->id);
      
      $this->view->render('header_dashboard','/dashboard/index',
        [
          'nome' => $_SESSION['name'], 
          "investimentos" => $invests
        ], 
      '');
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function investimento($id, $number)
  {
    $investModel = new InvestimentoModel;

    $invest = $investModel->findByID($number);   
  }
}