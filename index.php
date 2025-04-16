<?php
require 'backend/conexao.php';
require 'backend/oficina_model.php';
require 'backend/oficina_service.php';

$conexao = new Conexao;
$cliente = new Clientes;

$clienteservice = new CadastroService($conexao, $cliente);  
$clientes = $clienteservice->recuperarCliente() ;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Painel Principal da Oficina</h1>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agendamentos</h5>
                        <p class="card-text">Gerenciar os agendamentos de serviços.</p>
                        <a href="paginas/agendamento.php" class="btn btn-primary">Novo Agendamento</a>
                        <a href="paginas/listar_agendamento.php" class="btn btn-info ml-2">Listar Agendamentos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ordens de Serviço</h5>
                        <p class="card-text">Gerenciar as ordens de serviço da oficina.</p>
                        <a href="paginas/nova_ordem.php" class="btn btn-success">Nova Ordem</a>
                        <a href="backend/oficina_controller.php?acao=listar" class="btn btn-info ml-2">Listar Ordens</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <p class="card-text">Cadastre novos clientes e veículos.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastroCliente">Cadastrar Cliente</a>
                        <a href="#" class="btn btn-info ml-2" data-toggle="modal" data-target="#modalCadastroVeiculo">Cadastrar Veículo</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCadastroCliente" tabindex="-1" role="dialog" aria-labelledby="modalCadastroClienteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCadastroClienteLabel">Cadastrar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formCadastroCliente" method="POST"   action="backend/oficina_controller.php?acao=inserir_cliente">
                            <div class="form-group">
                                <label for="nome_cliente">Nome:</label>
                                <input type="text" class="form-control" id="nome_cliente" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="cpf_cnpj">CPF/CNPJ:</label>
                                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required>
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" name="telefone">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="btnCadastrarCliente">Cadastrar</button>
                            </div>
                        </form>
                    </div>                                     
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCadastroVeiculo" tabindex="-1" role="dialog" aria-labelledby="modalCadastroVeiculoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCadastroVeiculoLabel">Cadastrar Veículo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formCadastroVeiculo" method="post" action="backend/oficina_controller.php?acao=inserir_veiculos" >
                        <div class="form-group">
                                <label for="cliente_id">Cliente:</label>
                                <select class="form-control" id="cliente_id" name="cliente_id" required>
                                    <option value="">Selecione o Cliente</option>
                                    <?php foreach ($clientes as $key => $cliente): ?>
                                        <option value="<?php echo $cliente->id; ?>"><?php echo htmlspecialchars($cliente->nome); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="marca">Marca:</label>
                                <input type="text" class="form-control" id="marca" name="marca" required>
                            </div>
                            <div class="form-group">
                                <label for="modelo">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" required>
                            </div>
                            <div class="form-group">
                                <label for="ano">Ano:</label>
                                <input type="number" class="form-control" id="ano" name="ano" required>
                            </div>
                            <div class="form-group">
                                <label for="placa">Placa:</label>
                                <input type="text" class="form-control" id="placa" name="placa" required>
                            </div>
                            <div class="form-group">
                                <label for="cor">Cor:</label>
                                <input type="text" class="form-control" id="cor" name="cor">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="btnCadastrarVeiculo">Cadastrar</button>
                            </div>
                        </form>
                    </div>                                 
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="src/js/script.js"></script>
    </body>
</html>