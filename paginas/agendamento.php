<?php
require '../backend/conexao.php';
require '../backend/oficina_model.php';
require '../backend/oficina_service.php';

$conexao = new Conexao;

$cliente = new Clientes;
$clienteservice = new CadastroService($conexao, $cliente);  
$clientes = $clienteservice->recuperarCliente() ;

$veiculo = new Veiculos;
$veiculoService = new CadastroSerVeiculo($conexao, $veiculo);
$veiculos = $veiculoService->recuperarVeiculo();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Serviço</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Agendar Serviço</h2>
        <form action="../backend/oficina_controller.php?acao=novo_agendamento" method="POST">
            <div class="form-group">
                <label for="cliente_id">Cliente:</label>
                <select class="form-control" id="cliente_id" name="cliente_id" required>
                    <option value="">Selecione o Cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente->id; ?>"><?php echo htmlspecialchars($cliente->nome ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="veiculo_id">Veículo:</label>
                <select class="form-control" id="veiculo_id" name="veiculo_id" required>
                    <option value="">Selecione o Veículo</option>
                    <?php foreach ($veiculos as $veiculo): ?>
                        <option value="<?php echo $veiculo->id; ?>"><?php echo htmlspecialchars($veiculo->modelo ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data_agendamento">Data do Agendamento:</label>
                <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" required>
            </div>
            <div class="form-group">
                <label for="hora_agendamento">Hora do Agendamento:</label>
                <input type="time" class="form-control" id="hora_agendamento" name="hora_agendamento" required>
            </div>
            <div class="form-group">
                <label for="servico_solicitado">Serviço Solicitado:</label>
                <textarea class="form-control" id="servico_solicitado" name="servico_solicitado" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>
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