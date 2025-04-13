<?php
require_once 'conexao.php';

    $agendamento_id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   
print_r ($agendamento_id);

    if ($agendamento_id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = :id");
            $stmt->bindParam(':id', $agendamento_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt) {               
                // Redirecionar para a lista de agendamentos ou uma página de confirmação
                header("Location: ../paginas/listar_agendamento.php");
                exit();
            } else {
                echo "Nenhum agemdamento encontrado com o ID fornecido.";
            }

        } catch (PDOException $e) {
            echo "Erro ao excluir a agemdamentos de serviço: " . $e->getMessage();
        }
    } else {
        echo "ID da agemdamentos de serviço inválido.";
    }
 

?>