<?php

$pet = new pet;
$validar = new validar;

abstract class conexao {
  public function connect(){
    // Conexão com o banco de dados
    $host = '127.0.0.1';
    $usuario = 'u390593335_bdalpha';
    $senha = 'Bolsom1to@';
    $database = 'u390593335_bdalpha';
    
    $conexao = new mysqli($host, $usuario, $senha, $database);

    if ($mysqli->connect_error) {
        die("Falha ao se conectar com o banco de dados: " . $mysqli->connect_error);
    }
    return $conexao;
  }
}

if (!isset($_SESSION)) {
    session_start();
}

//////
////
//
// FUNÇÕES PARA SELEÇÃO E ATUALIZAÇÃO DE PET
//
////
//////

class pet extends conexao {
    // Função de selecionar dados de pets
    public function pegarDadosPet($idPet) {
        
        $result = $this->connect()->query("SELECT * FROM pets WHERE idPet = '$idPet'");
        $result = $result->fetch_assoc();
        return $result;
        
    }

    // Função que seleciona a foto de um pet
    public function pegarFotoPet($idPet) {
    
        $result = $this->connect()->query("SELECT * FROM fotospets WHERE idPet = $idPet");
        $result = $result->fetch_assoc();
        return $result;
        
    }
    
    // Função que seleciona os dados do dono do pet
    public function pegarDadosDono($idPet){
        
        $user = $this->pegarIdDono($idPet);
        $idUsuario = $user['idUsuario'];
        $result = $this->connect()->query("SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'");
        $result = $result->fetch_assoc();
        return $result;
        
    }
    
    // Função que seleciona o id do dono do pet
    public function pegarIdDono($idPet){
        
        $result = $this->connect()->query("SELECT idUsuario FROM pets WHERE idPet = '$idPet'");
        $result = $result->fetch_assoc();
        return $result;
        
    }

    // Função que cria lista de pets
    public function listarPets($idUsuario) {
        
        $result = $this->connect()->query("SELECT * FROM pets WHERE idUsuario = $idUsuario");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $pet) {
            
            $row2 = $this->listarFotoPet($pet['idUsuario'], $pet['idPet']);
            
            $out .= "<div class='boxPet'>";
            $out .=     "<a href='atualizaPetPage.php?p=" . $pet['idPet'] . "'>";
            $out .=       "<img class='imgPet' src='/upload/fotospets/" . $row2['imagem'] . "' alt=''>";
            $out .=       "<span>" . $pet['nomePet'] . "</span>";
            $out .=     "</a>";
            $out .= "</div>";
        }
        
        return $out;
        
    }

    // Função que lista imagem de pets
    public function listarFotoPet($idUsuario, $idPet) {
        
        $result = $this->connect()->query("SELECT * FROM fotospets WHERE idUsuario = $idUsuario and idPet = $idPet");
        $result = $result->fetch_assoc();
        return $result;

    }

public function atualizarPet($nomeResponsavel, $telefoneResponsavel, $nomePet, $especie, $raca, $sexo, $tamanho, $idade, $castrado, $vermifugo, $antipulgas, $vacinaV8v10, $vacinaAntirrabica, $vacinaBronchiGuard, $idPet) {
        $nomeResponsavel = $this->connect()->real_escape_string($nomeResponsavel);
        $telefoneResponsavel = $this->connect()->real_escape_string($telefoneResponsavel);
        $nomePet = $this->connect()->real_escape_string($nomePet);
        $especie = $this->connect()->real_escape_string($especie);
        $raca = $this->connect()->real_escape_string($raca);
        $sexo = $this->connect()->real_escape_string($sexo);
        $tamanho = $this->connect()->real_escape_string($tamanho);
        $idade = $this->connect()->real_escape_string($idade);
        $castrado = $this->connect()->real_escape_string($castrado);
        $vermifugo = $this->connect()->real_escape_string($vermifugo);
        $antipulgas = $this->connect()->real_escape_string($antipulgas);
        $vacinaV8v10 = $this->connect()->real_escape_string($vacinaV8v10);
        $vacinaAntirrabica = $this->connect()->real_escape_string($vacinaAntirrabica);
        $vacinaBronchiGuard = $this->connect()->real_escape_string($vacinaBronchiGuard);
        $idPet = $this->connect()->real_escape_string($idPet);

        $query = "UPDATE pets SET nomeResponsavel = '$nomeResponsavel', telefoneResponsavel = '$telefoneResponsavel', nomePet = '$nomePet', especie = '$especie', raca = '$raca', sexo = '$sexo', tamanho = '$tamanho', idade = '$idade', castrado = '$castrado', vermifugo = '$vermifugo', antipulgas = '$antipulgas', vacinaV8v10 = '$vacinaV8v10', vacinaAntirrabica = '$vacinaAntirrabica', vacinaBronchiGuard = '$vacinaBronchiGuard' WHERE idPet = '$idPet'";

        if ($this->connect()->query($query)) {
            return "<p class='text-center alert alert-success'>Dados do pet atualizados com sucesso!</p>";
        } else {
            return "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
    }

    // Função que atualiza a foto de pets
    public function atualizarFotoPet($imagemPet, $idPet) {
        
        $imagemPet = $this->connect()->real_escape_string($imagemPet);
        $idPet = $this->connect()->real_escape_string($idPet);
    
        // Seleciona a imagem antiga para exclusão
        $querySelect = "SELECT * FROM fotospets WHERE idPet = '$idPet'";
        $resultSelect = $this->connect()->query($querySelect);
    
        if ($resultSelect && $resultSelect->num_rows > 0) {
            $pet = $resultSelect->fetch_assoc();
            if ($pet['imagem'] !== "petDefault.png") {
                unlink("../upload/fotospets/" . $pet['imagem']);
            }
        } else {
            echo "<p class='text-center alert alert-warning'>Não foi possível selecionar a imagem antiga: " . $this->connect()->error . "</p>";
            return;
        }
    
        // Atualiza o registro com a nova imagem
        $queryUpdate = "UPDATE fotospets SET imagem = '$imagemPet', data = NOW() WHERE idPet = '$idPet'";
        $resultUpdate = $this->connect()->query($queryUpdate);
    
        if ($resultUpdate) {
            echo "<p class='text-center alert alert-success'>Atualização dos dados da foto efetuada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
    }

// Função para deletar pet
    public function deletarPet($idPet){
        
        $querry = "SELECT * FROM fotospets WHERE idPet = '$idPet'";
        $result = $this->connect()->query($querry);
        if ($result && $result->num_rows > 0) {
            $pet = $result->fetch_assoc();
            if ($pet['imagem'] !== "petDefault.png") {
                unlink("../upload/fotospets/" . $pet['imagem']);
            }
        } else {
            echo "<p class='text-center alert alert-warning'>Não foi possível selecionar a imagem antiga: " . $this->connect()->error . "</p>";
            return;
        }
        
        $queryPet = $this->connect()->query("DELETE pets, fotospets FROM pets INNER JOIN fotospets ON pets.idPet = fotospets.idPet WHERE pets.idPet = '$idPet'");
        if ($this->connect()->query($queryPet)) {
            header("Location: ../index.php");
            echo "<p class='text-center alert alert-success'>Pet Deletado</p>";
        }
    }
}

//////
////
//
// FUNÇÕES DE VALIDAÇÃO PARA LOGIN E CADASTRO DE DADOS
//
////
//////

class validar extends conexao {
    // Função que mostra erros de validação
    public function exibirMensagemErro($erro) {
        if ($erro !== '') {
            echo $erro;
            // Limpar parâmetro de erro da URL
            $novaURL = strtok($_SERVER['REQUEST_URI'], '?');
            echo "<script>window.history.replaceState({}, document.title, '$novaURL');</script>";
        }
    }

    // Retirando caracteres coringa
	public function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// Função caracteres minusculos
	public function caracMinus($data){
		$data = mb_strtolower($data, 'UTF-8');
		return $data;
	}

    // Função máscara de telefone
    public function maskTelefone($number){
        $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
        // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
        return $number;
    }

    // Adicionar erros de valiação
    public function addErros($erro){
        if ($GLOBALS["nmrErros"] > 0) {
            $GLOBALS["urlLogPage"] .= "&" . $erro;
            $GLOBALS["urlCadPage"] .= "&" . $erro;
            $GLOBALS["urlCadPetPage"] .= "&" . $erro;
        } else {
            $GLOBALS["urlLogPage"] .= "?" . $erro;
            $GLOBALS["urlCadPage"] .= "?" . $erro;
            $GLOBALS["urlCadPetPage"] .= "?" . $erro;
        }
		$GLOBALS["nmrErros"]++;
	}

    // Validar campos nome
    public function validarNome($nome, $erroPr, $erroInv, $regexNome){
        if (empty($nome)) {
            $this->addErros($erroPr);
        } else {
            // Valida campo nome
            if (preg_match($regexNome, $nome)) {
                $this-> addErros($erroInv);
            } else {
                // Validate nome
                $nome = preg_replace($regexNome, "", $nome);
                $nome = preg_replace("/\?/i", "", $nome);
                $nome = preg_replace("/\s\s+/", ' ', $nome);
                $nome = $this->caracMinus($nome);
                $nome = $this->validate($nome);
                return $nome;
            }
        }
    }

    // Validar campos email
    public function validarEmail($email, $erroPr, $erroInv){
        // Verifica se o campo email está vazio
        if (empty($email)) {
            $this->addErros($erroPr);
        } else {
            // Validate e-mail
            $email = $this->caracMinus($email);
            $email = $this->validate($email);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email == ""){
                $this->addErros($erroInv);
            }
            return $email;
        }
    }

    // Função de regex senhas
    public function regexSenhas($data){
		return preg_match('/[a-z]/', $data)
		&& preg_match('/[A-Z]/', $data)
		&& preg_match('/[0-9]/', $data)
		&& preg_match('/.*\W.*/', $data);
	}

    // Validar campos senha
    public function validarSenha($senha, $erroPr, $erroInv){
        if (empty($senha)) {
            $this->addErros($erroPr);
        } else {
            if ($this->regexSenhas($senha)){
                $senha = $this->validate($senha);
                return $senha;
            } else {
                $this->addErros($erroInv);
            }
        }
    }

    // Validar campos telefone
    public function validarTelefone($telefone, $erroPr, $erroInv){
        if (empty($telefone)) {
            $this->addErros($erroPr);
        } else {
            $telefone = preg_replace('/[^0-9]/', '', $telefone);
            if (!preg_match("/[0-9]{11}$/", $telefone)) {
                $this->addErros($erroInv);
            } else {
                // Validate telefone
                $telefone = $this->validate($telefone);
                $telefone = $this->maskTelefone($telefone);
                return $telefone;
            }
        }
    }

    // Função de mostrar os dados do usuário
    public function pegarDadosUsuario($idUsuario) {
        $stmt = $this->connect()->query("SELECT * FROM usuarios WHERE idUsuario = $idUsuario");
        $user = $stmt->fetch_assoc();

        return $user;
    }

    // Função de deletar usuário
    public function deletarUsuario($idUsuario){
        /*
         $querry = "SELECT * FROM fotospets WHERE idPet = '$idPet'";
        $result = $this->connect()->query($querry);
        if ($result && $result->num_rows > 0) {
            $pet = $result->fetch_assoc();
            if ($pet['imagem'] !== "petDefault.png") {
                unlink("../upload/fotospets/" . $pet['imagem']);
            }
        } else {
            echo "<p class='text-center alert alert-warning'>Não foi possível selecionar a imagem antiga: " . $this->connect()->error . "</p>";
            return;
        }
        
        $queryPet = $this->connect()->query("DELETE pets, fotospets FROM pets INNER JOIN fotospets ON pets.idPet = fotospets.idPet WHERE pets.idPet = '$idPet'");
        if ($this->connect()->query($queryPet)) {
            echo "<p class='text-center alert alert-success'>Pet Deletado</p>";
        }
        
        foreach ($result as $pet) {
            
            $row2 = $this->listarFotoPet($pet['idUsuario'], $pet['idPet']);
            
            $out .= "<div class='boxPet'>";
            $out .=     "<a href='atualizaPetPage.php?p=" . $pet['idPet'] . "'>";
            $out .=       "<img class='imgPet' src='/upload/fotospets/" . $row2['imagem'] . "' alt=''>";
            $out .=       "<span>" . $pet['nomePet'] . "</span>";
            $out .=     "</a>";
            $out .= "</div>";
        }
        */
        /*
        $query = "SELECT * FROM fotospets WHERE idUsuario = '$idUsuario'";
        $result = $this->connect()->query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $pet) {
            if ($pet['imagem'] !== "petDefault.png") {
                unlink("../upload/fotospets/" . $pet['imagem']);
            }
        } 
        */
        $idUsuario = $this->connect()->real_escape_string($idUsuario);
        
        $queries = [
            "DELETE FROM fotospets WHERE idUsuario = '$idUsuario'",
            "DELETE FROM pets WHERE idUsuario = '$idUsuario'",
            "DELETE FROM fotosusuarios WHERE idUsuario = '$idUsuario'",
            "DELETE FROM usuarios WHERE idUsuario = '$idUsuario'"
        ];
        
        $success = true;
        
        // Executando as queries
        foreach ($queries as $sql) {
             $this->connect()->query($sql);
        }
        
        $result = $this->connect()->query("DELETE usuarios, fotosusuarios, pets, fotospets 
        FROM usuarios INNER JOIN fotosusuarios ON usuarios.idUsuario = fotosusuarios.idUsuario INNER JOIN pets ON fotosusuarios.idUsuario = pets.idUsuario INNER JOIN fotospets ON pets.idUsuario = fotospets.idUsuario WHERE usuarios.idUsuario = '$idUsuario'");
        
        if ($result) {
            echo "<p class='text-center alert alert-success'>Usuario Deletado</p>";
        }
        /*
        $querryDeleteCaminho = "SELECT * FROM fotospets WHERE idUsuario = ?";
        $stmtDeleteCaminho = $this->connect()->prepare($querryDeleteCaminho);
        $stmtDeleteCaminho->execute([$idUsuario]);
        while ($pet = $stmtDeleteCaminho->fetch(PDO::FETCH_ASSOC)) {
            if($pet['imagem'] !== "petDefault.png"){
                unlink("../upload/".$pet['imagem']);
            }
        }

        $queryPets = "DELETE FROM Pets WHERE idUsuario = ?";
        $stmtPets = $this->connect()->prepare($queryPets);
        if ($stmtPets->execute([$idUsuario])) {
            echo "1 record deleted.";
        }

        $queryFoto = "DELETE FROM fotospets WHERE idUsuario = ?";
        $stmtFoto = $this->connect()->prepare($queryFoto);
        if ($stmtFoto->execute([$idUsuario])) {
            echo "1 record deleted.";
        }
        
        $querryUserPic = "DELETE FROM fotosusuarios WHERE idUsuario = ?";
        $stmtUserPic = $this->connect()->prepare($querryUserPic);
        if ($stmtUserPic->execute([$idUsuario])) {
            echo "1 record deleted.";
        }

        $querryUser = "DELETE FROM usuarios WHERE idUsuario = ?";
        $stmtUser = $this->connect()->prepare($querryUser);
        if ($stmtUser->execute([$idUsuario])) {
            echo "1 record deleted.";
        }
        */
    }
    
     // Função para atualizar usuário
    public function atualizarUsuario($nomeUsuario, $idUsuario) {
        
        $_SESSION['nome'] = $nomeUsuario; 
        $nomeUsuario = $this->connect()->real_escape_string($nomeUsuario);
        $idUsuario = $this->connect()->real_escape_string($idUsuario);

        $query = "UPDATE usuarios SET nome = '$nomeUsuario' WHERE idUsuario = '$idUsuario'";

        if ($this->connect()->query($query)) {
            return "<p class='text-center alert alert-success'>Dados do usuario atualizados com sucesso!</p>";
        } else {
            return "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
    }
    
    // Função que atualiza a foto de usuarios
    public function atualizarFotoUsuario($imagemUser, $idUser) {
        
        $imagemUser = $this->connect()->real_escape_string($imagemUser);
        $idUser = $this->connect()->real_escape_string($idUser);
    
        // Seleciona a imagem antiga para exclusão
        $querySelect = "SELECT * FROM fotosusuarios WHERE idUsuario = '$idUser'";
        $resultSelect = $this->connect()->query($querySelect);
    
        if ($resultSelect && $resultSelect->num_rows > 0) {
            $user = $resultSelect->fetch_assoc();
            if ($user['imagem'] !== "userDefault.png") {
                unlink("../upload/fotosusers/" . $user['imagem']);
            }
        } else {
            echo "<p class='text-center alert alert-warning'>Não foi possível selecionar a imagem antiga: " . $this->connect()->error . "</p>";
            return;
        }
    
        // Atualiza o registro com a nova imagem
        $queryUpdate = "UPDATE fotosusuarios SET imagem = '$imagemUser', data = NOW() WHERE idUsuario = '$idUser'";
        $resultUpdate = $this->connect()->query($queryUpdate);
    
        if ($resultUpdate) {
            echo "<p class='text-center alert alert-success'>Atualização dos dados da foto efetuada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
    }

    // Função para coletar e salvar uma imagem externa
    /*
    public function coletarImagemExterna($url, $idUsuario)
    {
        $idUsuario = $this->connect()->real_escape_string($idUsuario);
    
        // Verifica se a extensão da imagem é válida (opcional)
        $extensoesValidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extensao = pathinfo($url, PATHINFO_EXTENSION);
    
        if (!in_array(strtolower($extensao), $extensoesValidas)) {
            echo "<p class='text-center alert alert-danger'>Extensão de arquivo inválida.</p>";
            return;
        }
    
        // Cria um nome único para a imagem com base no ID do usuário
        $nomeImagem = 'user_' . $idUsuario . '.' . $extensao;
    
        // Caminho onde a imagem será salva localmente
        $caminhoLocal = "../upload/fotosusers/" . $nomeImagem;
    
        // Obtém o conteúdo da imagem externa
        $conteudoImagem = file_get_contents($url);
    
        if ($conteudoImagem !== false) {
            // Salva o conteúdo no arquivo local
            file_put_contents($caminhoLocal, $conteudoImagem);
    
            // Atualiza o registro no banco de dados com o novo nome da imagem
            $queryUpdateFoto = "UPDATE fotosusuarios SET imagem = '$nomeImagem', data = NOW() WHERE idUsuario = '$idUsuario'";
            $resultUpdateFoto = $this->connect()->query($queryUpdateFoto);
    
            if ($resultUpdateFoto) {
                echo "<p class='text-center alert alert-success'>Imagem externa coletada e atualizada com sucesso!</p>";
            } else {
                echo "<p class='text-center alert alert-danger'>Erro ao atualizar a imagem: " . $this->connect()->error . "</p>";
            }
        } else {
            echo "<p class='text-center alert alert-danger'>Erro ao coletar a imagem externa.</p>";
        }
    }
    */
    
    // Função que seleciona a foto de um user
    public function pegarFotoUsuario($idUsuario) {
        $query = "SELECT * FROM fotosusuarios WHERE idUsuario = '$idUsuario'";
        $result = $this->connect()->query($query);
    
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro ao selecionar a foto do usuário: " . $this->connect()->error . "</p>";
            return null;
        }
    }

    // Função que atualiza o tamanho da fonte
    public function atualizarFontSize($idUsuario, $fontSize) {
        
        $_SESSION['font'] = $fontSize; 
        $fontSize = $this->connect()->real_escape_string($fontSize);
        $idUsuario = $this->connect()->real_escape_string($idUsuario);
        
        $query = "UPDATE usuarios SET fonte = '$fontSize' WHERE idUsuario = '$idUsuario'";
        
        if ($this->connect()->query($query)) {
            return "<p class='text-center alert alert-success'>Tamanho da Fonte atualizado com sucesso</p>";
        } else {
            return "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
        
    }

     // Função que atualiza o idioma padrão
     public function atualizarIdioma($idUsuario, $idioma) {
         
        $_SESSION['idioma'] = $idioma;
        $idioma = $this->connect()->real_escape_string($idioma);
        $idUsuario = $this->connect()->real_escape_string($idUsuario);
        
        $query = "UPDATE usuarios SET idioma = '$idioma' WHERE idUsuario = '$idUsuario'";
        
        if ($this->connect()->query($query)) {
            return "<p class='text-center alert alert-success'>Idioma atualizada com sucesso!</p>";
        } else {
            return "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
        
    }

    // Função que atualiza o dark-mode
    public function atualizarDarkMode($idUsuario, $darkMode) {
        
        $_SESSION['darkMode'] = $darkMode;
        $darkMode = $this->connect()->real_escape_string($darkMode);
        $idUsuario = $this->connect()->real_escape_string($idUsuario);
        
        $query = "UPDATE usuarios SET darkMode = '$darkMode' WHERE idUsuario = '$idUsuario'";
        
        if ($this->connect()->query($query)) {
            return "<p class='text-center alert alert-success'>tema atualizado com sucesso!</p>";
        } else {
            return "<p class='text-center alert alert-danger'>Erro: " . $this->connect()->error . "</p>";
        }
        
    }
}