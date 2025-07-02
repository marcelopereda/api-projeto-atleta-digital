<?php

include "../verificar-autenticacao.php";

$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $provider = $_SESSION["fornecedores"][$key];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Fornecedor - Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="form-container mt-5">
        <h1 class="text-center text-white mb-4"><i class="fas fa-truck me-2"></i>Cadastro de Fornecedor</h1>
        <p class="text-center text-white">Preencha os campos abaixo para cadastrar um novo fornecedor.</p>
        <a href="<?php echo $_SESSION["url"]; ?>/fornecedores/index.php" class="btn text-white btn-outline-success mb-2">
            <i class="fas fa-arrow-left me-2 text-white"></i>Voltar
        </a>
        <div class="card shadow-lg p-4">
            <h2 class="mb-2 text-dark"><i class="fas fa-truck"></i></h2>
            <form method="POST" action="../fornecedores/cadastrar.php" enctype="multipart/form-data">
                <?php if (isset($key)) { ?>
                    <input type="hidden" name="providerId" value="<?php echo $key; ?>">
                <?php } ?>
                <div class="mb-3">
                    <label for="providerName" class="form-label">Nome do Fornecedor</label>
                    <input type="text" name="providerName" id="providerName" class="form-control" required value="<?php echo isset($provider) ? $provider["providerName"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerCNPJ" class="form-label">CNPJ</label>
                    <input data-mask="00.000.000/0000-00" type="text" name="providerCNPJ" id="providerCNPJ" class="form-control" required value="<?php echo isset($provider) ? $provider["providerCNPJ"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerEmail" class="form-label">E-mail</label>
                    <input type="email" name="providerEmail" id="providerEmail" class="form-control" required value="<?php echo isset($provider) ? $provider["providerEmail"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerWhatsapp" class="form-label">Whatsapp</label>
                    <input type="text" name="providerWhatsapp" id="providerWhatsapp" class="form-control" required value="<?php echo isset($provider) ? $provider["providerWhatsapp"] : ""; ?>">
                </div>
                <div class="mb-3">
                    <label for="providerLogradouro" class="form-label">Logradouro</label>
                    <input type="text" name="providerLogradouro" id="providerLogradouro" class="form-control" required value="<?php echo isset($provider) ? $provider["providerLogradouro"] ?? "" : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerNumero" class="form-label">Número</label>
                    <input type="text" name="providerNumero" id="providerNumero" class="form-control" required value="<?php echo isset($provider) ? $provider["providerNumero"] ?? "" : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerComplemento" class="form-label">Complemento</label>
                    <input type="text" name="providerComplemento" id="providerComplemento" class="form-control" value="<?php echo isset($provider) ? $provider["providerComplemento"] ?? "" : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerBairro" class="form-label">Bairro</label>
                    <input type="text" name="providerBairro" id="providerBairro" class="form-control" required value="<?php echo isset($provider) ? $provider["providerBairro"] ?? "" : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerCidade" class="form-label">Cidade</label>
                    <input type="text" name="providerCidade" id="providerCidade" class="form-control" required value="<?php echo isset($provider) ? $provider["providerCidade"] ?? "" : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerEstado" class="form-label">Estado</label>
                    <input type="text" name="providerEstado" id="providerEstado" class="form-control" required value="<?php echo isset($provider) ? $provider["providerEstado"] ?? "" : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="providerCEP" class="form-label">CEP</label>
                    <input type="text" name="providerCEP" id="providerCEP" class="form-control" required value="<?php echo isset($provider) ? $provider["providerCEP"] ?? "" : ""; ?>">
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <button href="../fornecedores/cadastrar.php" type="submit" class="btn btn-outline-success w-100 shadow-sm">
                            <i class="fas fa-save me-2"></i>Salvar Fornecedor
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="../fornecedores/listar-fornecedores.php" class="btn btn-outline-secondary w-100 shadow-sm">
                            <i class="fas fa-list me-2"></i>Ver Fornecedores Cadastrados
                        </a>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>

</body>

</html>