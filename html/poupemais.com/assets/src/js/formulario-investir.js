"use strict";

const frm = document.querySelector("#form-investir");

const form = {
  valor: document.querySelector('input[name=valor]'),
  plano: document.querySelector('select[name=plano]'),
  data: document.querySelector('select[name=data]'),
  aporte: document.querySelector('input[name=aporte]:checked')
}

function dados() {
  let valor = formatFloat(form.valor.value);
  let aporte = document.querySelector('input[name=aporte]:checked').value;
  let plano = document.querySelector('select[name=plano]').value;
  let data = document.querySelector('select[name=data]').value;
  let dadosForm = `valor=${valor}&plano=${plano}&data=${data}&aporte=${aporte}`;
  return dadosForm;
}


valor.addEventListener("blur", () => {
  formatMoney();
});

function formatFloat(valor) {
  let int = valor;
  int = int.replace("R$", "");
  int = int.replace((/s{1,}\./g), "");
  int = int.replace((/\./g), "");
  int = int.replace(",",".");
  int = parseFloat(int);
  return int;
}

function formatMoney() {
  let int = formatFloat(form.valor.value);
  let money = Intl.NumberFormat("pt-BR", {style: "currency", currency: "BRL"}).format(int);

  valor.value = money;
}


function validaInput() {
  let inputs = document.querySelectorAll("input");
  let selects = document.querySelectorAll("select");
  let retorno = true;

  inputs.forEach((element) => {
    if(element.value === "" || element.value === null)
    retorno = false;
  });

  selects.forEach((element) => {
    if(element.value === "") {
      retorno = false;
    }
  });

  if(retorno == false) {
    alert("Preencha todos os campos!");
  }
  
  return retorno;

}

function limpa_campos() {
  let inputs = document.querySelectorAll("input");
  let selects = document.querySelectorAll("select");

  inputs.forEach((element) => {
    element.value = "";
  });

  selects.forEach((element) => {
    element.value = "";
  });
}


function sendForm(e) {
  e.preventDefault();

  console.log(document.querySelector() 
  const xhr = new XMLHttpRequest();
  const url = frm.action;
  const response = true;

  if(validaInput) {

    xhr.open("POST", url, true);
    xhr.onreadystatechange = () => {
    
      if(xhr.status == 200 && xhr.readyState == 4) {
        let responseJson  = JSON.parse(xhr.responseText);

        if(responseJson.status == "erro") {
          console.log(responseJson.dados);
          response = false;
        }
      
        console.log(responseJson.dados);
      }

    } 

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(dados());

    if(response) {
      limpa_campos();
    }
  
  }
  
  return false;
}

frm.addEventListener("submit", sendForm);
