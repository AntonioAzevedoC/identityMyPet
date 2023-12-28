"use strict";

// Declarando variáveis
const inputCadastro = document.querySelectorAll(".inputCadastro");
const btnSubmit = document.getElementById("btnSubmit");
const form = document.getElementById("form");
const campoNome = document.getElementById("nomeCadastro");
const campoEmail = document.getElementById("emailCadastro");
const campoSenha = document.getElementById("senhaCadastro");
const campoConfSenha = document.getElementById("confSenhaCadastro");
const spans = document.querySelectorAll(".span");
let str = "";
let charCode = "";
let erros = [
  "As senhas não correspondem",
  "Esse campo precisa de no mínimo 5 caracteres",
  "Utilize um email válido",
  "A senha deve ser preenchida",
  "A senha deve ter uma letra minuscula",
  "A senha deve ter uma letra maiuscula",
  "Sua senha deve ter um número",
  "Sua senha deve ter um simbolo (#?!@$%^&*-)",
  "Sua senha deve ter no mínimo 8 caracteres",
  "Sua senha deve ter no máximo 30 caracteres",
  "As senhas não correspondem",
  "Esse campo deve ter no máximo 80 caracteres",
  "",
];

// REGEX para campos
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const maiusculaRegex = /^(?=.*?[A-Z])/;
const minusculaRegex = /^(?=.*?[a-z])/;
const numeroRegex = /^(?=.*?[0-9])/;
const simboloRegex = /[\W_]/;

// Validação para form
form.addEventListener("submit", function (e) {
  if (!form.classList.contains("form-valid")) {
    e.preventDefault();
  }
});

function allAreTrue(arr) {
  let myArray = Array.from(arr);
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

// Trimming campos
const trimStr = function (el) {
  str = el.value;
  str = str.replace(/( )+/g, " ");
  el.value = str;
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

const verificaConfSenha = function () {
  if (campoConfSenha.value !== campoSenha.value) {
    addErro(spans[3]);
    mostrarErros(spans[3], erros[0]);
  } else if (campoConfSenha.value == campoSenha.value) {
    removeErro(spans[3]);
  }
};

// Avisos no campo nome
campoNome.addEventListener("input", function () {
  if (campoNome.value.length < 5) {
    addErro(spans[0]);
    mostrarErros(spans[0], erros[1]);
  } else if (campoNome.value.length > 80) {
    addErro(spans[0]);
    mostrarErros(spans[0], erros[12]);
  } else if (campoNome.value.length >= 5) {
    removeErro(spans[0]);
  }
  trimStr(campoNome);
});

// Avisos no campo email
campoEmail.addEventListener("input", function () {
  if (!campoEmail.value.match(emailRegex)) {
    addErro(spans[1]);
    mostrarErros(spans[1], erros[2]);
  } else if (campoEmail.value.match(emailRegex)) {
    removeErro(spans[1]);
  }
});

// Avisos no campo senha
campoSenha.addEventListener("input", function () {
  verificaConfSenha();
  if (campoSenha.value === "") {
    // senha vazia
    addErro(spans[2]);
    mostrarErros(spans[2], erros[3]);
  } else if (!campoSenha.value.match(minusculaRegex)) {
    // senha sem letra minuscula
    addErro(spans[2]);
    mostrarErros(spans[2], erros[4]);
  } else if (!campoSenha.value.match(maiusculaRegex)) {
    // senha sem letra maiuscula
    addErro(spans[2]);
    mostrarErros(spans[2], erros[5]);
  } else if (!campoSenha.value.match(numeroRegex)) {
    // senha sem numero
    addErro(spans[2]);
    mostrarErros(spans[2], erros[6]);
  } else if (!campoSenha.value.match(simboloRegex)) {
    // senha sem simbolo
    addErro(spans[2]);
    mostrarErros(spans[2], erros[7]);
  } else if (campoSenha.value.length < 8) {
    // senha sem 8 caracteres
    addErro(spans[2]);
    mostrarErros(spans[2], erros[8]);
  } else if (campoSenha.value.length > 30) {
    // senha sem 8 caracteres
    addErro(spans[2]);
    mostrarErros(spans[2], erros[9]);
  } else {
    removeErro(spans[2]);
  }
});

// Avisos no campo conf senha
campoConfSenha.addEventListener("input", verificaConfSenha);

// Permite apenas caracteres na tabela ASCII
const validaNome = function (charCode) {
  charCode =
    charCode == 32 ||
    (charCode > 64 && charCode < 91) ||
    (charCode > 96 && charCode < 123) ||
    (charCode > 191 && charCode <= 255)
      ? true
      : false;
  return charCode;
};

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

for (let i = 0; i < inputCadastro.length; i++) {
  inputCadastro[i].onkeypress = function () {
    if (window.event) {
      charCode = window.event.keyCode;
      charCode = String(charCode);
    } else if (e) {
      charCode = e.which;
      charCode = String(charCode);
    } else {
      return true;
    }
    if (inputCadastro[i] == campoNome) {
      charCode = validaNome(charCode) ? charCode : false;
      if (charCode) {
        return charCode;
      } else {
        return false;
      }
    } else if (inputCadastro[i] == campoEmail) {
      charCode = validaEmail(charCode) ? charCode : false;
      if (charCode) {
        return charCode;
      } else {
        return false;
      }
    } else if (
      inputCadastro[i] == campoSenha ||
      inputCadastro[i] == campoConfSenha
    ) {
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
for (let i = 0; i < inputCadastro.length; i++) {
  inputCadastro[i].onpaste = function () {
    return false;
  };
  inputCadastro[i].oncopy = function () {
    return false;
  };
  inputCadastro[i].oncut = function () {
    return false;
  };
}
