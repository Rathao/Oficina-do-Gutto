<?php
require_once 'conexao.php';

$id_ordem = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id_ordem) {
    try {
        $stmt = $pdo->prepare("UPDATE ordens_servico SET status = 'Cancelado' WHERE id = :id");
        $stmt->bindParam(':id', $id_ordem, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Ordem de serviço cancelada com sucesso!";
            // Redirecionar para a lista de ordens
            header("Location: ../paginas/listar_ordens.php");
            exit();
        } else {
            echo "Nenhuma ordem de serviço encontrada com o ID fornecido.";
        }

    } catch (PDOException $e) {
        echo "Erro ao cancelar a ordem de serviço: " . $e->getMessage();
    }
} else {
    echo "ID da ordem de serviço inválido.";
}
?>