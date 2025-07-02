<?php
include "../verificar-autenticacao.php";

require_once "../mpdf/vendor/autoload.php"; // CARREGAR BIBLIOTECA DO MPDF
//dDEFINE TIMEZONE para brasil

$lista = "";                  // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
if (!empty($_SESSION["vendas"])) {
    foreach ($_SESSION["vendas"] as $key => $sale) {
        $lista .= '
                                <tr>
                                    <th scope="row">' . ($key + 1) . '</th>
                                    <td>' . $sale["saleName"] . '</td>
                                    <td>' . $sale["saleProduct"] . '</td>
                                    <td>' . $sale["saleDiscount"] . '</td>
                                </tr>
                                ';
    }
} else {
    echo '
                            <tr>
                                <td colspan="5">Nenhum cliente cadastrado</td>
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
    <h2 style="text-align: center;">Vendas Cadastrados</h2>
    <p style="text-align: center;">Data: ' . date('d/m/Y H:i:s') . '</p>
    <p style="text-align: center;">Total de Vendas: ' . count($_SESSION["vendas"]) . '</p>
<table>
      <thead>
                        <tr>
                            <th style="background:gray;font-weight:bold;border:1px solid black"  scope="col">#</th>
                            <th style="background:gray;font-weight:bold;border:1px solid black;width:50px" scope="col">Cliente</th>
                            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Produto</th>
                            <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">Desconto</th>
                        </tr>
                    </thead>
                    <tbody id="saleTableBody">
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
$nomeArquivo = 'vendas_' . date('YmdHis') . '.pdf';
//DEFINE O NOME DO ARQUIVO PDF PARA DOWLOAD
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);
// $mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::INLINE);
