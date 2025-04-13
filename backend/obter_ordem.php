<?php
require_once 'conexao.php';

$id_ordem = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id_ordem) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM ordens_servico WHERE id = :id");
        $stmt->bindParam(':id', $id_ordem, PDO::PARAM_INT);
        $stmt->execute();
        $ordem = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar dados da ordem de serviço: " . $e->getMessage();
        $ordem = null;
    }
} else {
    echo "ID da ordem de serviço inválido.";
    $ordem = null;
}
?>