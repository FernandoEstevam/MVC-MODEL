"use strict";const form_cadastro=document.querySelector("#form-cadastro"),ajaxResponse=document.querySelector("#ajax-response"),termos=document.querySelector("input[type=checkbox]"),frm={nome:document.querySelector("input[name=nome]"),data_nasc:document.querySelector("input[name=nascimento]"),cpf:document.querySelector("input[name=cpf]"),rg:document.querySelector("input[name=rg]"),telefone:document.querySelector("input[name=telefone]"),estadoCivil:document.querySelector("select[name=estado-civil]"),cep:document.querySelector("input[name=cep]"),logradouro:document.querySelector("input[name=logradouro]"),numero:document.querySelector("input[name=numero]"),compl:document.querySelector("input[name=complemento]"),cidade:document.querySelector("input[name=cidade]"),bairro:document.querySelector("input[name=bairro]"),uf:document.querySelector("input[name=uf]"),email:document.querySelector("input[name=email]"),confEmail:document.querySelector("input[name=conf-email]"),senha:document.querySelector("input[name=password]"),confSenha:document.querySelector("input[name=conf-password]"),plano:document.querySelector("select[name=plano]"),valor:document.querySelector("input[name=valor]"),vencimento:document.querySelector("select[name=vencimento]"),aporte:document.querySelector("input[name=aporte]")};function sendCadastro(e){e.preventDefault(),verifica_termos()}function dados(){return`nome=${frm.nome.value}&nascimento=${frm.data_nasc.value}&cpf=${frm.cpf.value}&`+`rg=${frm.rg.value}&telefone=${frm.telefone.value}&estado-civil=${frm.estadoCivil.value}&`+`cep=${frm.cep.value}&logradouro=${frm.logradouro.value}&numero=${frm.numero.value}&`+`complemento=${frm.compl.value}&bairro=${frm.bairro.value}&cidade=${frm.cidade.value}&uf=${frm.uf.value}&`+`email=${frm.email.value}&conf-email=${frm.confEmail.value}&password=${frm.senha.value}&`+`conf-password=${frm.confSenha.value}&plano=${frm.plano.value}&valor=${frm.valor.value}&vecimento=${frm.vencimento.value}&`+`aporte=${frm.aporte.value}`}function valida_email_senha(){return frm.email.value!==frm.confEmail.value?(ajaxResponse.textContent="Email e confirmação de email não confere!",!1):frm.senha.value!==frm.confSenha.value?(ajaxResponse.textContent="Senha e confirmação de senha não confere!",!1):(ajaxResponse.textContent="",!0)}function verifica_termos(){const e=document.querySelector(".checked-info");1==termos.checked?(e.classList.add("checked-true"),document.querySelector("button[type=submit]").disabled=!1):(e.classList.remove("checked-true"),document.querySelector("button[type=submit]").disabled=!0)}function valida_input(){Object.keys(frm).forEach(e=>{console.log(e)})}valida_input(),termos.addEventListener("click",verifica_termos),form_cadastro.addEventListener("submit",sendCadastro);