<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Agendamentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Agendamentos</h2>
        <?php
            // Incluir o arquivo PHP para buscar os agendamentos
            require_once '../backend/listar_agendamento.php';

            if (!empty($agendamentos)) {
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
                foreach ($agendamentos as $agendamento) {
                    echo '<tr>';
                    echo '<td>' . $agendamento['id'] . '</td>';
                    echo '<td>' . $agendamento['clientes'] . '</td>';
                    echo '<td>' . $agendamento['veiculos'] . '</td>';
                    echo '<td>' . $agendamento['data_agendamento'] . '</td>';
                    echo '<td>' . $agendamento['hora_agendamento'] . '</td>';
                    echo '<td>' . htmlspecialchars($agendamento['servico_solicitado']) . '</td>';
                    echo '<td>' . $agendamento['status'] . '</td>';
                    echo '<td>';
                    echo '<a href=" ../backend/processar_cancelamento_agendamento.php?id=' . $agendamento['id'] . '" class="btn btn-danger btn-sm">Cancelar</a>';
                    echo '<a href=" ../backend/excluir_agendamento.php?id=' . $agendamento['id'] . '" class="btn btn-danger btn-sm">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Nenhum agendamento encontrado.</p>';
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