<?php
include "../verificar-autenticacao.php";
// DEFINE TIMEZONE para Brasil
date_default_timezone_set('America/Sao_Paulo');
$filename = "clientes_" . date('YmdHis') . ".xls";

// CABECALHO PARA EXPORTAR O ARQUIVO em excel
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
            <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Nome</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">CPF</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Email</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">WhatsApp</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Imagem</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:150px" scope="col">CEP</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Logradouro</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Número</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Complemento</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Bairro</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Cidade</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:200px" scope="col">Estado</th>
        </tr>
    </thead>
    <tbody id="clientTableBody">
        <!-- Os clientes serão carregados aqui via PHP -->
        <?php
        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
        if (!empty($_SESSION["clientes"])) {
            foreach ($_SESSION["clientes"] as $key => $client) {
                echo '
                    <tr>
                        <th scope="row">' . ($key + 1) . '</th>
                        <td>' . $client["clientName"] . '</td>
                        <td>' . $client["clientCPF"] . '</td>
                        <td>' . $client["clientEmail"] . '</td>
                        <td>' . $client["clientWhatsapp"] . '</td>
                        <td><img src="imagens/' . $client["clientImage"] . '" width="55"></td>
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
            echo '
                <tr>
                    <td colspan="13">Nenhum cliente cadastrado</td>
                </tr>
            ';
        }
        ?>
    </tbody>
</table>