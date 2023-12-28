"use strict";

// Declarando variáveis
const inputLogin = document.querySelectorAll(".inputLogin");
const btnSubmit = document.getElementById("btnSubmit");
const form = document.getElementById("form");
const campoEmail = document.getElementById("emailLogin");
const campoSenha = document.getElementById("senhaLogin");
const spans = document.querySelectorAll(".span");
const fieldset = document.getElementById("fieldset");

let sec;
let timerErro;
let myArray;
let charCode = "";
let erros = ["Utilize um email válido", "A senha deve ser preenchida", ""];

// Regex para campos
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

// Validação para form
form.addEventListener("submit", function (e) {
  if (!form.classList.contains("form-valid")) {
    e.preventDefault();
  }
});

function allAreTrue(arr) {
  myArray = Array.from(arr);
  return myArray.every((el) => el.classList.contains("input-valid"));
}

const validateForm = function () {
  if (allAreTrue(spans)) {
    form.classList.add("form-valid");
  } else {
    form.classList.remove("form-valid");
  }
};

// Função que mostra os erros nos inputs
const mostrarErros = function (which, message) {
  which.textContent = message;
};

// Avisos dos campos input
const addErro = function (el) {
  form.classList.add(`${el.id}`);
  el.classList.add("erro");
  if (el.classList.contains("input-valid")) {
    el.classList.remove("input-valid");
  }
  validateForm();
};

const removeErro = function (el) {
  form.classList.remove(`${el.id}`);
  el.classList.remove("erro");
  mostrarErros(el, erros[12]);
  if (!el.classList.contains("input-valid")) {
    el.classList.add("input-valid");
  }
  validateForm();
};

// Avisos no campo email
campoEmail.addEventListener("input", function () {
  if (!campoEmail.value.match(emailRegex)) {
    addErro(spans[0]);
    mostrarErros(spans[0], erros[0]);
  } else if (campoEmail.value.match(emailRegex)) {
    removeErro(spans[0]);
  }
});

// Avisos no campo senha
campoSenha.addEventListener("input", function () {
  if (campoSenha.value == "") {
    // senha vazia
    addErro(spans[1]);
    mostrarErros(spans[1], erros[1]);
  } else {
    removeErro(spans[1]);
  }
});

const disableForm = function () {
  fieldset.disabled = false;
  console.log(fieldset.disabled);
};

// Proibindo após cinco erros
window.addEventListener("load", function () {
  if (form.classList.contains("ErroLogin")) {
    fieldset.disabled = true;
    setTimeout(disableForm, 30000);

    spans[0].textContent = "";
    timerErro = 30;
    spans[1].textContent = `Espere um pouco: ${timerErro}`;
    spans[1].cronometro = setInterval(function () {
      sec = --timerErro;
      if (sec > 0) {
        spans[1].textContent = `Espere um pouco: ${sec}`;
      } else {
        spans[1].textContent = "";
      }
    }, 1000);
  }
});

// Permite apenas caracteres na tabela ASCII
const validaEmail = function (charCode) {
  charCode =
    (charCode >= 1 && charCode <= 31) || (charCode > 33 && charCode < 255)
      ? true
      : false;
  return charCode;
};

const validaSenha = function (charCode) {
  charCode =
    (charCode >= 1 && charCode <= 31) || (charCode >= 33 && charCode <= 255)
      ? true
      : false;
  return charCode;
};

for (let i = 0; i < inputLogin.length; i++) {
  inputLogin[i].onkeypress = function () {
    if (window.event) {
      charCode = window.event.keyCode;
      charCode = String(charCode);
    } else if (e) {
      charCode = e.which;
      charCode = String(charCode);
    } else {
      return true;
    }
    if (inputLogin[i] == campoEmail) {
      charCode = validaEmail(charCode) ? charCode : false;
      if (charCode) {
        return charCode;
      } else {
        return false;
      }
    } else if (inputLogin[i] == campoSenha || inputLogin[i] == campoConfSenha) {
      charCode = validaSenha(charCode) ? charCode : false;
      if (charCode) {
        return charCode;
      } else {
        return false;
      }
    } else {
      return false;
    }
  };
}

// Proibe ctrl + C ctrl + V
for (let i = 0; i < inputLogin.length; i++) {
  inputLogin[i].onpaste = function () {
    return false;
  };
  inputLogin[i].oncopy = function () {
    return false;
  };
  inputLogin[i].oncut = function () {
    return false;
  };
}
