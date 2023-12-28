"use strict";

// Declarando Variáveis
const inputCadastroPet = document.querySelectorAll(".inputCadastroPet");
const camposLetras = document.querySelectorAll(".nome");
const btnEdit = document.getElementById("btnEdit");
const campoTelefone = document.getElementById("telefoneResponsavel");
let mask;
let charLetra;

// Função de edição
const edit = function () {
  fieldset.disabled = false;
  document.getElementById("btnAlterar").style.background = "var( --color10)";
};

// Chamando função de edit quando btnEdit é clicado
btnEdit.addEventListener("click", edit);

// Permitindo apenas caracteres da tabela ASCII
for (let i = 0; i < camposLetras.length; i++) {
  camposLetras[i].onkeypress = function () {
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
}

// Mascara Telefone
campoTelefone.addEventListener("input", function () {
  mask = campoTelefone.value;
  mask = mask.replace(/\D/g, "");
  mask = mask.replace(/(\d{2})(\d)/, "($1) $2");
  mask = mask.replace(/(\d)(\d{4})$/, "$1-$2");
  campoTelefone.value = mask;
});

// Proibe ctrl + C ctrl + V
for (let i = 0; i < inputCadastroPet.length; i++) {
  inputCadastroPet[i].onpaste = function () {
    return false;
  };
  inputCadastroPet[i].oncopy = function () {
    return false;
  };
  inputCadastroPet[i].oncut = function () {
    return false;
  };
}
