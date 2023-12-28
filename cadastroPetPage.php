<?php

include 'topHead.php';

?>

<html lang="<?php echo $_SESSION['idioma'];?>">

<?php

include 'bottomHead.php';

?>
    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/cadastroPetPageStyle.css" />
    <link rel="stylesheet" href="css/darkmode/darkmodePet.css" />
    <!-- SCRIPTS -->
    <script defer src="js/validacaoCadastroPet.js"></script>
    <script defer src="js/image.js"></script>
</head>
<body class="<?= ($_SESSION['darkMode'] == 2 ? "darkmode " : ""); ?><?= ($_SESSION['font'] ? $_SESSION['font'] : ""); ?>">
    <div class="container">
        <div class="content">
            <!--FORMULÁRIO-->
            <form action="processaCadastroPet.php" method="post" enctype="multipart/form-data">
                <!--PARTE DA ESQUERDA ONDE ESTÁ O INPUT DA IMAGEM E INFORMAÇÕES DO DONO-->
                <div class="leftSpace">
                    <div id="inputFile">
                        <img id="output" src="img/petDefault.png" alt="" />
                        <div id="btnInputFile">
                            <input type="file" accept="image/*" name="fotoPerfil" class="inputDoc" id="file" value="" />
                            <label for="file" class="inputFotoPet" name="fotoPerfil" id="inputDocLbl" value="Selecionar imagem ▲"></label>
                        </div>
                    </div>
                    <!--input NOME RESPONSÁVEL-->
                    <div class="inputBox">
                        <label for="nomeResponsavel" id="nomeResponsavelLbl" class="labelInput">Nome responsável</label>
                        <input type="text" name="nomeResponsavel" class="inputCadastroPet nome" id="nomeResponsavel" maxlength="80" required />
                    </div>
                    <!--input TELEFONE RESPONSÁVEL-->
                    <div class="inputBox">
                        <label for="telefoneResponsavelLbl" id="telefoneResponsavelLbl" class="labelInput">telefone responsável</label>
                        <input type="tel" name="telefoneResponsavel" class="inputCadastroPet" id="telefoneResponsavel" minlength="11" maxlength="15" required />
                    </div>
                </div>
                <!--PARTE DO CENTRO ONDE ESTÁ OS DADOS DO PET-->
                <div class="centerSpace">
                    <!--input NOME PET-->
                    <div class="inputBox">
                        <label for="nomePetLbl" id="nomePetLbl" class="labelInput">nome do Pet</label>
                        <input type="text" name="nomePet" class="inputCadastroPet nome" id="nomePet" maxlength="80" required />
                    </div>
                   <!-- select ESPÉCIE -->
                   <div class="inputBox">
                            <label for="especie" id="especieLbl" class="labelInput">espécie</label>
                            <input type="text" name="especie" class="inputCadastroPet nome" id="especie" maxlength="80" value="" required />
                        </div>
                        <!--select RAÇA-->
                        <div class="inputBox">
                            <label for="raca" id="racaLbl" class="labelInput">raça</label>
                            <input type="text" name="raca" class="inputCadastroPet nome" id="raca" maxlength="80" value="" required />
                        </div>              
                    <!--select GÊNERO-->
                    <div class="selectBox">
                    <label id="sexoLbl" for="sexo">sexo</label>
                        <select name="sexo" class="" required>
                            <option value=""></option>
                            <option id="femea" value="f">fêmea</option>
                            <option id="macho" value="m">macho</option>
                        </select>
                    </div>
                    <!--select TAMANHO-->
                    <div class="selectBox">
                        <label id="tamanhoLbl" for="tamanho">tamanho</label> 
                        <select name="tamanho" class="" required>
                            <option value=""></option>
                            <option id="pequeno" value="pequeno">pequeno</option>
                            <option id="medio" value="medio">médio</option>
                            <option id="grande" value="grande">grande</option>
                        </select>
                    </div>
                    <!--select IDADE-->
                    <div class="selectBox">
                        <label id="idadeLbl" for="idade">idade</label> 
                        <select name="idade" class="" required>
                            <option value=""></option>
                            <option id="filhote" value="filhote">filhote</option>
                            <option id="jovem"   value="jovem">jovem</option>
                            <option id="adulto"  value="adulto">adulto</option>
                        </select>
                    </div>               
                </div>
                <!--PARTE DA DIREITA ONDE ESTÁ OS DADOS DE SAUDE DO PET-->
                <div class="rightSpace">
                    <p id="titleSaude">saúde</p>
                    <div class="inputCheckboxContent">
                        <div class="checkboxBox">
                            <input type="checkbox" value="castrado" name="castrado">
                            <label id="castradoLbl" for="">castrado</label>
                        </div>
                        <div class="checkboxBox">
                            <input type="checkbox" value="vermifugo" name="vermifugo">
                            <label id="vermifugoLbl" for="">vermifugo</label>                   
                        </div>
                        <div class="checkboxBox">
                            <input type="checkbox" value="antipulgas" name="antipulgas">
                            <label id="antiPulgaLbl" for="">anti-pulgas/carrapatos</label>
                        </div>
                    
                        <div class="checkboxBox">
                            <input type="checkbox" value="vacinaV8v10" name="vacinaV8v10">
                            <label id="V8Lbl" for="">vacina v8/v10</label>
                        </div>
                        <div class="checkboxBox">
                            <input type="checkbox" value="vacinaAntirrabica" name="vacinaAntirrabica">
                            <label id="antirrabicaLbl" for="">vacina antirrábica</label>
                        </div>
                        <div class="checkboxBox">
                            <input type="checkbox" value="vacinaBronchiGuard" name="vacinaBronchiGuard">
                            <label id="bronchiGuardLbl" for="">vacina bronchiGuard</label>
                        </div>
                    </div>
                    <input class="inputs" id="btnCadastrar" type="submit" name="cadastrar" value="Cadastrar" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>
