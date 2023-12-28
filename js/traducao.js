const body = document.body;
const container = document.querySelector(".container");
const inputs = document.querySelectorAll(".inputs");
let lang = document.querySelector("html").getAttribute("lang");
lang = lang.replaceAll("-", "");
let elemento;

const traducoes = {
  ptbr: {
    // Tradução userArea.php
    welcomeUsuario: "Bem-vindo",
    myInfo: "Minhas informações",
    nome: "Nome",
    email: "Email",
    deleteAccount: "Deseja mesmo deletar sua conta?",
    fontLabel: "Tamanho da fonte",
    font75: "Pequeno",
    font100: "Médio",
    font125: "Grande",
    idiomaLabel: "Idioma",
    modoLabel: "Modo",
    modoClaro: "Modo claro",
    modoDark: "Modo Escuro",
    modalDelete: "Deletar conta",
    btnEditUser: "Habilitar edição",
    btnSubmit: "Salvar",
    inputDocLbl: "Selecionar imagem ▲",
    btnSair: "<a href='sair.php'>Sair</a>",
    // Tradução index.php
    addNovoPet: "novo",
    // Tradução pet
    nomeResponsavelLbl: "Nome responsável",
    telefoneResponsavelLbl: "telefone responsável",
    nomePetLbl: "nome do Pet:",
    especieLbl: "espécie",
    racaLbl: "raça",
    sexoLbl: "sexo do Pet",
    femea: "fêmea",
    macho: "macho",
    tamanhoLbl: "tamanho",
    pequeno: "pequeno",
    medio: "médio",
    grande: "grande",
    idadeLbl: "idade",
    filhote: "filhote",
    jovem: "jovem",
    adulto: "adulto",
    titleSaude: "saúde",
    titleResponsavel: "responsável",
    titleCaracteristicas: "caracteristicas",
    castradoLbl: "castrado",
    vermifugoLbl: "vermifugo",
    antiPulgaLbl: "anti-pulgas/carrapatos",
    V8Lbl: "vacina v8/v10",
    antirrabicaLbl: "vacina antirrábica",
    bronchiGuardLbl: "vacina bronchiGuard",
    deletePet: "Deseja mesmo deletar esse pet?",
  },
  enus: {
    // Tradução userArea.php
    welcomeUsuario: "Welcome",
    myInfo: "My informations",
    nome: "Full name",
    email: "Email",
    deleteAccount: "Are you sure you want to delete your account?",
    fontLabel: "Font size",
    font75: "Small",
    font100: "Medium",
    font125: "large",
    idiomaLabel: "Language",
    modoLabel: "Display",
    modoClaro: "Light-mode",
    modoDark: "Dark-mode",
    modalDelete: "Delete account",
    btnEditUser: "Enable edit",
    btnSubmit: "save",
    inputDocLbl: "Choose file ▲",
    btnSair: "<a href='sair.php'>Log out</a>",
    // Tradução index.php
    addNovoPet: "new",
    // Tradução pet
    nomeResponsavelLbl: "owners name",
    telefoneResponsavelLbl: "owners phone",
    nomePetLbl: "Pet's name:",
    especieLbl: "species",
    racaLbl: "race",
    sexoLbl: "Pet's sex",
    femea: "female",
    macho: "male",
    tamanhoLbl: "size",
    pequeno: "small",
    medio: "medium",
    grande: "large",
    idadeLbl: "age",
    filhote: "puppy",
    jovem: "juvenile",
    adulto: "adult",
    titleSaude: "health",
    titleResponsavel: "owner",
    titleCaracteristicas: "characteristics",
    castradoLbl: "castrated",
    vermifugoLbl: "vermifuge",
    antiPulgaLbl: "anti-flea/tick",
    V8Lbl: "v8/v10 vaccine",
    antirrabicaLbl: "rabies vaccine",
    bronchiGuardLbl: "bronchiGuard vaccine",
    deletePet: "Are you sure you want to delete this pet?",
  },
  esmx: {
    // Tradução userArea.php
    welcomeUsuario: "Bienvenido",
    myInfo: "Mis informaciones",
    nome: "nombre",
    email: "Email",
    deleteAccount: "¿Estás seguro de que quieres eliminar tu cuenta?",
    fontLabel: "Tamaño de fuente",
    font75: "Pequeño",
    font100: "medio",
    font125: "grande",
    idiomaLabel: "Idioma",
    modoLabel: "Display",
    modoClaro: "Tema-ligero",
    modoDark: "Tema-oscuro",
    modalDelete: "Borrar cuenta",
    btnEditUser: "Habilitar edición",
    btnSubmit: "ahorrar",
    inputDocLbl: "Elija archivo ▲",
    btnSair: "<a href='sair.php'>Cerrar sesión</a>",
    // Tradução index.php
    addNovoPet: "nuevo",
    // Tradução pet
    nomeResponsavelLbl: "nombre del dueño",
    telefoneResponsavelLbl: "teléfono de los propietarios",
    nomePetLbl: "nombre de mascota:",
    especieLbl: "especies",
    racaLbl: "carrera",
    sexoLbl: "tipo de mascotas",
    femea: "femenina",
    macho: "masculino",
    tamanhoLbl: "tamaño",
    pequeno: "pequeño",
    medio: "medio",
    grande: "grande",
    idadeLbl: "edad",
    filhote: "perrito",
    jovem: "juvenil",
    adulto: "adulto",
    titleSaude: "salud",
    titleResponsavel: "responsable",
    titleCaracteristicas: "características",
    castradoLbl: "castrado",
    vermifugoLbl: "vermífugo",
    antiPulgaLbl: "antipulgas/garrapatas",
    V8Lbl: "vacuna v8/v10",
    antirrabicaLbl: "vacuna contra la rabia",
    bronchiGuardLbl: "bronquiosvacuna guardia",
    deletePet: "¿Estás seguro de que quieres eliminar esta mascota?",
  },
  frbe: {
    // Traduction userArea.php
    welcomeUsuario: "Bienvenue",
    myInfo: "Mes informations",
    nome: "Nom complet",
    email: "E-mail",
    deleteAccount: "Etes-vous sûr de vouloir supprimer votre compte ?",
    fontLabel: "Taille de la police",
    font75: "Petit",
    font100: "Moyen",
    font125: "grand",
    idiomaLabel: "Langue",
    modoLabel: "Affichage",
    modoClaro: "Mode lumière",
    modoDark: "Mode sombre",
    modalDelete: "Supprimer le compte",
    btnEditUser: "Activer l'édition",
    btnSubmit: "enregistrer",
    inputDocLbl: "Choisir le fichier ▲",
    btnSair: "<a href='sair.php'>Déconnexion</a>",
    // Traduction index.php
    addNovoPet: "nouveau",
    // Traduction animal de compagnie
    nomeResponsavelLbl: "nom du propriétaire",
    telefoneResponsavelLbl: "téléphone du propriétaire",
    nomePetLbl: "Nom de l'animal :",
    especieLbl: "espèce",
    racaLbl: "course",
    sexoLbl: "sexe d'animal",
    femea: "femelle",
    macho: "masculin",
    tamanhoLbl: "taille",
    pequeno: "petit",
    medio: "moyen",
    grande: "grand",
    idadeLbl: "âge",
    filhote: "chiot",
    jovem: "juvénile",
    adulto: "adulte",
    titleSaude: "santé",
    titleResponsavel: "propriétaire",
    titleCaracteristicas: "caractéristiques",
    castradoLbl: "castré",
    vermifugoLbl: "vermifuge",
    antiPulgaLbl: "anti-puce/tique",
    V8Lbl: "vaccin v8/v10",
    antirrabicaLbl: "vaccin contre la rage",
    bronchiGuardLbl: "vaccin bronchiGuard",
    deletePet: "Etes-vous sûr de vouloir supprimer cet animal ?",
  },
  ptbrInputs: {
    // Tradução userArea.php
    btnDeletarUser: "Deletar conta",
    // Tradução Pet
    btnCadastrar: "Cadastrar",
    btnDeletarPet: "Deletar pet",
    btnAlterar: "Alterar",
  },
  enusInputs: {
    // Tradução userArea.php
    btnDeletarUser: "Delete account",
    // Tradução Pet
    btnCadastrar: "Register",
    btnDeletarPet: "Delete pet",
    btnAlterar: "Save changes",
  },
  esmeInputs: {
    // Tradução userArea.php
    btnDeletarUser: "Borrar cuenta",
    // Tradução Pet
    btnCadastrar: "Catastrar",
    btnDeletarPet: "Eliminar mascota",
    btnAlterar: "Alterar",
  },
  frbeInputs: {
    // Tradução userArea.php
    btnDeletarUser: "Supprimer le compte",
    // Tradução Pet
    btnCadastrar: "S'inscrire",
    btnDeletarPet: "Supprimer l'animal",
    btnAlterar: "Enregistrer les modifications",
  },
};

const elementosTraduzidos = [
  // Campos UserArea.php
  "welcomeUsuario",
  "myInfo",
  "nome",
  "email",
  "deleteAccount",
  "fontLabel",
  "font75",
  "font100",
  "font125",
  "idiomaLabel",
  "modoLabel",
  "modoClaro",
  "modoDark",
  "modalDelete",
  "btnEditUser",
  "btnSubmit",
  "inputDocLbl",
  "btnSair",
  // Campos index.php
  "addNovoPet",
  // Campos pet
  "nomeResponsavelLbl",
  "telefoneResponsavelLbl",
  "nomePetLbl",
  "especieLbl",
  "racaLbl",
  "sexoLbl",
  "femea",
  "macho",
  "tamanhoLbl",
  "pequeno",
  "medio",
  "grande",
  "idadeLbl",
  "filhote",
  "jovem",
  "adulto",
  "titleSaude",
  "titleResponsavel",
  "titleCaracteristicas",
  "castradoLbl",
  "vermifugoLbl",
  "antiPulgaLbl",
  "V8Lbl",
  "antirrabicaLbl",
  "bronchiGuardLbl",
  "deletePet",
];

const inputsTraduzidos = [
  // Campos UserArea.php
  "btnDeletarUser",
  // Campos Pet
  "btnCadastrar",
  "btnDeletarPet",
  "btnAlterar",
];

const traducao = function (e) {
  // Tradução Elementos
  for (const elementoId of elementosTraduzidos) {
    elemento = document.getElementById(elementoId);
    if (elemento) {
      elemento.innerHTML = traducoes[e][elementoId];
    }
  }

  // Tradução Inputs (por value)
  for (const inputValue of inputsTraduzidos) {
    for (i of inputs) {
      elemento = document.getElementById(inputValue);
      if (elemento) {
        if (i.value == traducoes["ptbrInputs"][inputValue]) {
          i.value = String(traducoes[e + "Inputs"][inputValue]);
        }
      }
    }
  }
};

document.addEventListener("onload", traducao(lang));
