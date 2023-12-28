const icon = document.querySelector("#iconConf");
const opcoes = document.querySelector(".opcoes");

const displayPainel = function () {
  opcoes.style.display = opcoes.style.display === "block" ? "none" : "block";
  icon.style.fontSize = icon.style.fontSize === "4vh" ? "6vh" : "4vh";
};

icon?.addEventListener("click", displayPainel);
