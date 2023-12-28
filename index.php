<?php

include 'topHead.php';

?>

<html lang="<?php echo $_SESSION['idioma'];?>">

<?php
include 'bottomHead.php';

?>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/indexStyle.css" />
    <link rel="stylesheet" href="css/darkmode/darkModeIndex.css" />
</head>
<body class="<?= ($_SESSION['darkMode'] == 2 ? "darkmode " : ""); ?><?= ($_SESSION['font'] ? $_SESSION['font'] : ""); ?>">
    <div class="container">
        <?php
            $idUsuario = $_SESSION['id'];
        ?>
        <!--MENU-->
        <?php
            include 'menu.php';
        ?>
        <!--CONTEUDO EM SI-->
        <div class="content">
            <!--add pet-->
            <div id="head">
                <img src="<?= ($_SESSION['darkMode'] == 2 ? "img/logoMyPetDark.png" : "img/logoMyPet.png"); ?>" alt="" />
            </div>
            <!--*CADA PET CADASTRADO APARECE EM DIVS DENTRO DESSAS DIV*-->
            <div id="containerBoxPet">
                <!--*ESSAS SAO AS BOX DA CADA PET*-->
                
                <?php
                    echo $pet->listarPets($idUsuario);
                ?>

                <div id="addPet">
                    <a href="cadastroPetPage.php"><i class="fa fa-paw" aria-hidden="true"></i><label for="btnAddPet" id="addNovoPet">novo</label></a>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>