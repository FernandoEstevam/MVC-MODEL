<?php

namespace Poupemais\App\Controllers;

use Poupemais\Src\Core\Controller;
use Exception;

class HomeController extends Controller
{
  public function index()
  {
    try {
      $this->view->render('','/home/index',[], '');
    } catch (Exception $e) {
      exit($e->getMessage());
    }
  }
}