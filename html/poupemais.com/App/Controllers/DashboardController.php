<?php

/**
 * class Dashboard
 */

namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\{Controller, Erro, Session};
use Exception;
use Poupemais\App\Models\ClienteModel;
use Poupemais\App\Models\InvestimentoModel;
use Poupemais\Src\Lib\{Dashboard, Data};

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
    $this->dashboard = new Dashboard();
    if (!isset($_SESSION['name']) || empty($_SESSION['name'] || !isset($_SESSION) || empty($_SESSION))) {
      exit("<script>
          alert('Acesso negado. Efetue o login');
          window.location.href = '/login';
        </script>");
    }
  }

  public function index(): void
  {
    try {
      $this->session->verifyInsedeSession();

      $id =  $this->clienteModel->find("id", "nome", $_SESSION['name']);

      $invests = $this->dashboard->listInvestAll($id->id);

      $this->view->render(
        'header_dashboard',
        '/dashboard/index',
        [
          'data_atual' => Data::getFormatDate(),
          'nome' => $_SESSION['name'],
          "investimentos" => $invests
        ],
        'footer_dashboard'
      );
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function aberto(): void
  {
    try {
      $this->session->verifyInsedeSession();

      $aberto = $this->dashboard->listInvestAberto($_SESSION['name']);

      $this->view->render(
        'header_dashboard',
        '/dashboard/aberto',
        [
          'nome' => $_SESSION['name'],
          "titulos" => $aberto
        ],
        ''
      );
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function vencidos(): void
  {
    try {
      $this->session->verifyInsedeSession();

      $vencidos = $this->dashboard->listInvestVencidos($_SESSION['name']);

      $this->view->render(
        'header_dashboard',
        '/dashboard/vencidos',
        [
          'nome' => $_SESSION['name'],
          "titulos" => $vencidos
        ],
        'footer_dashboard'
      );
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function liquidados(): void
  {
    try {
      $this->session->verifyInsedeSession();

      $liquidados = $this->dashboard->listInvestLiquidado($_SESSION['name']);

      $this->view->render(
        'header_dashboard',
        '/dashboard/liquidado',
        [
          'nome' => $_SESSION['name'],
          "titulos" => $liquidados
        ],
        'footer_dashboard'
      );
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function investimento(int $id): void
  {
    try {
      $this->session->verifyInsedeSession();

      $titulo = $this->dashboard->listInvestTitulo($id);

      $this->view->render(
        'header_dashboard',
        '/dashboard/investimento',
        [
          'nome' => $_SESSION['name'],
          "titulos" => $titulo
        ],
        ''
      );
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function investir(): void
  {
    try {
      $this->session->verifyInsedeSession();

      $this->view->render(
        'header_dashboard',
        '/dashboard/investir',
        [
          'nome' => $_SESSION['name'],
        ],
        'footer_dashboard'
      );

      $this->dashboard->insertInvestimento();
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }

  public function validaInvestimento()
  {
    Erro::setSuccess("Investimento realizado com sucesso!");
  }
}
