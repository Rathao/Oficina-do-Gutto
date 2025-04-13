<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT);
    $veiculo_id = filter_input(INPUT_POST, 'veiculo_id', FILTER_VALIDATE_INT);
    $data_agendamento = filter_input(INPUT_POST, 'data_agendamento');
    $hora_agendamento = filter_input(INPUT_POST, 'hora_agendamento');
    $servico_solicitado = filter_input(INPUT_POST, 'servico_solicitado', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validação básica
    if ($cliente_id && $veiculo_id && $data_agendamento && $hora_agendamento) {
        try {
            $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente_id, veiculo_id, data_agendamento, hora_agendamento, servico_solicitado) VALUES (:cliente_id, :veiculo_id, :data_agendamento, :hora_agendamento, :servico_solicitado)");
            $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stmt->bindParam(':veiculo_id', $veiculo_id, PDO::PARAM_INT);
            $stmt->bindParam(':data_agendamento', $data_agendamento);
            $stmt->bindParam(':hora_agendamento', $hora_agendamento);
            $stmt->bindParam(':servico_solicitado', $servico_solicitado);
            $stmt->execute();

            echo "Agendamento realizado com sucesso!";           
            header("Location: ../paginas/listar_agendamento.php");
            exit();

        } catch (PDOException $e) {
            echo "Erro ao agendar: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos corretamente.";
    }
} else {
    echo "Acesso inválido.";
}
?>