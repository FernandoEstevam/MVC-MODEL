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

function formSend(e) { 
  e.preventDefault();
  console.log(dados());
}

valor.addEventListener("blur", () => {
  formatMoney();
});

frm.addEventListener("submit", formSend);

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

