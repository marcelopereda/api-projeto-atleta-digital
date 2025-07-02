<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

try {
    if (!$_POST) {
        throw new Exception("Acesso indevido! Tente novamente.");
    }

    if ($_FILES["providerImage"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["providerImage"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO    
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["providerImage"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["providerImage"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM CADASTRADA
        if ($_POST["currentProviderImage"] != "") {
            // EXCLUIR IMAGEM DO FORNECEDOR
            unlink("imagens/" . $_POST["currentProviderImage"]);
        } 
    } else {
        $_POST["providerImage"] = $_POST["currentProviderImage"];
    }

    if ($_POST["providerId"] == "") {
        $_SESSION["fornecedores"][] = $_POST; // FORNECEDOR NOVO
        $msg = "Fornecedor cadastrado com sucesso!";
    } else {
        // FORNECEDOR JÁ CADASTRADO
        $_SESSION["fornecedores"][$_POST["providerId"]] = $_POST;
        $msg = "Fornecedor atualizado com sucesso!";
    }

    $_SESSION["msg"] = $msg;
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location:../fornecedores/detalhe-fornecedor.php");
    exit;
}
