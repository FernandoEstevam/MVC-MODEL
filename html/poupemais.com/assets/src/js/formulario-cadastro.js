'use strict';

const form_cadastro = document.querySelector('#form-cadastro');
const ajaxResponse = document.querySelector('#ajax-response');
const termos = document.querySelector('input[type=checkbox]');

const frm = {
  nome: document.querySelector('input[name=nome]'),
  data_nasc: document.querySelector('input[name=nascimento]'),
  cpf: document.querySelector('input[name=cpf]'),
  rg: document.querySelector('input[name=rg]'),
  telefone: document.querySelector('input[name=telefone]'),
  estadoCivil: document.querySelector('select[name=estado-civil]'),
  cep: document.querySelector('input[name=cep]'),
  logradouro: document.querySelector('input[name=logradouro]'),
  numero: document.querySelector('input[name=numero]'),
  compl: document.querySelector('input[name=complemento]'),
  cidade: document.querySelector('input[name=cidade]'),
  bairro: document.querySelector('input[name=bairro]'),
  uf: document.querySelector('input[name=uf]'),
  email:document.querySelector('input[name=email]'),
  confEmail: document.querySelector('input[name=conf-email]'),
  senha: document.querySelector('input[name=password]'),
  confSenha: document.querySelector('input[name=conf-password]'),
  plano: document.querySelector('select[name=plano]'),
  valor: document.querySelector('input[name=valor]'),
  vencimento: document.querySelector('select[name=vencimento]'),
  aporte: document.querySelector('input[name=aporte]')
}

function validacao() {
  
  // Valida email e senha
  if(!valida_email_senha()) return;

  // Verifica termos
  verifica_termos();

  // Verifica se input esta vazio
  if(!valida_input())return;
  
  // Limpa dados
  limpa_campos();
}

// Dados formularios
function dados() {
  return `nome=${frm.nome.value}&nascimento=${frm.data_nasc.value}&cpf=${frm.cpf.value}&`+
    `rg=${frm.rg.value}&telefone=${frm.telefone.value}&estado-civil=${frm.estadoCivil.value}&`+
    `cep=${frm.cep.value}&logradouro=${frm.logradouro.value}&numero=${frm.numero.value}&`+
    `complemento=${frm.compl.value}&bairro=${frm.bairro.value}&cidade=${frm.cidade.value}&uf=${frm.uf.value}&`+
    `email=${frm.email.value}&conf-email=${frm.confEmail.value}&password=${frm.senha.value}&`+
    `conf-password=${frm.confSenha.value}&plano=${frm.plano.value}&valor=${frm.valor.value}&vencimento=${frm.vencimento.value}&`+
    `aporte=${frm.aporte.value}`;
}

// Valida email e senha
function valida_email_senha() {
  if(frm.email.value !== frm.confEmail.value) {
    ajaxResponse.textContent = 'Email e confirmação de email não confere!'
    return false;
  }
  if(frm.senha.value !== frm.confSenha.value) {
    ajaxResponse.textContent = 'Senha e confirmação de senha não confere!'
    return false;
  }
  ajaxResponse.textContent = '';
  return true;
}

// verifica se o termo esta marcado
function verifica_termos() {
  const checked_div = document.querySelector('.checked-info');  

  if(termos.checked == true) {
    checked_div.classList.add('checked-true');
    document.querySelector('button[type=submit]').disabled = false;
  } else {
    checked_div.classList.remove('checked-true');
    document.querySelector('button[type=submit]').disabled = true;
  }
}

function valida_input() {
  let inputs = document.querySelectorAll('input');
  let selects = document.querySelectorAll('select');
  let retorno = true;

  inputs.forEach(element => {
    if(element.value === '' && element.attributes.name.value != 'complemento' ) {
      retorno = false;
    }
  });

  selects.forEach(element => {
    if(element.value === '') {
      retorno = false;
    }
  });

  if(retorno == false) {
    ajaxResponse.textContent = 'Preencha todos os campos!';
  } else {
    ajaxResponse.textContent = '';
  }

  return retorno;
}

function limpa_campos() {
  let inputs = document.querySelectorAll('input');
  let selects = document.querySelectorAll('select');

  inputs.forEach(element => {
    element.value = '';
  });

  selects.forEach(element => {
    element.value = '';
  });
}

// Envia formulario cadastro 
function sendCadastro(e) {
  e.preventDefault();

  const url = form_cadastro.action;
  const xhr = new XMLHttpRequest();
  
  // Validacao dos inputs
  validacao();

  xhr.open('POST', url, true);
  xhr.onreadystatechange = () => {
    if(xhr.status == 200 && xhr.readyState == 4) {
      let responseJson = JSON.parse(xhr.responseText);
  
      if(responseJson.status === 'erro') {	
        ajaxResponse.textContent = responseJson.dados;	
      }	    
      ajaxResponse.textContent = responseJson.dados;	
      limpa_campos();
    }
  }
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(dados());
}

// Evento click
termos.addEventListener('click', verifica_termos);
// Evento submit
form_cadastro.addEventListener('submit', sendCadastro);