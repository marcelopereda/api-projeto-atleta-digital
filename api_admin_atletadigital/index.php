<?php
// Inclui o arquivo de verificação de autenticação
include "verificar-autenticacao.php";

// Define a página atual para controle de navegação
$pagina = "home";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Estilo Global -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <?php
  // Inclui mensagens e barra de navegação
  include "mensagens.php";
  include "navbar.php";
  ?>

    <!-- Conteúdo Principal -->
    <div class="content py-5">
        <div class="container">
            <!-- Título do Painel -->
            <h2 class="dashboard-heading text-center">
                <i class="fas fa-cogs me-2 text-primary"></i>Painel Administrativo
            </h2>

            <!-- Seção de Categorias -->
            <div class="row gy-4">
                <!-- Clientes -->
                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-primary border-2">
                        <h4><i class="fas fa-users me-2 text-primary"></i>Clientes
                            <?php require("requests/clientes/get.php"); ?>
                            (<?php echo isset($response['data']) ? count($response['data']) : 0; ?>)</h4>
                        <p>Gerencie todos os clientes no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/clientes" class="btn btn-outline-primary w-100 mb-2">
                            <i class="fas fa-users"></i> Acessar
                        </a>
                    </div>
                </div>

                <!-- Fornecedores -->
                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-success border-2">
                        <h4><i class="fas fa-truck me-2 text-success"></i>Fornecedores
                            <?php require("requests/fornecedores/get.php"); ?>
                            (<?php echo isset($response['data']) ? count($response['data']) : 0; ?>)
                        </h4>
                        <p>Controle de todos os fornecedores no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/fornecedores"
                            class="btn btn-outline-success w-100 mb-2">
                            <i class="fas fa-truck"></i> Acessar
                        </a>
                    </div>
                </div>

                <!-- Produtos -->
                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-danger border-2">
                        <h4><i class="fas fa-box-open me-2 text-danger"></i>Produtos
                            <?php require("requests/produtos/get.php"); ?>
                            (<?php echo isset($response['data']) ? count($response['data']) : 0; ?>)</h4>
                        <p>Gerencie todos os produtos no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/produtos" class="btn btn-outline-danger w-100 mb-2">
                            <i class="fas fa-box-open"></i> Acessar
                        </a>
                    </div>
                </div>

                <!-- Vendas -->
                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-warning border-2">
                        <h4><i class="fas fa-shopping-cart me-2 text-warning"></i>Vendas
                            (<?php echo isset($_SESSION["vendas"]) ? count($_SESSION["vendas"]) : 0; ?>)</h4>
                        <p>Acompanhe em tempo real todas as vendas no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/vendas" class="btn btn-outline-warning w-100 mb-2">
                            <i class="fas fa-shopping-cart"></i> Acessar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Indicadores de Desempenho -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Faturamento Mensal</h6>
                            <h4 class="text-success">R$ 28.450,00</h4>
                            <small class="text-muted">+12% vs mês anterior</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Ticket Médio</h6>
                            <h4 class="text-primary">R$ 189,90</h4>
                            <small class="text-muted">Por venda</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Carrinhos Abandonados</h6>
                            <h4 class="text-danger">15</h4>
                            <small class="text-muted">Hoje</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Novos Clientes</h6>
                            <h4 class="text-warning">+24</h4>
                            <small class="text-muted">Este mês</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Próximos Eventos -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt text-info me-2"></i>Próximos Eventos</h5>
                </div>
                <div class="card-body p-2">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex justify-content-between">
                                <span>Reabastecimento estoque</span>
                                <small class="text-muted">15/05</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex justify-content-between">
                                <span>Pagamento fornecedores</span>
                                <small class="text-muted">20/05</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alertas e Ações Rápidas -->
            <div class="row mt-4">
                <!-- Alertas -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Alertas
                                Importantes</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning d-flex align-items-center mb-3">
                                <i class="fas fa-box me-3 fs-4"></i>
                                <div>
                                    <strong>5 produtos com estoque crítico</strong>
                                    <p class="mb-0 small">Itens com menos de 3 unidades disponíveis</p>
                                </div>
                            </div>
                            <div class="alert alert-danger d-flex align-items-center mb-3">
                                <i class="fas fa-credit-card me-3 fs-4"></i>
                                <div>
                                    <strong>2 pagamentos pendentes</strong>
                                    <p class="mb-0 small">Boletos não pagos com vencimento próximo</p>
                                </div>
                            </div>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-truck me-3 fs-4"></i>
                                <div>
                                    <strong>3 pedidos para enviar hoje</strong>
                                    <p class="mb-0 small">Prazo de entrega próximo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ações Rápidas -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-bolt text-primary me-2"></i>Ações Rápidas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/produtos/adicionar"
                                        class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-plus-circle me-1"></i> Novo Produto
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/vendas/nova"
                                        class="btn btn-outline-success w-100 mb-2">
                                        <i class="fas fa-cash-register me-1"></i> Nova Venda
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/clientes/adicionar"
                                        class="btn btn-outline-info w-100 mb-2">
                                        <i class="fas fa-user-plus me-1"></i> Novo Cliente
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/relatorios"
                                        class="btn btn-outline-secondary w-100 mb-2">
                                        <i class="fas fa-file-alt me-1"></i> Gerar Relatório
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <h6 class="mt-3"><i class="fas fa-bullhorn text-warning me-2"></i>Campanha Ativa</h6>
                            <div class="alert alert-light border">
                                <strong>FRETE GRÁTIS</strong> - Para compras acima de R$ 200,00
                                <div class="mt-2">
                                    <span class="badge bg-success">Ativa</span>
                                    <small class="text-muted ms-2">Termina em 5 dias</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Últimas Vendas -->
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-history text-secondary me-2"></i>Últimas Vendas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1025</td>
                                    <td>João Silva</td>
                                    <td>10/05/2023</td>
                                    <td>R$ 249,90</td>
                                    <td><span class="badge bg-success">Entregue</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1024</td>
                                    <td>Maria Souza</td>
                                    <td>09/05/2023</td>
                                    <td>R$ 189,90</td>
                                    <td><span class="badge bg-warning">Em transporte</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?php echo $_SESSION["url"]; ?>/vendas" class="btn btn-sm btn-outline-secondary mt-2">Ver
                        todas as vendas</a>
                </div>
            </div>

            <!-- Top 5 Produtos -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-star text-warning me-2"></i>Top 5 Produtos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Categoria</th>
                                    <th>Vendas</th>
                                    <th>Estoque</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Camiseta Performance</td>
                                    <td>Roupas</td>
                                    <td>128</td>
                                    <td class="text-success">42</td>
                                </tr>
                                <tr>
                                    <td>Whey Protein 1kg</td>
                                    <td>Suplementos</td>
                                    <td>95</td>
                                    <td class="text-warning">8</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Links Importantes -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-link text-secondary me-2"></i>Links Importantes</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <a href="https://www.receita.fazenda.gov.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-globe me-1"></i> Receita Federal
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="https://www.bcb.gov.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-university me-1"></i> Banco Central
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="https://www.sebrae.com.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-briefcase me-1"></i> Sebrae
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="https://www.inss.gov.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-user-shield me-1"></i> INSS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>