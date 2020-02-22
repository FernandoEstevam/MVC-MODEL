'use strict';

const frmLogin = document.querySelector('#form-login');

const form = {
  login: document.querySelector('#login'),
  passwd: document.querySelector('#password'),
}

function sendlogin(e){
  e.preventDefault();

  const url = frmLogin.action;
  const dados = `login=${form.login.value}&password=${form.passwd.value}`;
  const xhr = new XMLHttpRequest();
  xhr.open('POST', url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = handler;
  xhr.response
  xhr.send(dados);
}

function handler() {
  this.onreadystatechange = function() {
    if(this.status == 200 && this.readState == 4) {
      let responseJson = JSON.parse(this.responseText);
      console.log(reponseJson);
    }
  }
}

frmLogin.addEventListener('submit', sendlogin, false);