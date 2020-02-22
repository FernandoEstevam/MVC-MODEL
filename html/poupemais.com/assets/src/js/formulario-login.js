'use strict';	'use strict';

const frmLogin = document.querySelector('#form-login');
let resposta = document.querySelector(".response");	

const form = {
  login: document.querySelector('#login'),	  
  passwd: document.querySelector('#password'),
}

function sendlogin(e){	
  e.preventDefault();

  const url = frmLogin.action;
  const dados = `login=${form.login.value}&password=${form.passwd.value}`;
  const xhr = new XMLHttpRequest();

  // xhr.onprogress = update_progress;	
  xhr.addEventListener('loadend', transfer_complete, false);	
  // xhr.addEventListener('error', transfer_falied, false);	
  // xhr.addEventListener('abort', transfer_canceled, false);	
  xhr.open('POST', url, true);	  xhr.open('POST', url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	  
  xhr.send(dados);
}	

function transfer_complete() {	
    if(this.status == 200 && this.readyState == 4 ){	    
    let responseJson = JSON.parse(this.responseText);

    if(responseJson.status === 'erro') {	
      resposta.textContent = responseJson.dados;	
    }	    
    resposta.textContent = responseJson.dados;	
  }	
}

frmLogin.addEventListener('submit', sendlogin, false);