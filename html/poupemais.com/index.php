<?php
header('Content-Type: text/html; charset=utf-8');

require_once './vendor/autoload.php';

use Poupemais\Src\Core\{Route, Erro, ConexaoDB, Bind};

Bind::bind("connection", ConexaoDB::connect());

# Exibe erros
Erro::showErro();
$route = new Route();


