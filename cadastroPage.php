<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cadastro</title>
        <?php   
            include "inclusao/inclusao.php";
            $erroNome = isset($_GET['erroNome']) ? $_GET['erroNome'] : '';
            $erroEmail = isset($_GET['erroEmail']) ? $_GET['erroEmail'] : '';
            $erroSenha = isset($_GET['erroSenha']) ? $_GET['erroSenha'] : '';
            $erroConfSenha = isset($_GET['erroConfirm']) ? $_GET['erroConfirm'] : '';
        ?>
        <!-- ESTILOS -->
        <link rel="stylesheet" href="css/loginCadastroPageStyle.css" />
        <!-- SCRIPTS -->
        <script defer src="js/validacaoCadastro.js"></script>
    </head>
    <body> 
        <div class="container">
            <!--PARTE DA ESQUERDA, ONDE ESTÁ A IMAGEM-->
            <div class="imageSpace">
                <div class="imageSpaceBg">
                    <div class="imageSpaceContent">
                        <img src="img/logo.png" alt="" />
                        <p id="descricaoLogo">A ferramenta perfeita para proporcionar segurança e tranquilidade tanto para você quanto para seu amado pet.
                        </p>
                    </div>
                </div>
            </div>
            <!--PARTE DA DIREITA, ONDE ESTÃO OS CAMPOS-->
            <div class="formSpace">
                <div class="formSpaceContent">
                    <p id="welcome">Bem-vindo ao</p>
                    <img src="img/logoMyPet.png" alt="" />
                    <!--FORMULARIO-->
                    <form id="form" action="processaCadastro.php" method="POST"> 
                        <!--input NOME-->
                        <div class="inputBox">    
                            <label for="nome" class="labelInput" id="labelNome">nome</label>                  
                            <input type="text" name="nome" class="inputCadastro" id="nomeCadastro" minlength="5" maxlength="80" required />
                        </div>
                        <!--span ERROS DE INSERÇÃO DE NOME-->
						<span class="span" id="erroNome" style="color: red;">
                            <?php
                                echo $validar->exibirMensagemErro($erroNome);
							?>
						</span>
                        <!--input EMAIL-->
                        <div class="inputBox">    
                            <label for="email" class="labelInput" id="labelEmail">email</label>                  
                            <input type="email" name="email" class="inputCadastro" id="emailCadastro" onchange="" minlenght="5" maxlength="256" required />
                        </div>
                        <!--span ERROS DE INSERÇÃO DE EMAIL-->
						<span class="span" id="erroEmail" style="color: red;">
                            <?php
                                echo $validar->exibirMensagemErro($erroEmail);
							?>
						</span>
                        <!--input SENHA-->
                        <div class="inputBox"> 
                            <label for="senha" class="labelInput" id="labelSenha">senha</label>
                            <input type="password" name="senha" class="inputCadastro" id="senhaCadastro" onchange="" minlength="8" maxlength="30" required />
                        </div>
                        <!--span ERROS DE INSERÇÃO DE SENHA-->
						<span class="span" id="erroSenha" style="color: red;">
                            <?php
                                echo $validar->exibirMensagemErro($erroSenha);
							?>
						</span>
                        <!--input CONFIRMAR SENHA-->
                        <div class="inputBox"> 
                            <label for="confSenha" class="labelInput" id="labelConf">confirmação senha</label>
                            <input type="password" name="confSenha" class="inputCadastro" id="confSenhaCadastro" onchange="" minlength="8" maxlength="30" required />
                        </div>
                        <!--span ERROS DE INSERÇÃO DO USUÁRIO-->
						<span class="span" id="erroConfSenha" style="color: red;">
                            <?php
                                echo $validar->exibirMensagemErro($erroConfSenha);
							?>
						</span>
                        <input type="submit" class="btn" id="btnSubmit" name="entrar" value="Cadastrar" />
                    </form>
                    <!--FIM FORMULARIO-->
                   <p id="cadastar">Já tem conta? <a href="loginPage.php">Entrar agora</a></p>
                </div>
            </div>
        </div>
    </body>
</html>