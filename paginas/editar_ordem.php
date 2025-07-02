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

foreach ($dados as $ordem) {
    if ($ordem->id == $_GET['id']) {

        ?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Painel Principal</title>

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
            <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

            <link rel="stylesheet" href="../src/estilo.css">
        </head>

        <body>
            <nav class="sidebar">
                <header>
                    <div class="image-text">
                        <span class="image">
                            <img src="../imagens/logo.png" alt="logo">
                        </span>
                        <div class="text header-text">
                            <span class="name">Oficina Mecânica</span>
                            <span class="profession">Soluções & Serviços</span>
                        </div>
                    </div>

                    <i class="bxr bx-chevron-left toogle"></i>
                </header>
                <div class="menu-bar">

                    <div class="menu">
                        <li class="search-box">
                            <i class='bxr  bx-search icon'></i>
                            <input type="text" placeholder="Search...">
                        </li>
                        <ul class="menu-links">
                            <li class="nav-links">
                                <a href="../index.php">
                                    <i class="bx  bx-home-alt icon"></i>
                                    <span class="text nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="../paginas/nova_ordem.php">
                                    <i class='bxr  bx-bar-chart-square icon'></i>
                                    <span class="text nav-text">Nova Ordem</span>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="../backend/oficina_controller.php?acao=listar">
                                    <i class="bxr  bx-clipboard-check icon"></i>
                                    <span class="text nav-text">Ordens de Serviços</span>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="../paginas/agendamento.php">
                                    <i class="bxr bx-calendar-alt icon"></i>
                                    <span class="text nav-text">Agendamentos</span>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="../backend/oficina_controller.php?acao=listar_agenda">
                                    <i class="bxr  bx-calendar-detail icon"></i>
                                    <span class="text nav-text">Agenda</span>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="#" data-toggle="modal" data-target="#modalCadastroCliente">
                                    <i class="bxr  bx-user icon"></i>
                                    <span class="text nav-text">Clientes</span>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="#" data-toggle="modal" data-target="#modalCadastroVeiculo">
                                    <i class="bxr  bx-car icon"></i>
                                    <span class="text nav-text">Veículos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="bottom-content">
                        <li class="">
                            <a href="#">
                                <i class="bxr  bx-arrow-in-left-square-half icon"></i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>
                        <li class="mode">
                            <div class="moon-sun">
                                <i class="bxr  bx-moon icon moon"></i>
                                <i class="bxr  bx-sun icon sun"></i>
                            </div>
                            <span class="mode-text text">Dark Mode</span>
                            <div class="toogle-switch">
                                <span class="switch"></span>
                            </div>
                        </li>
                    </div>
                </div>
            </nav>

            <section class="home">
                <div class="text">

                    <div class="container mt-5">
                        <h2>Editar Ordem de Serviço</h2>

                        <form action="../backend/oficina_controller.php?acao=editar_ordem" method="POST">
                            <input type="hidden" name="id" value="<?php echo $ordem->id;  ?>">
                            <div class="form-group">
                                <label for="cliente_id">Cliente:</label>
                                <input type="text" class="form-control" id="cliente_id" name="cliente_id"
                                    value="<?php echo $ordem->cliente_nome; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="veiculo_id">Veículo:</label>
                                <input type="text" class="form-control" id="veiculo_id" name="veiculo_id"
                                    value="<?php echo $ordem->veiculo_modelo; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="data_abertura">Data de Abertura:</label>
                                <input type="date" class="form-control" id="data_abertura" name="data_abertura"
                                    value="<?php echo $ordem->data_abertura; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao_problema">Descrição do Problema:</label>
                                <textarea class="form-control" id="descricao_problema" name="descricao_problema"
                                    rows="4"><?php echo htmlspecialchars($ordem->descricao_problema); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="servicos_realizados">Serviços a Serem Realizados:</label>
                                <textarea class="form-control" id="servicos_realizados" name="servicos_realizados"
                                    rows="4"><?php echo htmlspecialchars($ordem->servicos_realizados); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pecas_utilizadas">Peças Utilizadas:</label>
                                <textarea class="form-control" id="pecas_utilizadas" name="pecas_utilizadas"
                                    rows="3"><?php echo htmlspecialchars($ordem->pecas_utilizadas); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="valor_total">Valor Total:</label>
                                <input type="number" step="0.01" class="form-control" id="valor_total" name="valor_total"
                                    value="<?php echo $ordem->valor_total; ?>">
                            </div>
                            <div class="form-group">
                                <label for="status">Status da Ordem:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Selecione o Status</option>
                                    <?php foreach ($selecionar as $key): ?>
                                        <option value="<?php echo $key->status; ?>"><?php echo htmlspecialchars($key->status); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>
                        <?php break;
    } ?>
                <?php } ?>
                <div class="mt-3">
                    <a href="../backend/oficina_controller.php?acao=listar" class="btn btn-secondary">Voltar para Lista
                        de Ordens</a>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="modalCadastroCliente" tabindex="-1" role="dialog"
        aria-labelledby="modalCadastroClienteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroClienteLabel">Cadastrar Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCadastroCliente" method="POST"
                        action="backend/oficina_controller.php?acao=inserir_cliente">
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

    <div class="modal fade" id="modalCadastroVeiculo" tabindex="-1" role="dialog"
        aria-labelledby="modalCadastroVeiculoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroVeiculoLabel">Cadastrar Veículos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCadastroVeiculo" method="post"
                        action="backend/oficina_controller.php?acao=inserir_veiculos">
                        <div class="form-group">
                            <label for="cliente_id">Cliente:</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                <option value="">Selecione o Cliente</option>
                                <?php foreach ($clientes as $key => $cliente): ?>
                                    <option value="<?php echo $cliente->id; ?>">
                                        <?php echo htmlspecialchars($cliente->nome); ?>
                                    </option>
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
    <script src="../src/script.js"></script>
</body>

</html>