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
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>    
    <link href="dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Controle da Oficina</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
 
  <div class="navbar-nav">
    
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>Dashboard</a>
          </li>
          <li class="nav-item">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordens de Serviço
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Nova Ordem de Serviço</a></li>
                    <li><a class="dropdown-item" href="#">Lista de Ordens Serviços</a></li>                    
                </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>Agendamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>Cadastro de Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>Cadastros de veiculos</a>
          </li>        
        </ul>
    </div>
    </nav>
 
    <div class="container mt-5">
        <h1 class="mb-4">Painel Principal da Oficina</h1>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agendamentos</h5>
                        <p class="card-text">Gerenciar os agendamentos de serviços.</p>
                        <a href="paginas/agendamento.php" class="btn btn-primary mb-1 ml-2">Novo Agendamento</a>
                        <a href="backend/oficina_controller.php?acao=listar_agenda" class="btn btn-info ml-2">Listar Agendamentos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ordens de Serviço</h5>
                        <p class="card-text">Gerenciar as ordens de serviço da oficina.</p>
                        <a href="paginas/nova_ordem.php" class="btn btn-success mb-1 ml-2">Nova Ordem</a>
                        <a href="backend/oficina_controller.php?acao=listar" class="btn btn-info ml-2">Listar Ordens</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <p class="card-text">Cadastre novos clientes e veículos.</p>
                        <a href="#" class="btn btn-primary mb-1 ml-2" data-toggle="modal" data-target="#modalCadastroCliente">Cadastrar Cliente</a>
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