<?php
  if(!defined('DIR_ROOT')) exit('Acesso não autorizado!');
?>
<div class="dashboard">
  <nav class="nav">
    <h1 class="nome-cliente"><span class="material-icons fffPersona">person</span>Fernando Estevam</h1>
    <ul class="menu-list">
      <li>
        <a href="/dashboard">
          <span class="material-icons">home</span>Principal
        </a>
      </li>
      <li>
        <a href="">
          <span class="material-icons">attach_money</span>Investir
        </a>
      </li>
      <li>
        <a href="">
          <span class="material-icons">trending_up</span>Aberto
        </a>
      </li>
      <li>
        <a href="">
          <span class="material-icons">trending_down</span>Vencidos
        </a>
      </li>
      <li>
        <a href="">
          <span class="material-icons">done</span>Liquidados    
        </a>
      </li>
      <li>
        <a href="">
          <span class="material-icons">power_settings_new</span>Sair
        </a>
      </li>
    </ul>
  </nav>
  <div class="painel">
    <div class="painel-aviso">
      <div class="data">
        <span>Quinta-Feira</span>
        <span>16/04/2020</span>
      </div>
      <div class="info-titulos">
        <h4>Vencido</h4>
        <div class="dados">
          <span>#M00.001</span>
          <span>16/04/2020</span>
          <span>R$ 100,00</span>
        </div>
      </div>
      <div class="info-titulos">
        <h4>Aberto</h4>
        <div class="dados">
          <span>#M00.001</span>
          <span>16/04/2020</span>
          <span>R$ 100,00</span>
        </div>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th>Numero</th>
          <th>Data Contratação</th>
          <th>Situação</th>
          <th>Valor</th>
          <th>Vizualizar</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($data['investimentos'] as $invest) : ?>
          <tr>
            <td><?= $invest->id ?></td>
            <td><?= date("d/m/Y", strtotime($invest->data_contratacao)); ?></td>
            <td><?= $invest->situacao ?></td>
            <td><?= $invest->valor ?></td>
            <td><a href="dashboard/investimento/1"><span class="material-icons">search</span></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"></td>
          <td>Total</td>
          <td>R$ 300,00</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>