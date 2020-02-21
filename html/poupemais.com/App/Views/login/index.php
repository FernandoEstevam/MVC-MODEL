<?php
  if(!defined('DIR_ROOT')) exit('Acesso não autorizado!');
?>
<div class="fundo-login">
  <div class="wrapp-form">
    <div class="wrapp-icon">
      <div class="wrapp-image">
        <img src="<?= DIR_IMAGE . 'icon/2x/login_2x_black.png';?>" alt="">
      </div>
    </div>
    <form action="./login/authenticUser" method="post" class="form" id="form-login">
      <legend>Login</legend>
      <div class="wrapp-input">
        <input type="text" name="login" id="login"  placeholder="email" />
        <span class="icons"><i class="fas fa-envelope"></i></span>
      </div>

      <div class="wrapp-input">
        <input type="password" name="password" id="password" placeholder="password"/>
        <span class="icons"><i class="fas fa-lock"></i></span>
      </div>
      <button type="submit" class="btn btn-login">Entrar</button>
    </form>
  </div>  
  </div>

  <script src="<?=DIR_JS.'./formulario-login.js'?>"></script>