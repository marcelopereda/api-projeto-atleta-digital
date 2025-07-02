<?php
// Verifica a autenticação do usuário
include "../verificar-autenticacao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
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

    <div class="container py-5  card mt-4 bg-white rounded-5">
        <!-- Cabeçalho da página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark"><i class="fas fa-swimmer me-2"></i>Produtos Cadastrados</h2>
            <a href="<?php echo $_SESSION["url"]; ?>/natacao/index.php" class="btn btn-outline-success shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <!-- Botões de ações -->
                <a href="../natacao/detalhe-produto.php" class="btn btn-outline-primary shadow-sm"><i class="fas fa-plus"></i> Novo Produto</a>
                <a href="../natacao/exportar.php" class="btn btn-outline-success shadow-sm"><i class="fas fa-file-excel"></i> Exportar Excel</a>
                <a href="../natacao/exportar.pdf.php" class="btn btn-outline-danger shadow-sm"><i class="fas fa-file-pdf"></i> Exportar PDF</a>

                <!-- Formulário de pesquisa -->
                <form class="d-inline-block" method="GET" action="../natacao/listar-produtos.php">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar produtos..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabela de produtos -->
        <div class="table-responsive card shadow-lg rounded-4">
            <table class="table table-striped align-middle">
                <thead class="table-dark text-uppercase">
                    <tr>
                        <th>#</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Inicializa variáveis de pesquisa
                    $termoPesquisa = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
                    $produtosEncontrados = false;

                    // Verifica se há produtos cadastrados
                    if (!empty($_SESSION["produtos-natacao"])) {
                        foreach ($_SESSION["produtos-natacao"] as $key => $product) {
                            // Filtra produtos com base no termo de pesquisa
                            if (!empty($termoPesquisa)) {
                                $nomeProduto = strtolower($product["productName"]);
                                $descProduto = strtolower($product["productDescription"]);
                                if (strpos($nomeProduto, $termoPesquisa) === false && strpos($descProduto, $termoPesquisa) === false) {
                                    continue;
                                }
                            }

                            $produtosEncontrados = true;
                            // Exibe os produtos encontrados
                            echo '
                                <tr>
                                    <th scope="row">' . ($key + 1) . '</th>
                                    <td><img src="imagens/' . $product["productImage"] . '" width="55"></td>
                                    <td>' . $product["productName"] . '</td>
                                    <td>' . $product["productDescription"] . '</td>
                                    <td>R$ ' . number_format($product["productPrice"], 2, ',', '.') . '</td>
                                    <td>' . $product["productQuantity"] . '</td>
                                    <td>
                                        <a href="../natacao/detalhe-produto.php?key=' . $key . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i> Editar</a>
                                        <a href="../natacao/remover.php?key=' . $key . '" class="btn btn-sm btn-outline-danger btn-sm me-2 mb-2"><i class="fas fa-trash"></i> Excluir</a>
                                    </td>
                                </tr>';
                        }

                        // Mensagem caso nenhum produto seja encontrado na pesquisa
                        if (!empty($termoPesquisa) && !$produtosEncontrados) {
                            echo '<tr><td colspan="7" class="text-center">
                                <div class="alert alert-warning p-4 mb-0 shadow-sm">
                                    <i class="fas fa-exclamation-circle fa-lg me-2"></i>Nenhum produto encontrado para "' . htmlspecialchars($termoPesquisa) . '"
                                </div>
                            </td></tr>';
                        }
                    } else {
                        // Mensagem caso não haja produtos cadastrados
                        echo '<tr><td colspan="7" class="text-center">
                            <div class="alert alert-info p-4 mb-0 shadow-sm">
                                <i class="fas fa-info-circle fa-lg me-2 text-primary"></i>Nenhum produto cadastrado até o momento.
                            </div>
                        </td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>