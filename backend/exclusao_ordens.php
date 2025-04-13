<?php
require_once 'conexao.php';

    $ordens_id= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   
print_r ($ordens_id);

    if ($ordens_id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM ordens_servico WHERE id = :id");
            $stmt->bindParam(':id', $ordens_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt) {               
                // Redirecionar para a lista de agendamentos ou uma página de confirmação
                header("Location: ../paginas/listar_ordens.php");
                exit();
            } else {
                echo "Nenhum ordem encontrado com o ID fornecido.";
            }

        } catch (PDOException $e) {
            echo "Erro ao excluir a ordem de serviço: " . $e->getMessage();
        }
    } else {
        echo "ID da ordem de serviço inválido.";
    }
 

?>