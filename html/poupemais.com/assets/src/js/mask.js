'use strict';

const cpf = document.querySelector('input[name=cpf]');
const rg = document.querySelector('input[name=rg]');
const telefone = document.querySelector('input[name=telefone]');
const cep = document.querySelector('input[name=cep]');

// mask cpf 000.000.000-00
cpf.addEventListener("blur", ()=> {     
  if(cpf.value.length == 11) {
    cpf.value = cpf.value.replace(/(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
    cpf.value = cpf.value.replace(/(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
    cpf.value = cpf.value.replace( /(\d{3})(\d{1,2})$/ , "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
  }
});

// mask rg 00.000.000-0
rg.addEventListener("blur", ()=> {
  if(rg.value.length == 8) {
    rg.value = 0 + rg.value.replace(/\D/g,"");
    rg.value = rg.value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})$/,"$1.$2.$3-$4");
    return;
  }     
  rg.value = rg.value.replace(/\D/g,"");
  rg.value = rg.value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})$/,"$1.$2.$3-$4");
});

// mask telefone (11).0.0000-0000
telefone.addEventListener("blur", ()=> {     
  if(telefone.value.length == 10) {
    telefone.value = telefone.value.replace(/\D/g,"");
    telefone.value = telefone.value.replace(/(\d{2})(\d{4})(\d{4})$/,"($1) $2-$3");  
    return;
  }
  telefone.value = telefone.value.replace(/\D/g,"");
  telefone.value = telefone.value.replace(/(\d{2})(\d{1})(\d{4})(\d{4})$/,"($1) $2.$3-$4");
});

// mask cep 00000-000
cep.addEventListener("blur", ()=> {     
  if(cep.value.length == 8) {
    cep.value = cep.value.replace(/\D/g,"");
    cep.value = cep.value.replace(/(\d{5})(\d{3})$/,"$1-$2");
  }
});