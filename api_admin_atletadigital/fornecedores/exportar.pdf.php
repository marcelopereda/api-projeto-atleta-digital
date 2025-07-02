<?php
include "../verificar-autenticacao.php";

require_once "../mpdf/vendor/autoload.php"; // CARREGAR BIBLIOTECA DO MPDF
//dDEFINE TIMEZONE para brasil

$lista = "";                  // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
if (!empty($_SESSION["fornecedores"])) {
    foreach ($_SESSION["fornecedores"] as $key => $provider) {
        $lista .= '
            <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td><img src="imagens/' . $provider["providerImage"] . '" width="55"></td>
                <td>' . $provider["providerName"] . '</td>
                <td>' . $provider["providerCNPJ"] . '</td>
                <td>' . $provider["providerEmail"] . '</td>
                <td>' . $provider["providerWhatsapp"] . '</td>
                <td>' . ($provider["providerLogradouro"] ?? '') . '</td>
                <td>' . ($provider["providerNumero"] ?? '') . '</td>
                <td>' . ($provider["providerComplemento"] ?? '') . '</td>
                <td>' . ($provider["providerBairro"] ?? '') . '</td>
                <td>' . ($provider["providerCidade"] ?? '') . '</td>
                <td>' . ($provider["providerEstado"] ?? '') . '</td>
                <td>' . ($provider["providerCEP"] ?? '') . '</td>
            </tr>
        ';
    }
} else {
    $lista .= '
        <tr>
            <td colspan="13">Nenhum fornecedor cadastrado</td>
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
    <h2 style="text-align: center;">Fornecedores Cadastrados</h2>
    <p style="text-align: center;">Data: ' . date('d/m/Y H:i:s') . '</p>
    <p style="text-align: center;">Total de Fornecedores: ' . count($_SESSION["fornecedores"]) . '</p>
<table>
        <thead>
            <tr>
                <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:50px" scope="col">Razão Social</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">CNPJ</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">E-mail</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Whatsapp</th>
            </tr>
        </thead>
        <tbody id="providerTableBody">
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
$nomeArquivo = 'fornecedores_' . date('YmdHis') . '.pdf';
//DEFINE O NOME DO ARQUIVO PDF PARA DOWLOAD
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);
// $mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::INLINE);
