<?php
require_once 'conexao.php';

    $id_agendamento = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id_agendamento) {
        try {
            $stmt = $pdo->prepare("UPDATE agendamentos SET status = 'Cancelado' WHERE id = :id");
            $stmt->bindParam(':id', $id_agendamento, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Agendamento cancelado com sucesso!";
                // Redirecionar para a lista de agendamentos ou uma página de confirmação
                header("Location: ../paginas/listar_agendamento.php");
                exit();
            } else {
                echo "Nenhum agendamento encontrado com o ID fornecido.";
            }

        } catch (PDOException $e) {
            echo "Erro ao cancelar o agendamento: " . $e->getMessage();
        }
    } else {
        echo "ID do agendamento inválido.";
    }

?>