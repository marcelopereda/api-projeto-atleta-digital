<?php

include "../verificar-autenticacao.php";

$pagina = "produtos_musculacao";

if (isset($_GET["key"])) {
  $key = $_GET["key"];
  require("../requests/academia/get.php");
  $key = null;
  if (isset($response["data"]) && !empty($response["data"])) {
    // Se houver dados, pega o primeiro e único fornecedor na posição [0]
    $product = $response["data"][0];
  } else {
    $product = null;
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastrar Produto - Academia</title>
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
    <h1 class="text-center  text-white mb-4"><i class="fas fa-dumbbell  me-2"></i>Cadastro de Produto</h1>
    <p class="text-center  text-white">Preencha os campos abaixo para cadastrar um novo produto do setor de academia.</p>
    <a href="../academia/index.php" class="btn  text-white btn-outline-success mb-2 ">
      <i class="fas fa-arrow-left me-2  text-white"></i>Voltar
    </a>
    <div class="card shadow-lg p-4">
      <h2 class="mb-2 text-dark"><i class="fas fa-dumbbell "></i></h2>
      <form method="POST" action="../academia/cadastrar.php" enctype="multipart/form-data">
        <?php if (isset($key)) { ?>
          <input type="hidden" name="productId" value="<?php echo $key; ?>">
        <?php } ?>
        <div class="mb-3">
          <label for="brandId" class="form-label">Setor</label>
          <select name="brandId" id="brandId" class="form-select" required>
            <option value="" selected>Selecione uma marca</option>
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
        </div>
        <hr>
        <div class="mb-3">
          <label for="productName" class="form-label">Nome do Produto</label>
          <input type="text" name="productName" id="productName" class="form-control" required value="<?php echo isset($product) ? $product["productName"] : ""; ?>">
        </div>

        <div class="mb-3">
          <label for="productDescription" class="form-label">Descrição</label>
          <textarea name="productDescription" id="productDescription" class="form-control" rows="4" required><?php echo isset($product) ? $product["productDescription"] : ""; ?></textarea>
        </div>

        <div class="mb-3">
          <label for="productPrice" class="form-label">Preço (R$)</label>
          <input type="number" step="0.01" name="productPrice" id="productPrice" class="form-control" required value="<?php echo isset($product) ? $product["productPrice"] : ""; ?>">
        </div>

        <div class="mb-3">
          <label for="productQuantity" class="form-label">Quantidade Estoque</label>
          <input type="number" name="productQuantity" id="productQuantity" class="form-control" required value="<?php echo isset($product) ? $product["productQuantity"] : ""; ?>">
        </div>

        <div class="mb-3">
          <label for="productImage" class="form-label">Imagem do Produto</label>
          <input type="file" name="productImage" id="productImage" class="form-control" accept="image/*">
        </div>

        <?php if (isset($product["productImage"])) { ?>
          <div class="mb-3">
            <input type="hidden" name="currentProductImage" value="<?php echo $product["productImage"]; ?>">
            <img width="100" src="imagens/<?php echo $product["productImage"]; ?>">
          </div>
        <?php } ?>

        <div class="row g-3">
          <div class="col-md-4">
            <button href="../academia/cadastrar.php" type="submit" class="btn btn-outline-success w-100  shadow-sm">
              <i class="fas fa-save me-2"></i>Salvar Produto
            </button>
          </div>
          <div class="col-md-4">
            <a href="../academia/listar-produtos.php" class="btn btn-outline-secondary w-100  shadow-sm">
              <i class="fas fa-list me-2"></i>Ver Produtos Cadastrados
            </a>
          </div>

        </div>
      </form>
    </div>
  </div>

</body>

</html>