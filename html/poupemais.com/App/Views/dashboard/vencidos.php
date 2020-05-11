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
    <?php
      if(isset($data['titulos']['status'])):
        if($data['titulos']['status'] === "erro"):
    ?>
    <h4><?= $data['titulos']['dados'] ?></h4>
    <?php
          return;
        endif;
      endif;
    ?>
    <table>
      <thead>
        <tr>
          <th>Parcela</th>
          <th>Valor</th>
          <th>Vencimento</th>
          <th>Situação</th>
          <th>Data Pagamento</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data['titulos'] as $titulo) : ?>
          <tr>
            <td><?= $titulo->parcela ?></td>
            <td>R$ <?= number_format($titulo->valor, 2, ',', '.'); ?></td>
            <td><?= date("d/m/Y", strtotime($titulo->vencimento)); ?></td>
            <td><?= $titulo->situacao ?></td>
            <td><?= $titulo->data_pagamento ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>