<?php
/**
 * class CadastroController
 */

namespace Poupemais\App\Controllers;
use Poupemais\Src\Core\Controller;

class CadastroController extends Controller
{
  public function index()
  {
    $this->view->render('','cadastro/index',[],'');
  }

  public function validateCadastro()
  {
    var_dump($_POST);
  }
}