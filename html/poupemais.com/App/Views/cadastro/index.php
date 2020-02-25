<?php
  if(!defined('DIR_ROOT')) exit('Acesso não autorizado!');
?>
<div class="container">
  <!-- Inicio formulario cadastro -->
  <form action="./cadastro/validateCadastro" method="post" id="form-cadastro" class="form">
    <h1>Cadastro Cliente</h1>
    <!-- Inicio fieldset Dados Pessoais -->
    <fieldset>
      <legend>Dados Pessoais</legend>
      <div class="group-input dados-pessoais">
        <div class="wrapp-input nome">
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" placeholder="digite seu nome" required/>
        </div>
        <div class="wrapp-input nascimento">
          <label for="nascimento">Dta. Nascimento</label>
          <input type="date" name="nascimento" id="nascimento" required min="1920-01-01" max="2002-01-01"/>
        </div>
        <div class="wrapp-input cpf">
          <label for="cpf">CPF</label>
          <input type="text" name="cpf" id="cpf" placeholder="xxx.xxx.xxx-xx" required />
        </div>
        <div class="wrapp-input rg">
          <label for="rg">RG</label>
          <input type="text" name="rg" id="rg" placeholder="xx.xxx.xxx-x" required/>
        </div>
        <div class="wrapp-input telefone">
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" id="telefone" required placeholder="(xx) xxxx-xxx"/>
        </div>
        <div class="wrapp-input estado-civil">
          <label for="estado-civil">Estado Civil</label>
          <select name="estado-civil" id="estado-civil" required>
            <option value="" selected disabled hidden>Estado Civil</option>
            <option value="casado">Casado</option>
            <option value="solteiro">Solteiro</option>
            <option value="divorciado">Divorciado</option>
            <option value="viuvo">Viúvo</option>
          </select>
        </div>
      </div>
    </fieldset>
    <!-- Fim fieldset Dados Pessoais -->
    <!-- Inicio fieldset Endereco -->
    <fieldset>
      <legend>Endereço</legend>
      <div class="group-input endereco">
        <div class="wrapp-input cep">
          <label for="cep">CEP</label>
          <input type="text" name="cep" maxlength="9" minlength="8" id="cep" required placeholder="xxxxx-xxx"/>
        </div>
        <div class="wrapp-input rua">
          <label for="logradouro">Rua</label>
          <input type="text" name="logradouro" id="logradouro" readonly required placeholder="Lougradouro"/>
        </div>
        <div class="wrapp-input numero">
          <label for="numero">N.º</label>
          <input type="text" name="numero" id="numero" required placeholder="numero"/>
        </div>
        <div class="wrapp-input complemento">
          <label for="complemento">Compl.</label>
          <input type="text" name="complemento" id="complemento" placeholder="Compl."/>
        </div>
        <div class="wrapp-input bairro">
          <label for="bairro">bairro</label>
          <input type="text" name="bairro" id="bairro" readonly required placeholder="bairro"/>
        </div>
        <div class="wrapp-input cidade">
          <label for="cidade">Cidade</label>
          <input type="text" name="cidade" id="cidade" readonly required placeholder="Cidade"/>
        </div>
        <div class="wrapp-input uf">
          <label for="uf">UF</label>
          <input type="text" name="uf" id="uf" readonly required  placeholder="UF"/>
        </div>
      </div>
    </fieldset>
    <!-- Fim fieldset Endereco -->
    <!-- Inicio fieldset Usuario e senha -->
    <fieldset>
      <legend>Usuário e Senha</legend>
      <div class="group-input usuario-senha">
        <div class="wrapp-input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="email@email.com" required/>
        </div>
        <div class="wrapp-input">
          <label for="conf-email">Confirmação Email</label>
          <input type="email" name="conf-email" id="conf-email" placeholder="email@email.com" required/>
        </div>
        <div class="wrapp-input">
          <label for="password">Senha</label>
          <input type="password" name="password" id="password" placeholder="digite sua senha" required/>
        </div>
        <div class="wrapp-input">
          <label for="conf-password">Confirmação Senha</label>
          <input type="password" name="conf-password" id="conf-password" placeholder="confirme sua senha" required/>
        </div>
      </div>
    </fieldset>
    <!-- Fim fieldset Usuario e senha -->
    <!-- Inicio fieldset Investimento -->
    <fieldset>
      <legend>Investimento</legend>
      <div class="group-input investimento">
        <div class="wrapp-input plano">
          <label for="plano">Planos</label>
          <select name="plano" id="plano" required>
            <option value="" selected disabled hidden>Planos</option>
            <option value="6">6 Meses</option>
            <option value="9">9 Meses</option>
            <option value="12">12 Meses</option>
          </select>
        </div>
        <div class="wrapp-input valor">
          <label for="valor">Valor</label>
          <input type="text" name="valor" id="valor" required placeholder="R$ 0,00"/>
        </div>
        <div class="wrapp-input vencimento">
          <label for="vencimento">Vencimento</label>
          <select name="vencimento" id="vencimento" required>
            <option value="" selected disabled hidden>Vencimento</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
          </select>
        </div>
        <div class="wrapp-input aporte">
          <label for="aporte">Aportes</label>
          <div class="group-aporte">
            <div class="group-aporte-input">
              <input type="radio" name="aporte" id="aporte-mensal" value="1" checked/>
              <label for="aporte-mensal">Mensal</label>
            </div>
            <div class="group-aporte-input">
              <input type="radio" name="aporte" id="aporte-unico" value="2" />
              <label for="aporte-unico">Único</label>
            </div>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="wrapp-input response">
      <span id="response"></span>
    </div>
    <!-- Fim fieldset Investimento -->
    <!-- Inicio fieldset Aceite termos -->
    <div class="wrapp-input termos">
      <input type="checkbox" name="termo-condicao" id="termo-condicao" required/>
      <a href="#">Aceito termo de condição</a>
    </div>
    <!-- Fim fieldset Aceite termos -->
    <button type="submit" class="btn btn-cadastro">Cadastrar</button>
  </form>
  <!-- Fim fieldset formulario cadastro -->
</div>
<script src="<?= DIR_JS ?>consulta-cep.js"></script>