<?php
require_once '../backend/conexao.php';

try {
    $stmt_clientes = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome");
    $clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);

    $stmt_veiculos = $pdo->query("SELECT id, marca, modelo, placa FROM veiculos ORDER BY marca, modelo");
    $veiculos = $stmt_veiculos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro ao buscar dados: " . $e->getMessage();
    $clientes = [];
    $veiculos = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Ordem de Serviço</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Nova Ordem de Serviço</h2>
        <form action="../backend/processar_nova_ordem.php" method="POST">

           <div class="form-group">
                <label for="cliente_id">Cliente:</label>
                <select class="form-control" id="cliente_id" name="cliente_id" required>
                    <option value="">Selecione o Cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo htmlspecialchars($cliente['nome']) . ' (ID: ' . $cliente['id'] . ')'; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="veiculo_id">Veículo:</label>
                <select class="form-control" id="veiculo_id" name="veiculo_id" required>
                    <option value="">Selecione o Veículo</option>
                    <?php foreach ($veiculos as $veiculo): ?>
                        <option value="<?php echo $veiculo['id']; ?>"><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo'] . ' - Placa: ' . $veiculo['placa'] . ' (ID: ' . $veiculo['id'] . ')'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data_abertura">Data de Abertura:</label>
                <input type="date" class="form-control" id="data_abertura" name="data_abertura" required>
            </div>
            <div class="form-group">
                <label for="descricao_problema">Descrição do Problema:</label>
                <textarea class="form-control" id="descricao_problema" name="descricao_problema" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="servicos_realizados">Serviços a Serem Realizados:</label>
                <textarea class="form-control" id="servicos_realizados" name="servicos_realizados" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="pecas_utilizadas">Peças Utilizadas:</label>
                <textarea class="form-control" id="pecas_utilizadas" name="pecas_utilizadas" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="valor_total">Valor Total:</label>
                <input type="number" step="0.01" class="form-control" id="valor_total" name="valor_total">
            </div>
            <div class="form-group">
                <label for="status">Status da Ordem:</label>
                <select class="form-control" id="status" name="status">
                    <option value="Em Aberto">Em Aberto</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Aguardando Peças">Aguardando Peças</option>
                    <option value="Concluído">Concluído</option>
                    <option value="Entregue">Entregue</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Criar Ordem de Serviço</button>
            <button type="submit" class="btn btn-secondary"><a class="botao" href="../index.php">Cancelar</a></button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>
</html>