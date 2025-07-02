<?php
include "../verificar-autenticacao.php";

// Verifica se foi passado um parâmetro 'id' na URL
if(isset($_GET['providerName'])) {
    $idBuscado = $_GET['providerName']; // Pega o valor do parâmetro GET
    // Verifica se existe fornecedores na sessão
    if (!empty($_SESSION["fornecedores"])) {
        $fornecedorEncontrado = null;

        // Procura o fornecedor com ID correspondente
        foreach ($_SESSION["fornecedores"] as $key => $fornecedor) {
            if($key == $idBuscado) {
                $fornecedorEncontrado = $fornecedor;
                break; // Sai do loop quando encontrar
            }
        }

        // Se encontrou o fornecedor, exibe apenas ele
        if($fornecedorEncontrado) {
            echo '
            <tr>
                <th scope="row">' . ($idBuscado + 1) . '</th>
                <td>' . $fornecedorEncontrado["providerName"] . '</td>
                <td>' . $fornecedorEncontrado["providerCNPJ"] . '</td>
                <td>' . $fornecedorEncontrado["providerEmail"] . '</td>
                <td>' . $fornecedorEncontrado["providerWhatsapp"] . '</td>
                <td>' . ($fornecedorEncontrado["providerLogradouro"] ?? '') . '</td>
                <td>' . ($fornecedorEncontrado["providerNumero"] ?? '') . '</td>
                <td>' . ($fornecedorEncontrado["providerComplemento"] ?? '') . '</td>
                <td>' . ($fornecedorEncontrado["providerBairro"] ?? '') . '</td>
                <td>' . ($fornecedorEncontrado["providerCidade"] ?? '') . '</td>
                <td>' . ($fornecedorEncontrado["providerEstado"] ?? '') . '</td>
                <td>' . ($fornecedorEncontrado["providerCEP"] ?? '') . '</td>
                <td>
                    <a href="../fornecedores/detalhe-provider.php?key=' . $idBuscado . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i> Editar</a>
                    <a href="../fornecedores/remover.php?key=' . $idBuscado . '" class="btn btn-sm btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i> Excluir</a>
                </td>
            </tr>';
        } else {
            echo '<tr><td colspan="14" class="text-center">Provider não encontrado!</td></tr>';
        }
    } else {
        echo '<tr><td colspan="14" class="text-center">Nenhum provider cadastrado!</td></tr>';
    }
} else {
    // Se não foi passado ID, mostra todos os providers (código original)
    if (!empty($_SESSION["fornecedores"])) {
        foreach ($_SESSION["fornecedores"] as $key => $fornecedor) {
            echo '
            <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $fornecedor["providerName"] . '</td>
                <td>' . $fornecedor["providerCNPJ"] . '</td>
                <td>' . $fornecedor["providerEmail"] . '</td>
                <td>' . $fornecedor["providerWhatsapp"] . '</td>
                <td>' . ($fornecedor["providerLogradouro"] ?? '') . '</td>
                <td>' . ($fornecedor["providerNumero"] ?? '') . '</td>
                <td>' . ($fornecedor["providerComplemento"] ?? '') . '</td>
                <td>' . ($fornecedor["providerBairro"] ?? '') . '</td>
                <td>' . ($fornecedor["providerCidade"] ?? '') . '</td>
                <td>' . ($fornecedor["providerEstado"] ?? '') . '</td>
                <td>' . ($fornecedor["providerCEP"] ?? '') . '</td>
                <td>
                    <a href="../fornecedores/detalhe-provider.php?key=' . $key . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i> Editar</a>
                    <a href="../fornecedores/remover.php?key=' . $key . '" class="btn btn-sm btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i> Excluir</a>
                </td>
            </tr>';
        }
    } else {
        echo '<tr><td colspan="14" class="text-center">Nenhum provider cadastrado!</td></tr>';
    }
}
?>