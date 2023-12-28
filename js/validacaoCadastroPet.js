"use strict";

// Declarando variáveis
const inputCadastroPet = document.querySelectorAll(".inputCadastroPet");
const camposLetras = document.querySelectorAll(".nome");
const campoFoto = document.getElementById("inputFotoPerfil");
const campoNomeResp = document.getElementById("nomeResponsavel");
const campoTelefone = document.getElementById("telefoneResponsavel");
const campoNomePet = document.getElementById("NomePet");
const campoEspecie = document.getElementById("especie");
const campoRaca = document.getElementById("raca");
const camposexo = document.getElementById("sexo");
const campoTamanho = document.getElementById("tamanho");
const campoIdade = document.getElementById("idade");
let mask = "";
let charLetra = "";

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
}
