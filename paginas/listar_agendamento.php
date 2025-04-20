<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <script src="https://kit.fontawesome.com/e5e06525b0.js" crossorigin="anonymous"></script>
    <script>
      function remover(id){
        location.href="../backend/oficina_controller.php?acao=excluir_agenda&id="+id;
      }
      function atualizar(id) {
        location.href="../backend/oficina_controller.php?acao=atualizar_agenda&id="+id;
      }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Agendamentos</h2>
        <?php
            // Incluir o arquivo PHP para buscar os dados
            $dados = json_decode($_GET['dados'],true);  
        

            if (!empty($dados)) {
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Cliente ID</th>';
                echo '<th>Veículo ID</th>';
                echo '<th>Data</th>';
                echo '<th>Hora</th>';
                echo '<th>Serviço Solicitado</th>';
                echo '<th>Status</th>';
                echo '<th>Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($dados as $dado) {
                    echo '<tr>';
                    echo '<td>' . $dado['id'] . '</td>';
                    echo '<td>' . $dado['cliente_nome'] . '</td>';
                    echo '<td>' . $dado['veiculo_modelo'] . '</td>';
                    echo '<td>' . $dado['data_agendamento'] . '</td>';
                    echo '<td>' . $dado['hora_agendamento'] . '</td>';
                    echo '<td>' . htmlspecialchars($dado['servico_solicitado']) . '</td>';
                    echo '<td>' . $dado['status'] . '</td>';
                    echo '<td>';
                    echo '<i class="fa-regular fa-pen-to-square fa-lg text-info mr-1" onclick="atualizar('.$dado['id'].')"></i>';
                    echo ' <i class="fa-solid fa-trash fa-lg text-danger " onclick="remover('. $dado['id'].' )"></i>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Nenhum dado encontrado.</p>';
            }
        ?>
        <div class="mt-3">
            <a href="../index.php" class="btn btn-secondary">Voltar ao Painel</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>
</html>