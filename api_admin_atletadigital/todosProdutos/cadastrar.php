<?php
include "../verificar-autenticacao.php";
session_start();

try {
    if (!$_POST) {
        throw new Exception("Acesso indevido! Tente novamente.");
    }

    // Defina os setores válidos
    $setoresValidos = [
        'musculacao' => 'produtos-musculacao',
        'natacao'    => 'produtos-natacao',
        'ra'         => 'produtos-RA',
        'futebol'    => 'produtos-futebol'
    ];

    // Verifica se o setor foi enviado e é válido
    if (empty($_POST['setor']) || !isset($setoresValidos[$_POST['setor']])) {
        throw new Exception("Setor inválido!");
    }

    $sessionKey = $setoresValidos[$_POST['setor']];

    // Processa imagem
    if (!empty($_FILES["productImage"]["name"])) {
        $extensao = pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION);
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        move_uploaded_file($_FILES["productImage"]["tmp_name"], "imagens/$novo_nome");
        $_POST["productImage"] = $novo_nome;

        if (!empty($_POST["currentProductImage"])) {
            @unlink("imagens/" . $_POST["currentProductImage"]);
        }
    } else {
        $_POST["productImage"] = $_POST["currentProductImage"] ?? '';
    }

    // Remove campos auxiliares
    $currentProductImage = $_POST["currentProductImage"] ?? '';
    unset($_POST["currentProductImage"]);

    // Edição ou cadastro novo
    if (isset($_POST["id_setor"]) && $_POST["id_setor"] !== "") {
        // id_setor no formato: musculacao-0, natacao-2, etc
        list($setor, $indice) = explode('-', $_POST["id_setor"]);
        if ($setor !== $_POST['setor'] || !isset($_SESSION[$sessionKey][$indice])) {
            throw new Exception("Produto para edição não encontrado!");
        }
        $_SESSION[$sessionKey][$indice] = $_POST;
        $msg = "Produto atualizado com sucesso!";
    } else {
        $_SESSION[$sessionKey][] = $_POST;
        $msg = "Produto cadastrado com sucesso!";
    }

    $_SESSION["msg"] = $msg;
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ../index.php");
    exit;
}
