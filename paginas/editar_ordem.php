<?php
            // Incluir o arquivo PHP para buscar os dados da ordem de serviço para edição
            require '../backend/conexao.php';
            require '../backend/oficina_model.php';
            require '../backend/oficina_service.php';
            $conexao = new Conexao;
            $salvarOrdemServico = new OrdensServico;
            $ordemServico = new OrdemServico($conexao, $salvarOrdemServico);
            $dados = $ordemServico->listarOdemServico();

            $status = new Status;
            $novostatus = new StatusService($conexao, $status);
            $selecionar = $novostatus->recuperarStatus();
            
            foreach ($dados as $ordem)
            {
                if($ordem->id == $_GET['id'])           
                        
             {
               
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ordem de Serviço</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Ordem de Serviço</h2>
      
                <form action="../backend/oficina_controller.php?acao=editar_ordem" method="POST">
                    <input type="hidden" name="id" value="<?php echo $ordem->id; ?>">
                    <div class="form-group">
                        <label for="cliente_id">ID do Cliente:</label>
                        <input type="number" class="form-control" id="cliente_id" name="cliente_id" value="<?php echo $ordem->cliente_id ; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="veiculo_id">ID do Veículo:</label>
                        <input type="number" class="form-control" id="veiculo_id" name="veiculo_id" value="<?php echo $ordem->veiculo_id ; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="data_abertura">Data de Abertura:</label>
                        <input type="date" class="form-control" id="data_abertura" name="data_abertura" value="<?php echo $ordem->data_abertura ; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao_problema">Descrição do Problema:</label>
                        <textarea class="form-control" id="descricao_problema" name="descricao_problema" rows="4"><?php echo htmlspecialchars($ordem->descricao_problema ); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="servicos_realizados">Serviços a Serem Realizados:</label>
                        <textarea class="form-control" id="servicos_realizados" name="servicos_realizados" rows="4"><?php echo htmlspecialchars($ordem->servicos_realizados); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pecas_utilizadas">Peças Utilizadas:</label>
                        <textarea class="form-control" id="pecas_utilizadas" name="pecas_utilizadas" rows="3"><?php echo htmlspecialchars($ordem->pecas_utilizadas); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="valor_total">Valor Total:</label>
                        <input type="number" step="0.01" class="form-control" id="valor_total" name="valor_total" value="<?php echo $ordem->valor_total ; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status da Ordem:</label>
                         <select class="form-control" id="status" name="status" required>
                            <option value="">Selecione o Status</option>
                            <?php foreach ($selecionar as $key): ?>
                                <option value="<?php echo $key->status; ?>"><?php echo htmlspecialchars($key->status); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
                <?php break;  }?>
                <?php } ?>
        <div class="mt-3">
            <a href="../backend/oficina_controller.php?acao=listar" class="btn btn-secondary">Voltar para Lista de Ordens</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>