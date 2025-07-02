<?php
include "../verificar-autenticacao.php";

// Verifica se foi passado um parâmetro 'id' na URL
if(isset($_GET['productName'])) {
    $idBuscado = $_GET['productName']; // Pega o valor do parâmetro GET
    
    // Verifica se existe produtos na sessão
    if (!empty($_SESSION["produtos-musculacao"])) {
        $produtoEncontrado = null;
        
        // Procura o produto com ID correspondente
        foreach ($_SESSION["produtos-musculacao"] as $key => $product) {
            if($key == $idBuscado) {
                $produtoEncontrado = $product;
                break; // Sai do loop quando encontrar
            }
        }
        
        // Se encontrou o produto, exibe apenas ele
        if($produtoEncontrado) {
            echo '
            <tr>
                <th scope="row">' . ($idBuscado + 1) . '</th>
                <td><img src="imagens/' . $produtoEncontrado["productImage"] . '" width="55"></td>
                <td>' . $produtoEncontrado["productName"] . '</td>
                <td>' . $produtoEncontrado["productDescription"] . '</td>
                <td>R$ ' . number_format($produtoEncontrado["productPrice"], 2, ',', '.') . '</td>
                <td>' . $produtoEncontrado["productQuantity"] . '</td>
                <td>
                    <a href="../academia/detalhe-produto.php?key=' . $idBuscado . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"<i class="fas fa-edit"></i> Editar</a>
                    <a href="../academia/remover.php?key=' . $idBuscado . '" class="btn btn-sm btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i> Excluir</a>
                </td>
            </tr>';
        } else {
            echo '<tr><td colspan="7" class="text-center">Produto não encontrado!</td></tr>';
        }
    } else {
        echo '<tr><td colspan="7" class="text-center">Nenhum produto cadastrado!</td></tr>';
    }
} else {
    // Se não foi passado ID, mostra todos os produtos (código original)
    if (!empty($_SESSION["produtos-musculacao"])) {
        foreach ($_SESSION["produtos-musculacao"] as $key => $product) {
            echo '
            <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td><img src="imagens/' . $product["productImage"] . '"width="55"></td>
                <td>' . $product["productName"] . '</td>
                <td>' . $product["productDescription"] . '</td>
                <td>R$ ' . number_format($product["productPrice"], 2, ',', '.') . '</td>
                <td>' . $product["productQuantity"] . '</td>
                <td>
                    <a href="../academia/detalhe-produto.php?key=' . $key . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i> Editar</a>
                    <a href="../academia/remover.php?key=' . $key . '" class="btn btn-sm btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i> Excluir</a>
                </td>
            </tr>';
        }
    } else {
        echo '<tr><td colspan="7" class="text-center">Nenhum produto cadastrado!</td></tr>';
    }
}
?>