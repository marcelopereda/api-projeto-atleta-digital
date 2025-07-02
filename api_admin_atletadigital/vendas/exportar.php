<?php
include "../verificar-autenticacao.php";
//dDEFINE TIMEZONE para brasil
date_default_timezone_set('America/Sao_Paulo');
$filename = "clientes_" . date('YmdHis') . ".xls";

//CABECALHO PARA EXPORTAR O ARQUIVO em excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
?>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div class="col-md-6">
        <!-- Tabela de clientes cadastrados -->
        <h2>Vendas Cadastradas
            <a href="exportar.php" class="btn btn-success btn-sm ">Excel</a>
            <a href="exportar.pdf.php" class="btn btn-danger btn-sm ">Exportar PDF</a>
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
                    <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Cliente</th>
                    <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Produto</th>
                    <th style="background:gray;font-weight:bold;border:1px solid black;width:80px" scope="col">Desconto</th>
                </tr>
            </thead>
            <tbody id="clientTableBody">
                <!-- Os clientes serão carregados aqui via PHP -->
                <?php
                // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
                if (!empty($_SESSION["vendas"])) {
                    foreach ($_SESSION["vendas"] as $key => $sale) {
                        echo '
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
                                <td colspan="4">Nenhum cliente cadastrado</td>
                            </tr>
                            ';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>