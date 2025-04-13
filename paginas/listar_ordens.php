<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Ordens de Serviço</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Ordens de Serviço</h2>
        <?php
            // Incluir o arquivo PHP para buscar as ordens de serviço
            require_once '../backend/listar_ordens.php';
            

            if (!empty($ordens)) {
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Cliente </th>';
                echo '<th>Veículo </th>';
                echo '<th>Data Abertura</th>';
                echo '<th>Status</th>';
                echo '<th>Valor Total</th>';
                echo '<th>Ações</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';                
                foreach ($ordens as $ordem) {
                    echo '<tr>';
                    echo '<td>' . $ordem['id'] . '</td>';
                    echo '<td>' . $ordem['clientes'] . '</td>';                   
                    echo '<td>' . $ordem['veiculos'] . '</td>';
                    echo '<td>' . $ordem['data_abertura'] . '</td>';
                    echo '<td>' . $ordem['status'] . '</td>';
                    echo '<td>' . number_format($ordem['valor_total'], 2, ',', '.') . '</td>';
                    echo '<td>';
                    echo '<a href="editar_ordem.php?id=' . $ordem['id'] . '" class="btn btn-primary btn-sm mr-2">Editar</a>';
                    echo '<a href="../backend/cancelar_ordem.php?id=' . $ordem['id'] . '" class="btn btn-danger btn-sm">Cancelar</a>';
                    echo '<a href="../backend/exclusao_ordens.php?id=' . $ordem['id'] . '" class="btn btn-danger btn-sm">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Nenhuma ordem de serviço encontrada.</p>';
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