"use strict";

const frm = document.querySelector('#form-investir');

const valor = document.querySelector('input[name=valor]');

let valor = formatFloat(frm.valor.value);

  // mas valor R$ 0,00
  valor.addEventListener('blur', ()=>{
    formatMoney();
  });

  function getMoney(valor) {
    let int = valor;
    int = int.replace((/\./g), "");
    int = int.replace(',','.');
    int = parseFloat(int); 
    return int;
  }

  function formatMoney() {
    
    let int = getMoney(valor.value);
    
    let money = Intl.NumberFormat("pt-BR", {style: "currency", currency: "BRL"}).format(int);

    valor.value = money;
  }

  function formatFloat(valor) {
    
    let sFormat = valor;
    sFormat = sFormat.replace("R$", "");
    sFormat = sFormat.replace(/\s{1,}/g, "");
    sFormat = sFormat.replace((/\./g), "");
    sFormat = sFormat.replace(",", '.');
    return sFormat;
  }
    // mas valor R$ 0,00
    valor.addEventListener('blur', ()=>{
      formatMoney();
    });
  
    function getMoney(valor) {
      let int = valor;
      int = int.replace((/\./g), "");
      int = int.replace(',','.');
      int = parseFloat(int); 
      return int;
    }
  
    function formatMoney() {
      
      let int = getMoney(valor.value);
      
      let money = Intl.NumberFormat("pt-BR", {style: "currency", currency: "BRL"}).format(int);
  
      valor.value = money;
    }
  
    function formatFloat(valor) {
      
      let sFormat = valor;
      sFormat = sFormat.replace("R$", "");
      sFormat = sFormat.replace(/\s{1,}/g, "");
      sFormat = sFormat.replace((/\./g), "");
      sFormat = sFormat.replace(",", '.');
      return sFormat;
    }