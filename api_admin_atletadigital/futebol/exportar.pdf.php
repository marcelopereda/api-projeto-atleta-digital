<?php
include "../verificar-autenticacao.php";

require_once "../mpdf/vendor/autoload.php"; // CARREGAR BIBLIOTECA DO MPDF
//dDEFINE TIMEZONE para brasil

$lista = "";                  // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
if (!empty($_SESSION["produtos-futebol"])) {
    foreach ($_SESSION["produtos-futebol"] as $key => $product) {
        $lista .= '
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

$html = '
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Produtos Cadastrados</h2>
    <p style="text-align: center;">Data: ' . date('d/m/Y H:i:s') . '</p>
    <p style="text-align: center;">Total de Produtos: ' . count($_SESSION["produtos"]) . '</p>
<table>
        <thead>
            <tr>
                <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:50px" scope="col">Imagem</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Nome</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Descrição</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Preço</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Quantidade</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            ' . $lista . '
        </tbody>
</table>
</body>
</html>
';

//CRIA UMA INSTANCIA DO MPDF
$mpdf = new \Mpdf\Mpdf();
//ADICIONA O HTML NA INSTANCIA DO MPDF
$mpdf->WriteHTML($html);
//DEFINE O NOME DO ARQUIVO PDF PARA DOWLOAD
$nomeArquivo = 'produtos_' . date('YmdHis') . '.pdf';
//DEFINE O NOME DO ARQUIVO PDF PARA DOWLOAD
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);
// $mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::INLINE);
