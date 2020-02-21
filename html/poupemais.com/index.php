<?php
header('Content-Type: text/html; charset=utf-8');

require_once './vendor/autoload.php';
require_once './config/config.php';

use Poupemais\Src\Core\{Route, Erro};

# Exibe erros
Erro::showErro();
$route = new Route();


