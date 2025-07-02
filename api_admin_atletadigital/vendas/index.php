<?php
// Verifica a autenticação do usuário
include "../verificar-autenticacao.php";

$pagina = "vendas";

// Inicializa variáveis para edição
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $sale = $_SESSION["vendas"][$key];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel de Vendas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Estilo customizado -->
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color: rgba(179, 248, 225, 0.2);">

    <?php
    // Inclui mensagens e barra de navegação
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="container card mt-4 py-5  bg-white rounded-5">
        <!-- Cabeçalho da página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark"><i class="fas fa-chart-line me-2"></i>Painel de Vendas</h2>
            <div>
                <a href="../index.php" class="btn btn-outline-success shadow-sm me-2"><i class="fas fa-arrow-left me-1"></i> Voltar</a>
                <a href="exportar.php" class="btn btn-outline-success shadow-sm me-2"><i class="fas fa-file-excel"></i> Excel</a>
                <a href="exportar.pdf.php" class="btn btn-outline-danger shadow-sm"><i class="fas fa-file-pdf"></i> PDF</a>
            </div>
        </div>

        <div class="row">
            <!-- Formulário de cadastro/edição -->
            <div class="container py-3 shadow-lg bg-white  rounded-2 mb-4">
                <div class="col-12 mb-3">
                    <h5 class="mb-3 text-primary">
                        <i class="fas fa-plus-circle me-2"></i>Cadastrar Venda
                       
                    </h5>
                    <form id="productForm" action="/vendas/cadastrar.php" method="POST" class="row g-2 align-items-end">
                        <div class="col-auto">
                            <input type="text" class="form-control form-control-sm" id="saleId" name="saleId" placeholder="Cód." readonly style="width: 70px;" value="<?php echo isset($key) ? $key : ""; ?>">
                        </div>
                        <div class="col-auto">
                            <select id="saleName" name="saleName" class="form-select form-select-sm" required>
                                <option value="">Cliente</option>
                                <?php
                                foreach ($_SESSION["clientes"] as $key => $client) {
                                    $selected = (isset($sale) && $sale["saleName"] == $client["clientName"]) ? 'selected' : '';
                                    echo '<option value="' . $client["clientName"] . '" ' . $selected . '>' . $client["clientName"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select id="saleProduct" name="saleProduct" class="form-select form-select-sm" required>
                                <option value="">Produto</option>
                                <?php
                                foreach ($_SESSION["produtos-musculacao"] as $key => $product) {
                                    $selected = (isset($sale) && $sale["saleProduct"] == $product["productName"]) ? 'selected' : '';
                                    echo '<option value="' . $product["productName"] . '" ' . $selected . '>' . $product["productName"] . ' - Musc.</option>';
                                }
                                foreach ($_SESSION["produtos-natacao"] as $key => $product) {
                                    $selected = (isset($sale) && $sale["saleProduct"] == $product["productName"]) ? 'selected' : '';
                                    echo '<option value="' . $product["productName"] . '" ' . $selected . '>' . $product["productName"] . ' - Nat.</option>';
                                }
                                foreach ($_SESSION["produtos-futebol"] as $key => $product) {
                                    $selected = (isset($sale) && $sale["saleProduct"] == $product["productName"]) ? 'selected' : '';
                                    echo '<option value="' . $product["productName"] . '" ' . $selected . '>' . $product["productName"] . ' - Fut.</option>';
                                }
                                foreach ($_SESSION["produtos-RA"] as $key => $product) {
                                    $selected = (isset($sale) && $sale["saleProduct"] == $product["productName"]) ? 'selected' : '';
                                    echo '<option value="' . $product["productName"] . '" ' . $selected . '>' . $product["productName"] . ' - RA</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">R$</span>
                                <input type="number" class="form-control" id="saleDiscount" name="saleDiscount" placeholder="Desc." required value="<?php echo isset($sale) ? $sale["saleDiscount"] : ""; ?>" style="width: 80px;">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary btn-sm shadow-sm">
                                <i class="fas fa-check"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Tabela de vendas -->
        <div class="container py-5 bg-white rounded-5">
            <div class=" p-4 bg-white  rounded-5">
                <h4 class="mb-4 text-dark">
                    <i class="fas fa-list me-2 text-secondary"></i>Vendas Cadastradas
                </h4>
                <div class="table-responsive card rounded-4 shadow-lg">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Desconto</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_SESSION["vendas"])) {
                                foreach ($_SESSION["vendas"] as $key => $sale) {
                                    echo '
                                    <tr>
                                        <td>' . ($key + 1) . '</td>
                                        <td>' . htmlspecialchars($sale["saleName"]) . '</td>
                                        <td>' . htmlspecialchars($sale["saleProduct"]) . '</td>
                                        <td>R$ ' . htmlspecialchars($sale["saleDiscount"]) . '</td>
                                        <td>
                                            <a href="./?key=' . $key . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="remover.php?key=' . $key . '" class="btn btn-sm btn-outline-danger btn-sm me-2 mb-2">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-info p-4 mb-0 shadow-sm">
                                            <i class="fas fa-info-circle me-2 text-primary"></i>Nenhuma venda cadastrada.
                                        </div>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
