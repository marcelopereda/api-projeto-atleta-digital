<?php
include "../verificar-autenticacao.php";

require_once "../mpdf/vendor/autoload.php"; // CARREGAR BIBLIOTECA DO MPDF
//DEFINE TIMEZONE para brasil

$lista = ""; // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
if (!empty($_SESSION["clientes"])) {
    foreach ($_SESSION["clientes"] as $key => $client) {
        $lista .= '
            <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td><img src="imagens/' . $client["clientImage"] . '" width="55"></td>
                <td>' . $client["clientName"] . '</td>
                <td>' . $client["clientCPF"] . '</td>
                <td>' . $client["clientEmail"] . '</td>
                <td>' . $client["clientWhatsapp"] . '</td>
                <td>' . $client["clientCEP"] . '</td>
                <td>' . $client["clientLogradouro"] . '</td>
                <td>' . $client["clientNumero"] . '</td>
                <td>' . $client["clientComplemento"] . '</td>
                <td>' . $client["clientBairro"] . '</td>
                <td>' . $client["clientCidade"] . '</td>
                <td>' . $client["clientEstado"] . '</td>
            </tr>
        ';
    }
} else {
    $lista = '
        <tr>
            <td colspan="13">Nenhum cliente cadastrado</td>
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
    <h2 style="text-align: center;">Clientes Cadastrados</h2>
    <p style="text-align: center;">Data: ' . date('d/m/Y H:i:s') . '</p>
    <p style="text-align: center;">Total de Clientes: ' . count($_SESSION["clientes"]) . '</p>
    <table>
        <thead>
            <tr>
                <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:50px" scope="col">Imagem</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Nome</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">CPF</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Email</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">Whatsapp</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">CEP</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Logradouro</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Número</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">Complemento</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">Bairro</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">Cidade</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Estado</th>
            </tr>
        </thead>
        <tbody id="clientTableBody">
            ' . $lista . '
        </tbody>
    </table>
</body>
</html>
';

// CRIA UMA INSTANCIA DO MPDF
$mpdf = new \Mpdf\Mpdf();
// ADICIONA O HTML NA INSTANCIA DO MPDF
$mpdf->WriteHTML($html);
// DEFINE O NOME DO ARQUIVO PDF PARA DOWNLOAD
$nomeArquivo = 'clientes_' . date('YmdHis') . '.pdf';
// DEFINE O NOME DO ARQUIVO PDF PARA DOWNLOAD
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);
// $mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::INLINE);
