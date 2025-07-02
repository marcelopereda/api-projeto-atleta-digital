<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único cliente na posição [0]
        $client = $response["data"][0];
    } else {
        $client = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente - Clientes</title>
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

    <div class="form-container mt-5 ">
        <h1 class="text-center  text-white mb-4"><i class="fas fa-user  me-2"></i>Cadastro de Cliente</h1>
        <p class="text-center  text-white">Preencha os campos abaixo para cadastrar um novo cliente.</p>
        <a href="../clientes/index.php" class="btn  text-white btn-outline-success mb-2 ">
            <i class="fas fa-arrow-left me-2  text-white"></i>Voltar
        </a>
        <div class="card shadow-lg p-4">
            <h2 class="mb-2 text-dark"><i class="fas fa-user "></i></h2>
            <form id="clientForm" method="POST" action="../clientes/cadastrar.php" enctype="multipart/form-data">

                <input type="hidden" name="clientId" id="clientId" readonly
                    value="<?php echo isset($client) ? $client["id_cliente"] : ""; ?>">

                <!-- <div class="mb-3">
                    <label for="brandId" class="form-label">Marca</label>
                    <select name="brandId" id="brandId" class="form-select" required>
                        <option value="">Selecione uma marca</option>
                        <?php
                        // Carrega as marcas do banco de dados
                        require("../requests/marcas/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $marcas) {
                                $selected = (isset($product) && $product["id_marca"] == $marcas["id_marca"]) ? "selected" : "";
                                echo '<option value="' . $marcas["id_marca"] . '" ' . $selected . '>' . $marcas["marca"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div> -->
                <hr>
                <div class="mb-3">
                    <label for="clientName" class="form-label">Nome do Cliente</label>
                    <input type="text" name="clientName" id="clientName" class="form-control" required
                        value="<?php echo isset($client) ? $client["nome"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientCPF" class="form-label">CPF</label>
                    <input data-mask="000.000.000-00" type="text" name="clientCPF" id="clientCPF" class="form-control"
                        required value="<?php echo isset($client) ? $client["cpf"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientEmail" class="form-label">Email</label>
                    <input type="email" name="clientEmail" id="clientEmail" class="form-control" required
                        value="<?php echo isset($client) ? $client["email"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientWhatsapp" class="form-label">WhatsApp</label>
                    <input data-mask="(00) 0 0000-0000" type="text" name="clientWhatsapp" id="clientWhatsapp"
                        class="form-control" required value="<?php echo isset($client) ? $client["whatsapp"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientImage" class="form-label">Imagem do Cliente</label>
                    <input type="file" name="clientImage" id="clientImage" class="form-control" accept="image/*">
                </div>
                <?php
                // SE HOUVER IMAGEM NO CLIENTE, EXIBIR MINIATURA
                if (isset($client["imagem"])) {
                    echo '
                        <div class="col-md-3">
                            <input type="hidden" name="currentClientImage" value="' . $client["imagem"] . '">
                            <img width="100" src="imagens/' . $client["imagem"] . '">
                        </div>
                        ';
                }
                ?>
                <div class=" mb-3">
                    <label for="clientCEP" class="form-label">CEP</label>
                    <input data-mask="00000-000" type="text" name="clientCEP" id="clientCEP" class="form-control"
                        required value="<?php echo isset($client) ? $client["endereco"]["cep"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientStreet" class="form-label">Logradouro</label>
                    <input type="text" name="clientStreet" id="clientStreet" class="form-control" required
                        value="<?php echo isset($client) ? $client["endereco"]["logradouro"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientNumber" class="form-label">Número</label>
                    <input type="text" name="clientNumber" id="clientNumber" class="form-control" required
                        value="<?php echo isset($client) ? $client["endereco"]["numero"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientComplement" class="form-label">Complemento</label>
                    <input type="text" name="clientComplement" id="clientComplement" class="form-control"
                        value="<?php echo isset($client) ? $client["endereco"]["complemento"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientNeighborhood" class="form-label">Bairro</label>
                    <input type="text" name="clientNeighborhood" id="clientNeighborhood" class="form-control" required
                        value="<?php echo isset($client) ? $client["endereco"]["bairro"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientCity" class="form-label">Cidade</label>
                    <input type="text" name="clientCity" id="clientCity" class="form-control" required
                        value="<?php echo isset($client) ? $client["endereco"]["cidade"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="clientState" class="form-label">Estado</label>
                    <imput type="text" maxlength="2" name="clientState" id="clientState" class="form-control" required
                        value="<?php echo isset($client) ? $client["endereco"]["estado"] : ""; ?>">

                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <button href="../clientes/cadastrar.php" type="submit"
                            class="btn btn-outline-success w-100  shadow-sm">
                            <i class="fas fa-save me-2"></i>Salvar Cliente
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="../clientes/index.php" class="btn btn-outline-secondary w-100  shadow-sm">
                            <i class="fas fa-list me-2"></i>Ver Clientes Cadastrados
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
    $('#clientCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        // Verifica se o CEP tem 8 dígitos
        if (cep.length === 8) {
            // Faz a requisição para a API ViaCEP
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#clientStreet').val(data.logradouro);
                    $('#clientNeighborhood').val(data.bairro);
                    $('#clientCity').val(data.localidade);
                    $('#clientState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#clientCEP").val("");
                    $("#clientStreet").val("");
                    $("#clientNeighborhood").val("");
                    $("#clientCity").val("");
                    $("#clientState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            // Limpa os campos de endereço
            $("#clientCEP").val("");
            $("#clientStreet").val("");
            $("#clientNeighborhood").val("");
            $("#clientCity").val("");
            $("#clientState").val("");
        }
    });
    </script>

</body>

</html>