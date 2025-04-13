<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $cliente_id = filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT);
    $veiculo_id = filter_input(INPUT_POST, 'veiculo_id', FILTER_VALIDATE_INT);
    $data_abertura = filter_input(INPUT_POST, 'data_abertura');
    $descricao_problema = filter_input(INPUT_POST, 'descricao_problema', FILTER_SANITIZE_SPECIAL_CHARS);
    $servicos_realizados = filter_input(INPUT_POST, 'servicos_realizados', FILTER_SANITIZE_SPECIAL_CHARS);
    $pecas_utilizadas = filter_input(INPUT_POST, 'pecas_utilizadas', FILTER_SANITIZE_SPECIAL_CHARS);
    $valor_total = filter_input(INPUT_POST, 'valor_total', FILTER_VALIDATE_FLOAT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($id && $cliente_id && $veiculo_id && $data_abertura && isset($status)) {
        try {
            $stmt = $pdo->prepare("UPDATE ordens_servico SET cliente_id = :cliente_id, veiculo_id = :veiculo_id, data_abertura = :data_abertura, descricao_problema = :descricao_problema, servicos_realizados = :servicos_realizados, pecas_utilizadas = :pecas_utilizadas, valor_total = :valor_total, status = :status WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stmt->bindParam(':veiculo_id', $veiculo_id, PDO::PARAM_INT);
            $stmt->bindParam(':data_abertura', $data_abertura);
            $stmt->bindParam(':descricao_problema', $descricao_problema);
            $stmt->bindParam(':servicos_realizados', $servicos_realizados);
            $stmt->bindParam(':pecas_utilizadas', $pecas_utilizadas);
            $stmt->bindParam(':valor_total', $valor_total);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            echo "Ordem de serviço atualizada com sucesso!";
            // Redirecionar para a lista de ordens
            header("Location: ../paginas/listar_ordens.php");
            exit();

        } catch (PDOException $e) {
            echo "Erro ao atualizar a ordem de serviço: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos corretamente.";
    }
} else {
    echo "Acesso inválido.";
}
?>