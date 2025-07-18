<?php
try {

    // Verifica se há um ID na URL para consulta específica
    if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM fornecedores
            WHERE id_fornecedor = :id
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :id com o valor da variável $id
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    // Verifica se há um RAZÃO SOCIAL na URL para consulta
    elseif (isset($_GET["razao_social"]) && is_string($_GET["razao_social"])) {
        $razao_social = $_GET["razao_social"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM fornecedores
            WHERE razao_social LIKE :razao_social
            ORDER BY razao_social
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :razao_social com o valor da variável $razao_social
        $stmt->bindValue(':razao_social', '%' . $razao_social . '%', PDO::PARAM_STR);

    }
    // Verifica se há uma Cidade na URL para consulta
    elseif (isset($_GET["cidade"]) && is_string($_GET["cidade"])) {
        $cidade = $_GET["cidade"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM fornecedores
            WHERE cidade LIKE :cidade
            ORDER BY razao_social
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :cidade com o valor da variável $cidade
        $stmt->bindValue(':cidade', '%' . $cidade . '%', PDO::PARAM_STR);

    }
    else {
        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM fornecedores
            ORDER BY razao_social
        ";
        
        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
    }

    
    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Verifica se o resultado da pesquisa é vazio
    if (empty($data)) {
        // Se o resultado for vazio, retorna um erro
        http_response_code(204);
        exit;
    } else {
        // Organizar o endereço como objeto
        foreach ($data as $key => $cliente) {
            $data[$key]->endereco = array(
                'logradouro' => $cliente->logradouro,
                'numero' => $cliente->numero,
                'complemento' => $cliente->complemento,
                'bairro' => $cliente->bairro,
                'cidade' => $cliente->cidade,
                'estado' => $cliente->estado,
                'cep' => $cliente->cep
            );
            // Remove os campos que não são mais necessários
            unset($data[$key]->logradouro);
            unset($data[$key]->numero);
            unset($data[$key]->complemento);
            unset($data[$key]->bairro);
            unset($data[$key]->cidade);
            unset($data[$key]->estado);
            unset($data[$key]->cep);
        }
        // Se o resultado não for vazio, retorna os dados
        $result = array(
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        );
    }
} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}