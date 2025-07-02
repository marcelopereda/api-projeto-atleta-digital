<?php
// Verifica a autenticação do usuário
include "../verificar-autenticacao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Fornecedores</title>
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

    <div class="container py-5 shadow-lg mt-4 bg-white rounded-5">
        <!-- Cabeçalho da página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark"><i class="fas fa-truck me-2"></i>Fornecedores Cadastrados</h2>
            <a href="<?php echo $_SESSION["url"]; ?>/fornecedores/index.php" class="btn btn-outline-success shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <!-- Botões de ações -->
                <a href="../fornecedores/detalhe-fornecedor.php" class="btn btn-outline-primary shadow-sm"><i class="fas fa-plus"></i> Novo Fornecedor</a>
                <a href="../fornecedores/exportar.php" class="btn btn-outline-success shadow-sm"><i class="fas fa-file-excel"></i> Exportar Excel</a>
                <a href="../fornecedores/exportar.pdf.php" class="btn btn-outline-danger shadow-sm"><i class="fas fa-file-pdf"></i> Exportar PDF</a>

                <!-- Formulário de pesquisa -->
                <form class="d-inline-block" method="GET" action="../fornecedores/listar-fornecedores.php">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar fornecedores..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabela de fornecedores -->
        <div class="table-responsive shadow-lg rounded-4">
            <table class="table table-hover align-middle">
            <thead class="table-dark text-uppercase">
                <tr>
                <th>#</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Email</th>
                <th>Whatsapp</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Complemento</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inicializa variáveis de pesquisa
                $termoPesquisa = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
                $fornecedoresEncontrados = false;

                // Verifica se há fornecedores cadastrados
                if (!empty($_SESSION["fornecedores"])) {
                foreach ($_SESSION["fornecedores"] as $key => $provider) {
                    // Filtra fornecedores com base no termo de pesquisa
                    if (!empty($termoPesquisa)) {
                    $razaoSocial = strtolower($provider["providerName"]);
                    $emailFornecedor = strtolower($provider["providerEmail"]);
                    if (strpos($razaoSocial, $termoPesquisa) === false && strpos($emailFornecedor, $termoPesquisa) === false) {
                        continue;
                    }
                    }

                    $fornecedoresEncontrados = true;
                   
                    echo '
                <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . htmlspecialchars($provider["providerName"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerCNPJ"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerEmail"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerWhatsapp"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerLogradouro"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerNumero"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerComplemento"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerBairro"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerCidade"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerEstado"] ?? "") . '</td>
                <td>' . htmlspecialchars($provider["providerCEP"] ?? "") . '</td>
                <td>
                    <a href="../fornecedores/detalhe-fornecedor.php?key=' . $key . '"  class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i> Editar</a>
                    <a href="../fornecedores/remover.php?key=' . $key . '" class="btn btn-sm btn-outline-danger btn-sm me-2 mb-2"><i class="fas fa-trash"></i> Excluir</a>
                </td>
                </tr>';
                }

                // Mensagem caso nenhum fornecedor seja encontrado na pesquisa
                if (!empty($termoPesquisa) && !$fornecedoresEncontrados) {
                    echo '<tr><td colspan="13" class="text-center">
                <div class="alert alert-warning p-4 mb-0 shadow-sm">
                <i class="fas fa-exclamation-circle fa-lg me-2"></i>Nenhum fornecedor encontrado para "' . htmlspecialchars($termoPesquisa) . '"
                </div>
                </td></tr>';
                }
                } else {
                // Mensagem caso não haja fornecedores cadastrados
                echo '<tr><td colspan="13" class="text-center">
                <div class="alert alert-info p-4 mb-0 shadow-sm">
                <i class="fas fa-info-circle fa-lg me-2 text-primary"></i>Nenhum fornecedor cadastrado até o momento.
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