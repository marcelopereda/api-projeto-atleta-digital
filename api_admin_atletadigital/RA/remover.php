<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // EXCLUIR IMAGEM DO PRODUTO
    if (file_exists("imagens/" . $_SESSION["produtos-RA"][$key]["productImage"])) {
        unlink("imagens/" . $_SESSION["produtos-RA"][$key]["productImage"]);
    }
    // UNSET = REMOVE UM ITEM DE UM ARRAY
    unset($_SESSION["produtos-RA"][$key]);
    // ARRAY_VALUES = REORGANIZA OS ÍNDICES DO ARRAY
    $_SESSION["produtos-RA"] = array_values($_SESSION["produtos-RA"]);
    $_SESSION["msg"] = "Produto removido com sucesso!";
}
header("Location: ../RA/listar-produtos.php");
exit;
