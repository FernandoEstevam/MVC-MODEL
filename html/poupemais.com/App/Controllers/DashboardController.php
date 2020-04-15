<?php
/**
 * class Dashboard
 */
namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\{Controller, Erro, Session};
use Exception;

class DashboardController extends Controller
{
  private Session $session;

  public function __construct()
  {
    parent::__construct();
    $this->session = new Session();
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
      $this->view->render('','/dashboard/index',['nome' => $_SESSION['name'],'login' => $_SESSION['email']], '');
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }
}