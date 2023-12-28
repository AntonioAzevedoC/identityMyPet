<?php
include "inclusao/inclusao.php";

// O ternário á apenas para teste
$p = $_GET['p'];
$rs = $pet->pegarDadosPet($p);
$rsFoto = $pet->pegarFotoPet($p);
$rsDono = $pet->pegarDadosDono($p);

?>

<!DOCTYPE html>
<html lang="<?php echo $rsDono['idioma'];?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <meta http-equiv="refresh" content="1">-->
    <title><?= $rs['nomePet']; ?></title>
    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/viewPetStyle.css" />
     <!-- SCRIPTS -->
    <script defer src="js/traducao.js"></script>
</head>
<body>
    <div class="containerEl">
        <div class="contentEl">
            <div class="leftSpace">
                <div id="boxImgPetView">
                    <img id="imgPet" src="/upload/fotospets/<?= $rsFoto['imagem']; ?>" alt="" />
                    <span id="namePet"><?= $rs['nomePet']; ?></span>
                </div>
            </div>
            <div class="righSpace">
                <div id="rightSContente">
                     <!--primeira caixa de informção -->
                    <div class="boxInfor">
                        <h1 class="h1Title" id="titleCaracteristicas">características</h1>
                        <div class="infor">
                            <div class="infor01">
                                <label class="labelInfor" id="especieLbl">especie</label>
                                <label class="labelInfor" id="racaLbl">raça</label>
                                <label class="labelInfor" id="sexoLbl">sexo</label>
                                <label class="labelInfor" id="tamanhoLbl">tamanho</label>
                                <label class="labelInfor" id="idadeLbl">idade</label>
                            </div>
                            <div class="infor02">
                                <a href="" class="aInfor"><?= $rs['especie']; ?></a>
                                <a href="" class="aInfor"><?= $rs['raca']; ?></a>
                                <a href="" class="aInfor" id="<?= $rs['sexo'] === "m" ? "macho" : "femea"; ?>"></a>
                                <a href="" class="aInfor" id="<?= $rs['tamanho']; ?>"></a>
                                <a href="" class="aInfor" id="<?= $rs['idade']; ?>"></a>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <!--primeira caixa de informção -->
                    <div class="boxInfor">
                        <h1 class="h1Title" id="titleSaude">saúde</h1>
                        <div class="infor">
                            <div class="infor201">
                                <div class="infor011">
                                    <img src="<?= ($rs['castrado'] == 1 ? "img/1.png" : "img/2.png"); ?>" class="yesOrNo" alt="">
                                    <label class="labelInfor2" id="castradoLbl">castrado</label>
                                </div>
                                <div class="infor011">
                                    <img src="<?= ($rs['vermifugo'] == 1 ? "img/1.png" : "img/2.png"); ?>" class="yesOrNo" alt="">
                                    <label class="labelInfor2" id="vermifugoLbl">vermifugo</label>
                                </div>
                                <div class="infor011">
                                    <img src="<?= ($rs['antipulgas'] == 1 ? "img/1.png" : "img/2.png"); ?>" class="yesOrNo" alt="">
                                    <label class="labelInfor2" id="antiPulgaLbl">anti pulgas/carrapatos</label>
                                </div>
                                <div class="infor011">
                                    <img src="<?= ($rs['vacinaV8v10'] == 1 ? "img/1.png" : "img/2.png"); ?>" class="yesOrNo" alt="">
                                    <label class="labelInfor2" id="V8Lbl">vacina v8/v10</label>
                                </div>
                                <div class="infor011">
                                    <img src="<?= ($rs['vacinaAntirrabica'] == 1 ? "img/1.png" : "img/2.png"); ?>" class="yesOrNo" alt="">
                                    <label class="labelInfor2" id="antirrabicaLbl">Vacina antirrábica</label>
                                </div>
                                <div class="infor011">
                                    <img src="<?= ($rs['vacinaBronchiguard'] == 1 ? "img/1.png" : "img/2.png"); ?>" class="yesOrNo" alt="" />
                                    <label class="labelInfor2" id="bronchiGuardLbl">Vacina bronchiGuard</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <!--primeira caixa de informção -->
                    <div class="boxInfor">
                        <h1 class="h1Title" id="titleResponsavel">responsável</h1>
                        <div class="infor">
                            <div class="infor01">
                                <label class="labelInfor" id="nomeResponsavelLbl">nome</label>
                                <label class="labelInfor">e-mail</label>
                                <label class="labelInfor" id="telefoneResponsavelLbl">telefone</label>
                            </div>
                            <div class="infor02">
                                <a href="" class="aInfor"><?= $rs['nomeResponsavel']; ?></a>
                                <a href="" class="aInfor"><?= $rsDono['email']; ?></a>
                                <a href="" class="aInfor"><?= $rs['telefoneResponsavel']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>