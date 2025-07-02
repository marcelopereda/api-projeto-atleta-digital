<?php

include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "home";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php include '../navbar.php'; ?>
    <?php include '../mensagens.php'; ?>

    <div class="content">
        <div class="container mt-4">
            <h3 class="mb-4"><i class="fas fa-truck text-success"></i> Painel de Gerenciamento - Fornecedores</h3>
            <p class="text-muted">Gerencie os fornecedores e acompanhe os pedidos de reposição de estoque.</p>
            <a href="<?php echo $_SESSION["url"]; ?>index.php" class="btn btn-outline-success mt-3">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <hr>

            <div class="row g-3">
                <div class="col-md-4">
                    <a href="<?php echo $_SESSION["url"]; ?>/fornecedores/detalhe-fornecedor.php" class="btn btn-outline-primary w-100 p-3 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Cadastrar Fornecedor
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo $_SESSION["url"]; ?>/fornecedores/listar-fornecedores.php" class="btn btn-outline-secondary w-100 p-3 shadow-sm">
                        <i class="fas fa-list me-2"></i>Fornecedores Cadastrados
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo $_SESSION["url"]; ?>/fornecedores/pedidos-reposicao.php" class="btn btn-outline-success w-100 p-3 shadow-sm">
                        <i class="fas fa-boxes me-2"></i>Pedidos de Reposição
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container mt-4">
            <h2 class="mb-4"><i class="fas fa-chart-pie text-success"></i> Relatórios de Fornecedores</h2>
            <p class="text-muted">Acompanhe o desempenho e a confiabilidade dos fornecedores.</p>

            <div class="card mt-4 shadow">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-truck-loading text-primary me-2"></i>Últimos Pedidos de Reposição</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fornecedor</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#205</td>
                                    <td>Fornecedor A</td>
                                    <td>R$ 1.500,00</td>
                                    <td><span class="badge bg-warning">Pendente</span></td>
                                    <td><button class="btn btn-sm btn-outline-success">Confirmar Recebimento</button></td>
                                </tr>
                                <tr>
                                    <td>#204</td>
                                    <td>Fornecedor B</td>
                                    <td>R$ 2.300,00</td>
                                    <td><span class="badge bg-info">Enviado</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary">Rastrear</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="#" class="btn btn-outline-primary mt-2">Ver todos os pedidos</a>
                </div>
            </div>

            <div class="card mt-4 shadow">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-star text-warning me-2"></i>Fornecedores Destaque</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Fornecedor A
                            <span class="badge bg-success">Confiabilidade: 95%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Fornecedor B
                            <span class="badge bg-success">Confiabilidade: 90%</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card mt-4 shadow">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle text-danger me-2"></i>Problemas Recentes</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pedido #203 - Atraso na entrega
                            <a href="#" class="btn btn-sm btn-outline-danger">Ver detalhes</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pedido #202 - Produto com defeito
                            <a href="#" class="btn btn-sm btn-outline-danger">Ver detalhes</a>
                        </li>
                    </ul>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        </div>
    </div>
</body>

</html>