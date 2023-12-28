"use strict";

// Declarando Variáveis
const btnsModal = document.querySelectorAll(".btnUpdate");
const fieldset = document.getElementById("fieldset");
const modals = document.querySelectorAll(".modal");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelectorAll(".closeModal");

// Função de abrir modals
const openModalDelete = function () {
  modals[0].classList.remove("hidden");
  overlay.classList.remove("hidden");
};

const openModalQR = function () {
  modals[1].classList.remove("hidden");
  overlay.classList.remove("hidden");
};

// Função de fechar modals
const closeModal = function () {
  for (let i = 0; i < modals.length; i++) {
    modals[i].classList.add("hidden");
  }
  overlay.classList.add("hidden");
};

btnsModal[0]?.addEventListener("click", openModalDelete);
btnsModal[1]?.addEventListener("click", openModalQR);

// Chamando função de fechar o modal
for (let i = 0; i < modals.length; i++) {
  btnCloseModal[i].addEventListener("click", closeModal);
  overlay?.addEventListener("click", closeModal);
}

// Fechando o modal quando alguém apreta "esc"
document.addEventListener("keydown", function (event) {
  if (event.key == "Escape" && !modals.classList.contains("hidden")) {
    closeModal();
  }
});
