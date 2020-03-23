'use strict';

var ajaxResposta = document.querySelector('#ajax-response-cep');
// Busca cep
function buscarCep() {

  if(!valida_input_cep(cep.value)){
      return false;
  }

  // URL cep API
  let url = `https://viacep.com.br/ws/${cep.value}/json/`;

  // Enviar cep para API e recebe retorno
  fetch(url)
  .then(reponse => reponse.json())
  .then(result => {
      preenche_formulario(result);
  })
  .catch(erro => {
    console.error('Failed retrieving information', erro);
  });
}

// Valida o input do CEP
function valida_input_cep(valor) {
  
  if(cep.value == "") {
    // verifica se campo cep possui valor informado
    ajaxResposta.textContent = 'Informe o cep valido!';
    return false;
  }
  
  // Nova variavel cep somente com digitos
  let cepDigitado = valor.replace(/\D/g, "");


  // Expressao regular para validar o CEP
  let validacep = /^[0-9]{8}$/;
  
  //Valida o formato CEP
  if(!validacep.test(cepDigitado)) {
    ajaxResposta.textContent = 'CEP deve ter 8 digitos!';
    return cep.focus();
  }

  return true;
}

function preenche_formulario(retorno) {
  if(retorno.erro) {
    ajaxResposta.textContent = 'Preencha um CEP válido!'
    return false;
  }
  ajaxResposta.textContent = '';
  document.querySelector('#logradouro').value = retorno.logradouro;
  document.querySelector('#bairro').value = retorno.bairro;
  document.querySelector('#cidade').value = retorno.localidade;
  document.querySelector('#uf').value = retorno.uf;
}

cep.addEventListener('blur', buscarCep, false);

