<?php
  if(!defined('DIR_ROOT')) exit('Acesso não autorizado!');
?>
<form action="#" method="post" id="form-cadastro">
  <legend>Cadastro Cliente</legend>
  
  <div class="wrapp-input">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" placeholder="digite seu nome"/>
  </div>
  
  <div class="wrapp-input">
    <label for="cpf">CPF</label>
    <input type="text" name="cpf" id="cpf" />
  </div>
  
  <div class="wrapp-input">
    <label for="rg">RG</label>
    <input type="text" name="rg" id="rg" />
  </div>
  
  <div class="wrapp-input">
    <label for="nascimento">Dta. Nascimento</label>
    <input type="date" name="nascimento" id="nascimento" />
  </div>
  
  <div class="wrapp-input">
  <label for="estado-civil">Estado Civil</label>
    <select name="estado-civil" id="estado-civil">
      <option value="" selected disabled hidden>Estado Civil</option>
      <option value="casado">Casado</option>
      <option value="solteiro">Solteiro</option>
      <option value="viuvo">Viúvo</option>
      <option value="divorciado">Divorciado</option>
    </select>
  </div>

  <div class="wrapp-input">
    <label for="cep">CEP</label>
    <input type="text" name="cep" id="cep" />
  </div>
  
  <div class="wrapp-input">
    <label for="rua">Rua</label>
    <input type="text" name="rua" id="rua" />
  </div>
  
  <div class="wrapp-input">
    <label for="numero">N.º</label>
    <input type="text" name="numero" id="numero" />
  </div>

  <div class="wrapp-input">
    <label for="complemento">Compl.</label>
    <input type="text" name="complemento" id="complemento" />
  </div>

  <div class="wrapp-input">
    <label for="cidade">Cidade</label>
    <input type="text" name="cidade" id="cidade" />
  </div>

  <div class="wrapp-input">
    <label for="UF">N.º</label>
    <input type="text" name="UF" id="UF" />
  </div>

  <div class="wrapp-input">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" />
  </div>

  <div class="wrapp-input">
    <label for="password">Senha</label>
    <input type="password" name="password" id="password" />
  </div>

  <div class="wrapp-input">
    <label for="conf-password">Confirmação Senha</label>
    <input type="password" name="conf-password" id="conf-password" />
  </div>

  <div class="wrapp-input">
    <label for="plano">N.º</label>
    <select name="planos" id="plano">
      <option value="" selected disabled hidden>Planos</option>
      <option value="1">6 Meses</option>
      <option value="2">9 Meses</option>
      <option value="3">12 Meses</option>
    </select>
  </div>

  <div class="wrapp-input">
    <label for="valor">Confirmação Senha</label>
    <input type="text" name="valor" id="valor" />
  </div>

  <div class="wrapp-input">
    <label for="conf-password">Confirmação Senha</label>
    <input type="password" name="conf-password" id="conf-password" />
  </div>

  <div class="wrapp-input">
    <label for="vencimento">N.º</label>
    <select name="vencimento" id="vencimento">
      <option value="" selected disabled hidden>Vencimento</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
      <option value="25">25</option>
      <option value="30">30</option>
    </select>
  </div>

  <div class="wrapp-input">
    <label for="aporte">Aportes</label>

    <label for="aporte-mensal">Mensal</label>
    <input type="radio" name="aporte" id="aporte-mensal" value="1" checked/>

    <label for="aporte-unico">Único</label>
    <input type="radio" name="aporte" id="aporte-unico" value="2" />
  </div>

  <div class="wrapp-input">
    <input type="checkbox" name="termo-condicao" id="termo-condicao" />
    <label for="termo-condicao">Aceito termo de condição</label>
  </div>

  <button type="submit">Cadastrar</button>
</form>