<?php
include "../verificar-autenticacao.php";
//dDEFINE TIMEZONE para brasil
date_default_timezone_set('America/Sao_Paulo');
$filename = "produtos_" . date('YmdHis') . ".xls";

//CABECALHO PARA EXPORTAR O ARQUIVO em excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
?>

<head>
    <meta charset="UTF-8">
</head>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="background:gray;font-weight:bold;border:1px solid black"scope="col">#</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Imagem</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Nome</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Descrição</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:80px" scope="col">Preço</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:80px" scope="col">Quantidade</th>
        </tr>
    </thead>
    <tbody id="productTableBody">
        <!-- Os produtos serão carregados aqui via PHP -->
        <?php
        // SE HOUVER PRODUTOS NA SESSÃO, EXIBIR
        if (!empty($_SESSION["produtos-natacao"])) {
            foreach ($_SESSION["produtos-natacao"] as $key => $product) {
                echo '
                                <tr>
                                    <th scope="row">' . ($key + 1) . '</th>
                                    <td><img src="imagens/' . $product["productImage"] . '"width="55"></td>
                                    <td>' . $product["productName"] . '</td>
                                    <td>' . $product["productDescription"] . '</td>
                                    <td>R$ ' . number_format($product["productPrice"], 2, ',', '.') . '</td>
                                    <td>' . $product["productQuantity"] . '</td>
                                </tr>
                                ';
            }
        } else {
            echo '
                            <tr>
                                <td colspan="6">Nenhum produto cadastrado</td>
                            </tr>
                            ';
        }
        ?>
    </tbody>
</table>