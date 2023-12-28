<?php

include 'topHead.php';

?>

<html lang="<?php echo $_SESSION['idioma'];?>">

<?php

include 'bottomHead.php';

$p = $_GET['p'];
$rs = $pet->pegarDadosPet($p);
$rsFoto = $pet->pegarFotoPet($p);

if ($rs['idUsuario'] != $_SESSION['id']){
    header("Location: index.php");
}


// Incluir Composer
require_once('vendor/autoload.php');
// Função para gerar o QR Code com base no ID do pet
function gerarQRCode($p) {
    // Criar a URL para o pet com base no ID
    $url = "identitymypet.online/viewPet.php?p=" . $p;

    // Gerar QR Code
    $qrCode = (new \chillerlan\QRCode\QRCode())->render($url);

    // Retornar o QR Code
    return $qrCode;
}

?>
    <!-- ESTILOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/atualizaPetPageStyle.css" />
    <link rel="stylesheet" href="css/darkmode/darkmodePet.css" />
    <!-- SCRIPTS -->
    <script defer src="js/atualizacaoPet.js"></script>
    <script defer src="js/modals.js"></script>
    <script defer src="js/image.js"></script>
</head>
<body class="<?= ($_SESSION['darkMode'] == 2 ? "darkmode " : ""); ?><?= ($_SESSION['font'] ? $_SESSION['font'] : ""); ?>">
    <div class="container">
        <div class="content">
            <!-- FORMULÁRIO -->
            <form enctype="multipart/form-data" action="inclusao/caminhos.php" method="POST">
            <fieldset id="fieldset" disabled >
                    <!-- PARTE DA ESQUERDA ONDE ESTÁ O INPUT DA IMAGEM E INFORMAÇÕES DO DONO -->
                    <div class="leftSpace">
                        <div id="inputFile">
                            <img id="output" src="/upload/fotospets/<?= $rsFoto['imagem']; ?>" alt="" />
                            <div id="btnInputFile">
                                <input type="file" accept="image/*" name="fotoPerfil" class="inputDoc" id="file" value="" />
                                <label for="file" class="inputFotoPet" name="fotoPerfil" id="inputDocLbl" value="Selecionar imagem ▲"></label>
                            </div>
                        </div>
                        <input type='hidden' name='atualizaPet' />
                        <!-- input ID PET -->
                        <input type="hidden" name="idPet" value="<?= $rs['idPet']; ?>" />
                        <!-- input NOME RESPONSÁVEL -->
                        <div class="inputBox">
                            <label for="nomeResponsavel" id="nomeResponsavelLbl" class="labelInput">Nome responsável</label>
                            <input type="text" name="nomeResponsavel" class="inputCadastroPet" id="nomeResponsavel" maxlength="80" value="<?= $rs['nomeResponsavel']; ?>" required />
                        </div>
                        <!-- input TELEFONE RESPONSÁVEL -->
                        <div class="inputBox">
                            <label for="telefoneResponsavel" id="telefoneResponsavelLbl" class="labelInput">Telefone responsável</label>
                            <input type="text" name="telefoneResponsavel" class="inputCadastroPet" id="telefoneResponsavel" minlength="11" maxlength="15" value="<?= $rs['telefoneResponsavel']; ?>" required />
                        </div>
                    </div>
                    <!-- PARTE DO CENTRO ONDE ESTÁ OS DADOS DO PET -->
                    <div class="centerSpace">
                        <!-- input NOME PET -->
                        <div class="inputBox">
                            <label for="nomePet" id="nomePetLbl" class="labelInput">Nome do Pet</label>
                            <input type="text" name="nomePet" class="inputCadastroPet" id="nomePet" maxlength="80" value="<?= $rs['nomePet']; ?>" required />
                        </div>
                        <!-- select ESPÉCIE -->
                        <div class="inputBox">
                            <label for="especie" id="especieLbl" class="labelInput">espécie</label>
                            <input type="text" name="especie" class="inputCadastroPet" id="especie" maxlength="80" value="<?=$rs['especie'] ?>" required />
                        </div>
                        <!--select RAÇA-->
                        <div class="inputBox">
                            <label for="raca" id="racaLbl" class="labelInput">raça</label>
                            <input type="text" name="raca" class="inputCadastroPet" id="raca" maxlength="80" value="<?=$rs['raca'] ?>" required />
                        </div> 
                        <!-- select GÊNERO -->
                        <div class="selectBox">
                            <label id="sexoLbl" for="sexo">sexo</label>
                            <select name="sexo" class="" id="sexo" required>
                                <option value=""></option>
                                <option <?= ($rs['sexo'] == "f" ? "selected" : ''); ?> value="f" id="femea">Fêmea</option>
                                <option <?= ($rs['sexo'] == "m" ? "selected" : ''); ?> value="m" id="macho">Macho</option>
                            </select>
                        </div>
                        <!-- select TAMANHO -->
                        <div class="selectBox">
                            <label id="tamanhoLbl" for="tamanho">tamanho</label>
                            <select name="tamanho" class="" id="tamanho" required>
                                <option value=""></option>
                                <option <?= ($rs['tamanho'] == "pequeno" ? "selected" : ''); ?> value="pequeno" id="pequeno">pequeno</option>
                                <option <?= ($rs['tamanho'] == "medio" ? "selected" : ''); ?> value="medio" id="medio">médio</option>
                                <option <?= ($rs['tamanho'] == "grande" ? "selected" : ''); ?> value="grande" id="grande">grande</option>
                            </select>
                        </div>
                        <!-- select IDADE -->
                        <div class="selectBox">
                            <label id="idadeLbl" for="idade">idade</label>
                            <select name="idade" class="" id="idade" required>
                                <option value=""></option>
                                <option <?= ($rs['idade'] == "filhote" ? "selected" : ''); ?> value="filhote" id="filhote">filhote</option>
                                <option <?= ($rs['idade'] == "jovem" ? "selected" : ''); ?> value="jovem" id="jovem">jovem</option>
                                <option <?= ($rs['idade'] == "adulto" ? "selected" : ''); ?> value="adulto" id="adulto">adulto</option>
                            </select>
                        </div>
                    </div>
                    <!-- PARTE DA DIREITA ONDE ESTÁ OS DADOS DE SAUDE DO PET -->
                    <div class="rightSpace">
                        <p id="titleSaude">Saúde</p>
                        <div class="inputCheckboxContent">
                            <div class="checkboxBox">
                                <input <?= ($rs['castrado'] == 1 ? "checked" : ''); ?> type="checkbox" value="castrado" name="castrado">
                                <label id="castradoLbl" for="">Castrado</label>
                            </div>
                            <div class="checkboxBox">
                                <input <?= ($rs['vermifugo'] == 1 ? "checked" : ''); ?> type="checkbox" value="vermifugo" name="vermifugo">
                                <label id="vermifugoLbl" for="">Vermífugo</label>
                            </div>
                            <div class="checkboxBox">
                                <input <?= ($rs['antipulgas'] == 1 ? "checked" : ''); ?> type="checkbox" value="antipulgas" name="antipulgas">
                                <label id="antiPulgaLbl" for="">Antipulgas/carrapatos</label>
                            </div>

                            <div class="checkboxBox">
                                <input <?= ($rs['vacinaV8v10'] == 1 ? "checked" : ''); ?> type="checkbox" value="vacinaV8v10" name="vacinaV8v10">
                                <label id="V8Lbl" for="">Vacina V8/V10</label>
                            </div>
                            <div class="checkboxBox">
                                <input <?= ($rs['vacinaAntirrabica'] == 1 ? "checked" : ''); ?> type="checkbox" value="vacinaAntirrabica" name="vacinaAntirrabica">
                                <label id="antirrabicaLbl" for="">Vacina antirrábica</label>
                            </div>
                            <div class="checkboxBox">
                                <input <?= ($rs['vacinaBronchiguard'] == 1 ? "checked" : ''); ?> type="checkbox" value="vacinaBronchiGuard" name="vacinaBronchiGuard">
                                <label id="bronchiGuardLbl" for="">Vacina bronchiGuard</label>
                            </div>
                        </div>
                        <input class="inputs" id="btnAlterar" type="submit" name="alterar" value="Alterar" />
                    </div>
                </fieldset>
            </form>
            <!--BOTOES DE EDITAR E EXCLUIR-->
            <div class="qrCodeLocal">
                <a class="btnEdit" id="btnEdit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a class="btnUpdate" id="btnDelete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <a class="btnUpdate" id="btnQrCode"><i class="fa fa-qrcode" aria-hidden="true"></i></a>
            </div>
        </div>
        <!-- MODAL DE DELETAR PET -->
        <div class="modal hidden">
            <button class="closeModal">&times;</button>
            <form action="inclusao/caminhos.php" method="POST">
                <h1 id="deletePet">Deseja mesmo deletar esse pet?</h1>
                <input type='hidden' name='deletePet' />
                <input type="hidden" name="idPet" value="<?=$rs['idPet']; ?>" />
                <input class="inputs" id="btnDeletarPet" type="submit" name="deletar" value="Deletar pet" />
            </form>
        </div>
        <!-- MODAL DE QR CODE -->
        <div class="modal hidden " id="modQrCode">
			<button class="closeModal">&times;</button>
			<?php
                $idPet = $_GET['p'];
                $qrCode = gerarQRCode($idPet);
                // Download
                echo "<a href='$qrCode' download='QRCodePet.png'><img src='$qrCode' alt='QR Code do Pet'></a>";
			?>
		</div>
        <div class="overlay hidden"></div>
    </div>
</body>
</html>
