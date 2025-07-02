<?php

include "../verificar-autenticacao.php";

$pagina = "produtos-futebol";

if (isset($_GET["key"])) {
  $key = $_GET["key"];
  $product = $_SESSION["produtos-futebol"][$key];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastrar Produto - Futebol</title>
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
    <h1 class="text-center  text-white mb-4"><i class="fas fa-futbol  me-2"></i>Cadastro de Produto</h1>
    <p class="text-center  text-white">Preencha os campos abaixo para cadastrar um novo produto do setor de futebol.</p>
    <a href="<?php echo $_SESSION["url"]; ?>/futebol/index.php" class="btn  text-white btn-outline-success mb-2 ">
      <i class="fas fa-arrow-left me-2  text-white"></i>Voltar
    </a>
    <div class="card shadow-lg p-4">
      <h2 class="mb-2 text-dark"><i class="fas fa-futbol "></i></h2>
      <form method="POST" action="../futebol/cadastrar.php" enctype="multipart/form-data">
        <?php if (isset($key)) { ?>
          <input type="hidden" name="productId" value="<?php echo $key; ?>">
        <?php } ?>
        <div class="mb-3">
          <label for="categoria" class="form-label">Setor</label>
          <select name="categoria" id="categoria" class="form-select" required>
            <option value="" selected>Selecione Categoria</option>
            <option value="camisa">Camisa</option>
            <option value="calcado">Calçado</option>
            <option value="acessorio">Acessório</option>
            <option value="shorts">Shorts</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="tamanho" class="form-label">Tamanho</label>
          <select name="tamanho" id="tamanho" class="form-select" required>
            <option value="" selected>Selecione o Tamanho</option>
            <option value="PP" <?php if (isset($product) && $product["tamanho"] == "PP") echo "selected"; ?>>PP</option>
            <option value="P" <?php if (isset($product) && $product["tamanho"] == "P") echo "selected"; ?>>P</option>
            <option value="M" <?php if (isset($product) && $product["tamanho"] == "M") echo "selected"; ?>>M</option>
            <option value="G" <?php if (isset($product) && $product["tamanho"] == "G") echo "selected"; ?>>G</option>
            <option value="GG" <?php if (isset($product) && $product["tamanho"] == "GG") echo "selected"; ?>>GG</option>
            <option value="Único" <?php if (isset($product) && $product["tamanho"] == "Único") echo "selected"; ?>>Único</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="cor" class="form-label">Cor</label>
          <select name="cor" id="cor" class="form-select" required>
            <option value="" selected>Selecione a Cor</option>
            <option value="Preto" <?php if (isset($product) && $product["cor"] == "Preto") echo "selected"; ?>>Preto</option>
            <option value="Branco" <?php if (isset($product) && $product["cor"] == "Branco") echo "selected"; ?>>Branco</option>
            <option value="Azul" <?php if (isset($product) && $product["cor"] == "Azul") echo "selected"; ?>>Azul</option>
            <option value="Vermelho" <?php if (isset($product) && $product["cor"] == "Vermelho") echo "selected"; ?>>Vermelho</option>
            <option value="Verde" <?php if (isset($product) && $product["cor"] == "Verde") echo "selected"; ?>>Verde</option>
            <option value="Amarelo" <?php if (isset($product) && $product["cor"] == "Amarelo") echo "selected"; ?>>Amarelo</option>
            <option value="Rosa" <?php if (isset($product) && $product["cor"] == "Rosa") echo "selected"; ?>>Rosa</option>
            <option value="Cinza" <?php if (isset($product) && $product["cor"] == "Cinza") echo "selected"; ?>>Cinza</option>
            <option value="Laranja" <?php if (isset($product) && $product["cor"] == "Laranja") echo "selected"; ?>>Laranja</option>
            <option value="Outra" <?php if (isset($product) && $product["cor"] == "Outra") echo "selected"; ?>>Outra</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="sexo" class="form-label">Sexo</label>
          <select name="sexo" id="sexo" class="form-select" required>
            <option value="" selected>Selecione o Sexo</option>
            <option value="Masculino" <?php if (isset($product) && $product["sexo"] == "Masculino") echo "selected"; ?>>Masculino</option>
            <option value="Feminino" <?php if (isset($product) && $product["sexo"] == "Feminino") echo "selected"; ?>>Feminino</option>
            <option value="Unissex" <?php if (isset($product) && $product["sexo"] == "Unissex") echo "selected"; ?>>Unissex</option>
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
            <button type="submit" class="btn btn-outline-success w-100  shadow-sm">
              <i class="fas fa-save me-2"></i>Salvar Produto
            </button>
          </div>
          <div class="col-md-4">
            <a href="../futebol/listar-produtos.php" class="btn btn-outline-secondary w-100  shadow-sm">
              <i class="fas fa-list me-2"></i>Ver Produtos Cadastrados
            </a>
          </div>

        </div>
      </form>
    </div>
  </div>

</body>

</html>