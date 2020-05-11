<?php
if (!defined('DIR_ROOT')) exit('Acesso não autorizado!');
?>
<div class="dashboard">
  <nav class="nav">
    <h1 class="nome-cliente"><span class="material-icons fffPersona">person</span>Fernando Estevam</h1>
    <ul class="menu-list">
      <li>
        <a href="<?= DIR_PAGE . '/dashboard' ?>">
          <span class="material-icons">home</span>Principal
        </a>
      </li>
      <li>
        <a href="<?= DIR_PAGE . '/dashboard/investir' ?>">
          <span class="material-icons">attach_money</span>Investir
        </a>
      </li>
      <li>
        <a href="<?= DIR_PAGE . '/dashboard/aberto' ?>">
          <span class="material-icons">trending_up</span>Aberto
        </a>
      </li>
      <li>
        <a href="<?= DIR_PAGE . '/dashboard/vencidos' ?>">
          <span class="material-icons">trending_down</span>Vencidos
        </a>
      </li>
      <li>
        <a href="<?= DIR_PAGE . '/dashboard/liquidados' ?>">
          <span class="material-icons">done</span>Liquidados
        </a>
      </li>
      <li>
        <a href="<?= DIR_PAGE . '/dashboard/logout' ?>">
          <span class="material-icons">power_settings_new</span>Sair
        </a>
      </li>
    </ul>
  </nav>
  <div class="painel">
    <form action="<?= DIR_PAGE . '/dashboard/validaInvestimento' ?>" method="POST" id="form-investir">
      <h1>Investir</h1>
      <div class="group-input valor">
        <label for="valor">Valor</label>
        <input type="text" name="valor" id="valor" placeholder="R$ 0,00" />
      </div>
      <div class="group-input plano">
        <label for="plano">Plano</label>
        <select name="plano" id="plano">
          <option value="" selected disabled hidden>Escolha um plano</option>
          <option value="6">6 Meses</option>
          <option value="9">9 meses</option>
          <option value="12">12 meses</option>
        </select>
      </div>
      <div class="group-input data">
        <label for="data">Data</label>
        <select name="data" id="data">
          <option value="" selected disabled hidden>Escolha uma data</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
        </select>
      </div>
      <div class="group-input aporte">
        <div class="input-radio">
          <input type="radio" name="aporte" id="unico" value="1" />
          <label for="unico">Único</label>
        </div>
        <div class="input-radio">
          <input type="radio" name="aporte" id="mensal" value="2" />
          <label for="mensal">Mensal</label>
        </div>
      </div>
      <button type="submit" class="btn btn-investir">Investir</button>
    </form>
  </div>
</div>
<script src="<?= DIR_JS . '/mask.js'?>"></script>