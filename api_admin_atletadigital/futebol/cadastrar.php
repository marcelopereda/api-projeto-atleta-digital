<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";



try {
    if (!$_POST) {
        throw new Exception("Acesso indevido! Tente novamente.");
    }

    if ($_FILES["productImage"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO    
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["productImage"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["productImage"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM CADASTRADA
        if ($_POST["currentProductImage"] != "") {
            // EXCLUIR IMAGEM DO PRODUTO
            unlink("imagens/" . $_POST["currentProductImage"]);
        } 
    } else {
        $_POST["productImage"] = $_POST["currentProductImage"];
    }

    if ($_POST["productId"] == "") {
        $_SESSION["produtos-futebol"][] = $_POST; // PRODUTO NOVO
        $msg = "Produto cadastrado com sucesso!";
    } else {
        // PRODUTO JÁ CADASTRADO
        $_SESSION["produtos-futebol"][$_POST["productId"]] = $_POST;
        $msg = "Produto atualizado com sucesso!";
    }

    $_SESSION["msg"] = $msg;
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location:../futebol/listar-produtos.php");
    exit;
}
