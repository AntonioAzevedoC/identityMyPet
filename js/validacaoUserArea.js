"use strict";

// Declarando variáveis
const inputUser = document.querySelectorAll(".inputUser");
const btnSubmit = document.getElementById("btnSubmit");
const formUser = document.getElementById("formUser");
const btnEdit = document.getElementById("btnEditUser");
const btnImg = document.getElementById("inputDocLbl");
const inpImg = document.getElementById("file");
const campoNome = document.getElementById("nomeUsuario");
const campoEmail = document.getElementById("emailUsuario");
const btnInputFile = document.getElementById("btnInputFile");
const formIdioma = document.getElementById("formIdioma");
const formFontSize = document.getElementById("formFontSize");
const formDark = document.getElementById("formDark");
const spans = document.querySelectorAll(".span");
let charLetra;

formIdioma.addEventListener("change", ({ target }) => target.form.submit());
formFontSize.addEventListener("change", ({ target }) => target.form.submit());
formDark.addEventListener("change", ({ target }) => target.form.submit());

// Função de edição
const edit = function () {
  fieldset.disabled = fieldset.disabled ? false : true;
  btnSubmit.classList.toggle("hidden");
  btnInputFile.classList.toggle("hidden");
};

// Chamando função de edit quando btnEdit é clicado
btnEdit.addEventListener("click", edit);

// Permitindo apenas caracteres da tabela ASCII
campoNome.onkeypress = function () {
  if (window.event) {
    charLetra = window.event.keyCode;
    charLetra = String(charLetra);
  } else if (e) {
    charLetra = e.which;
    charLetra = String(charLetra);
  } else {
    return true;
  }
  if (
    charLetra == 32 ||
    (charLetra > 64 && charLetra < 91) ||
    (charLetra > 96 && charLetra < 123) ||
    (charLetra > 191 && charLetra <= 255)
  ) {
    return charLetra;
  } else {
    return false;
  }
};

// Proibe ctrl + C ctrl + V
for (let i = 0; i < inputUser.length; i++) {
  inputUser[i].onpaste = function () {
    return false;
  };
  inputUser[i].oncopy = function () {
    return false;
  };
  inputUser[i].oncut = function () {
    return false;
  };
}
