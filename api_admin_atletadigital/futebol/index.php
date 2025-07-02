<?php

include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "home";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Painel Futebol</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

  <?php include '../navbar.php'; ?>
  <?php include '../mensagens.php'; ?>

  <div class="content ">
    <div class="container mt-4">
      <h3 class="mb-4"><i class="fas  fa-futbol text-dark"></i> Painel de Gerenciamento - Futebol</h3>
      <p class="text-muted">Gerencie os equipamentos, acessórios e suplementos voltados para futebol e treino físico.</p>
      <a href="<?php echo $_SESSION["url"];?>index.php" class="btn btn-outline-success  mt-3">
        <i class="fas fa-arrow-left me-2"></i>Voltar
      </a>
      <hr>

      <div class="row g-3">
        <div class="col-md-4">
          <a href="<?php echo $_SESSION["url"]; ?>/futebol/detalhe-produto.php" class="btn btn-outline-primary w-100 p-3 shadow-sm">
            <i class="fas fa-plus-circle me-2"></i>Cadastrar Produto
          </a>
        </div>
        <div class="col-md-4">
          <a href="<?php echo $_SESSION["url"]; ?>/futebol/listar-produtos.php" class="btn btn-outline-secondary w-100 p-3 shadow-sm">
            <i class="fas fa-edit me-2"></i>Produtos Cadastrados
          </a>
        </div>
        <div class="col-md-4">
          <a href="<?php echo $_SESSION["url"]; ?>/futebol/relatorio-vendas.php" class="btn btn-outline-success w-100 p-3 shadow-sm">
            <i class="fas fa-chart-bar me-2"></i>Relatório de Vendas
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container mt-4">
      <h2 class="mb-4"><i class="fas fa-chart-pie text-success"></i> Gráficos de Desempenho</h2>
      <p class="text-muted">Visualize o desempenho dos produtos de futebol com gráficos interativos.</p>

      <div class="card mt-4 shadow">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-shopping-bag text-primary me-2"></i>Últimos Pedidos</h5>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Valor</th>
                  <th>Status</th>
                  <th>Ação</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#1025</td>
                  <td>João Silva</td>
                  <td>R$ 249,90</td>
                  <td><span class="badge bg-warning">Pendente</span></td>
                  <td><button class="btn btn-sm btn-outline-success">Marcar como Pago</button></td>
                </tr>
                <tr>
                  <td>#1024</td>
                  <td>Maria Souza</td>
                  <td>R$ 189,90</td>
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
          <h5 class="card-title"><i class="fas fa-boxes text-danger me-2"></i>Controle de Estoque</h5>
          <div class="row">
            <div class="col-md-6">
              <h6><i class="fas fa-fire text-danger me-2"></i>Mais Vendidos</h6>
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Camiseta Futebol
                  <span class="badge bg-success">+120 vendas</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Bola Oficial
                  <span class="badge bg-success">+85 vendas</span>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <h6><i class="fas fa-exclamation-triangle text-warning me-2"></i>Estoque Baixo</h6>
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Chuteiras (Preto)
                  <span class="badge bg-danger">2 unidades</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Luvas de Goleiro
                  <span class="badge bg-danger">3 unidades</span>
                </li>
              </ul>
            </div>
          </div>
          <a href="<?php echo $_SESSION["url"]; ?>/futebol/controle-estoque.php" class="btn btn-outline-danger mt-3">
            <i class="fas fa-box-open me-2"></i>Ir para Controle de Estoque
          </a>
        </div>
      </div>

      <div class="card mt-4 shadow">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-chart-line text-success me-2"></i>Desempenho de Vendas</h5>
          <div class="row text-center">
            <div class="col-md-3">
              <h6>Faturamento</h6>
              <p class="fs-4 text-success">R$ 28.450,00</p>
            </div>
            <div class="col-md-3">
              <h6>Ticket Médio</h6>
              <p class="fs-4 text-primary">R$ 189,90</p>
            </div>
            <div class="col-md-3">
              <h6>Conversão</h6>
              <p class="fs-4 text-info">3,2%</p>
            </div>
            <div class="col-md-3">
              <h6>Novos Clientes</h6>
              <p class="fs-4 text-warning">+45</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card mt-4 shadow">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-users text-info me-2"></i>Clientes Destaque</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Total Gasto</th>
                  <th>Última Compra</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Carlos Oliveira</td>
                  <td>R$ 1.250,00</td>
                  <td>2 dias atrás</td>
                  <td><button class="btn btn-sm btn-outline-primary">Enviar Cupom</button></td>
                </tr>
                <tr>
                  <td>Ana Santos</td>
                  <td>R$ 890,00</td>
                  <td>1 semana atrás</td>
                  <td><button class="btn btn-sm btn-outline-success">Oferecer Assinatura</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card mt-4 shadow">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-truck text-secondary me-2"></i>Status de Entregas</h5>
          <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>5 pedidos em transporte</strong> - Previsão de entrega em 2 dias.
          </div>
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Pedido #1021 - Correios
              <a href="#" class="btn btn-sm btn-outline-secondary">Rastrear</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Pedido #1019 - Jadlog
              <a href="#" class="btn btn-sm btn-outline-secondary">Rastrear</a>
            </li>
          </ul>
          <a href="<?php echo $_SESSION["url"]; ?>/futebol/pedidos-em-transporte.php" class="btn btn-outline-primary mt-3">
            Ver todos os pedidos em transporte
          </a>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    </div>
  </div>
</body>

</html>