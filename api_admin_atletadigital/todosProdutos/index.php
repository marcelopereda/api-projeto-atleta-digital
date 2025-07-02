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

    <div class="container py-5 card mt-4 bg-white rounded-5">
        <!-- Cabeçalho da página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark"><i class="fas fa-boxes me-2"></i>Produtos Cadastrados</h2>
            <a href="<?php echo $_SESSION["url"]; ?>/index.php" class="btn btn-outline-success shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
        </div>

        <!-- Campo de pesquisa -->
        <form method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="busca" class="form-control" placeholder="Pesquisar produto..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
            </div>
        </form>

        <!-- Tabela de produtos -->
        <div class="table-responsive card shadow-lg rounded-4">
            <table class="table table-hover align-middle">
                <thead class="table-dark text-uppercase">
                    <tr>
                        <th>#</th>
                        <th>Setor</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Array para armazenar todos os produtos
                    $todosOsProdutos = [];

                    // Adicionar produtos de musculação
                    if (isset($_SESSION["produtos-musculacao"]) && is_array($_SESSION["produtos-musculacao"])) {
                        foreach ($_SESSION["produtos-musculacao"] as $key => $produto) {
                            $produto['setor'] = 'Musculação';
                            $produto['id_setor'] = 'musculacao-' . $key;
                            $todosOsProdutos[] = $produto;
                        }
                    }

                    // Adicionar produtos de natação
                    if (isset($_SESSION["produtos-natacao"]) && is_array($_SESSION["produtos-natacao"])) {
                        foreach ($_SESSION["produtos-natacao"] as $key => $produto) {
                            $produto['setor'] = 'Natação';
                            $produto['id_setor'] = 'natacao-' . $key;
                            $todosOsProdutos[] = $produto;
                        }
                    }

                    // Adicionar produtos de Realidade Aumentada (RA)
                    if (isset($_SESSION["produtos-RA"]) && is_array($_SESSION["produtos-RA"])) {
                        foreach ($_SESSION["produtos-RA"] as $key => $produto) {
                            $produto['setor'] = 'Realidade Aumentada';
                            $produto['id_setor'] = 'ra-' . $key;
                            $todosOsProdutos[] = $produto;
                        }
                    }

                    // Adicionar produtos de futebol
                    if (isset($_SESSION["produtos-futebol"]) && is_array($_SESSION["produtos-futebol"])) {
                        foreach ($_SESSION["produtos-futebol"] as $key => $produto) {
                            $produto['setor'] = 'Futebol';
                            $produto['id_setor'] = 'futebol-' . $key;
                            $todosOsProdutos[] = $produto;
                        }
                    }

                    // Filtrar produtos se houver busca
                    if (isset($_GET['busca']) && trim($_GET['busca']) !== '') {
                        $busca = mb_strtolower(trim($_GET['busca']));
                        $todosOsProdutos = array_filter($todosOsProdutos, function($produto) use ($busca) {
                            return mb_strpos(mb_strtolower($produto["productName"]), $busca) !== false
                                || mb_strpos(mb_strtolower($produto["productDescription"]), $busca) !== false
                                || mb_strpos(mb_strtolower($produto["setor"]), $busca) !== false;
                        });
                        // Reindexa o array para manter a numeração correta
                        $todosOsProdutos = array_values($todosOsProdutos);
                    }

                    
                 
                    // Exibir todos os produtos
                    if (!empty($todosOsProdutos)) {
                        foreach ($todosOsProdutos as $key => $produto) {
                            echo '
                            <tr>
                                <th scope="row">' . ($key + 1) . '</th>
                                <td><span class="badge bg-info">' . $produto['setor'] . '</span></td>
                                <td>' . htmlspecialchars($produto["productName"]) . '</td>
                                <td>' . htmlspecialchars($produto["productDescription"]) . '</td>
                                <td>R$ ' . number_format($produto["productPrice"], 2, ',', '.') . '</td>
                                <td>' . $produto["productQuantity"] . '</td>
                                <td>
                                    <a href="../todosProdutos/cadastrar.php?key=' . $key . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Editar</a>
                                    <a href="../todosProdutos/remover.php?key=' . $key . '" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Deseja realmente excluir este produto?\');"><i class="fas fa-trash"></i> Excluir</a>
                                </td>
                            </tr>';
                        }

                    exit;
                    } else {
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
