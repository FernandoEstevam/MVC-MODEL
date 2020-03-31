<?php
/**
 * class Cadastro Model
 */

namespace Poupemais\App\Models;

use Poupemais\Src\Core\Erro;
use Poupemais\Src\Lib\{Cliente,Crud};
use PDOException;
use PDO;

class CadastroModel extends Crud
{
  private $query;

  # Retorna id
  private function selectID(string $table, string $condicao, string $value): int
  {
    try {
      $this->query = $this->selectDB(
        "id",
        $table,
        "where {$condicao} = ?",
        array(
          $value
        ),
      );
      $id = $this->query->fetch(PDO::FETCH_ASSOC);
  
      $row = $this->query->rowCount();
  
      if($row == 0) {
        Erro::setErro("Nenhum registro encontrado!");
      }
      return $id['id'];
    } catch (PDOException $e) {
      exit(json_encode(
        array(
          "status" => "erro",
          "banco_dados" => $e->getMessage(),
          "query" => "Erro ao selecionar ID"
        )
      ));
    }
  }

  # Cadastro usuario
  public function cadastraUsuario(Cliente $cliente): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
      Erro::setErro("Valor passado inválido!");
    }
    try {
      $this->query = $this->insertDB(
        "usuarios(email,senha,data_cadastro,status)",
        "?,?,?,?",
        array(
          $cliente->getUsuario()->getLogin(),
          $cliente->getUsuario()->getPasswd(),
          $cliente->getUsuario()->getDataCadastro(),
          "ativo"
        )
      );
     } catch (PDOException $e) {
      exit(json_encode(
        array(
          "status" => "erro",
          "banco_dados" => $e->getMessage(),
          "query" => "Erro ao cadastrar usuario"
        )
      ));
    }
  }

  # Cadastro cliente
  public function cadastraCliente(Cliente $cliente): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
      Erro::setErro("Valor passado inválido!");
    }

    try {
      # Retorno id 
      $id_usuario = $this->selectID("usuarios","email",$cliente->getUsuario()->getLogin());
      # cadastra cliente
      $this->query = $this->insertDB(
        "clientes(nome,data_nascimento,cpf,rg,estado_civil,telefone, endereco, numero,complemento, bairro,cep, cidade,uf,id_usuario)",
        "?,?,?,?,?,?,?,?,?,?,?,?,?,?",
        array(
          $cliente->getNome(),
          $cliente->getDataNasc(),
          $cliente->getCPF()->getCPF(),
          $cliente->getRG(),
          $cliente->getEstadoCivil(),
          $cliente->getTelefone(),
          $cliente->getEndereco()->getlogradouro(),
          $cliente->getEndereco()->getNumero(),
          $cliente->getEndereco()->getCompl(),
          $cliente->getEndereco()->getBairro(),
          $cliente->getEndereco()->getCep(),
          $cliente->getEndereco()->getCidade(),
          $cliente->getEndereco()->getUf(),
          $id_usuario
        )
      );
    } catch (PDOException $e) {
      exit(json_encode(
        array(
          "status" => "erro",
          "banco_dados" => $e->getMessage(),
          "query" => "Erro ao cadastrar cliente"
        )
      ));
    }
  }

  # Cadastro investimento
  public function cadastraInvestimento(Cliente $cliente): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
      Erro::setErro("Valor passado inválido!");
    }
    
    try {
      # Retorno id 
      $id_cliente = $this->selectID("clientes","nome",$cliente->getNome());
      # cadastra investimento
      $this->query = $this->insertDB(
        "investimentos(valor,data_contratacao,situacao,id_cliente,id_plano,id_aporte)",
        "?,?,?,?,?,?",
        array(
          $cliente->getInvestimento()->getValorPlano(),
          $cliente->getInvestimento()->getDataContratacao(),
          "aberto",
          $id_cliente,
          $cliente->getInvestimento()->getPlano(),
          $cliente->getInvestimento()->getAporte()
        )
      );
    }catch (PDOException $e) {
      exit(json_encode(
        array(
          "status" => "erro",
          "banco_dados" => $e->getMessage(),
          "query" => "Erro ao cadastrar investimento"
        )
      ));
    }

  }

  # Cadastro investimento
  public function cadastraVencimentos(Cliente $cliente): void
  {
    # Inserir roll comit mysql
    if(!is_object($cliente)) {
      Erro::setErro("Valor passado inválido!");
    }
    
    try {
      # Retorno id 
      $id_investimento = $this->selectID("investimentos","id_cliente",
        $this->selectID("clientes","nome",$cliente->getNome())
      );

      # cadastra investimento
      foreach($cliente->getInvestimento()->getVencimentos() as $vencimento) {
        $this->query = $this->insertDB(
          "vencimentos(parcela,vencimento,valor,data_pagamento, situacao, id_investimento)",
          "?,?,?,?,?,?",
          array(
            $vencimento['parcela'],
            $vencimento['vencimento'],
            $vencimento['valor'],
            $vencimento['vencimento'],
            "aberto",
            $id_investimento,
          )
        );
      }
    } catch (PDOException $e) {
      exit(json_encode(
        array(
          "status" => "erro",
          "banco_dados" => $e->getMessage(),
          "query" => "Erro ao cadastrar vencimento"
        )
      ));
    }
  }
}