<?php
// Lógica responsável pelo processo no cadastro de cliente.
require 'conexao.php';
require 'oficina_model.php';
require 'oficina_service.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : ''; 


if($acao == 'inserir_cliente') {
    $cliente = new Clientes();
    $cliente->__set('nome', $_POST['nome']);
    $cliente->__set('cpf_cnpj', $_POST['cpf_cnpj']);
    $cliente->__set('telefone', $_POST['telefone']);
    $cliente->__set('email', $_POST['email']);
    $cliente->__set('endereco', $_POST['endereco']);

    $conexao = new Conexao();

    $cadastroService = new CadastroService($conexao, $cliente);  
    $cadastroService->cadastrarCliente();

    echo "cliente cadastrado com sucesso!";
    header('Location: ../index.php');
// } else if ($acao == 'listar') {
//     // Lógica para listar clientes
//     $pdo = new Conexao();
//     $cadastroService = new CadastroService($pdo, new Clientes()); // Passa uma nova instância de Clientes
//     $clientes = $cadastroService->listarClientes();

//     echo "<h2>Lista de Clientes</h2>";
//     if (!empty($clientes)) {
//         echo "<ul>";
//         foreach ($clientes as $cliente) {
//             echo "<li>ID: " . htmlspecialchars($cliente->id) . "<br>";
//             // Supondo que a classe Clientes tenha atributos como nome, email, etc.
//             foreach ($cliente->cliente as $chave => $valor) {
//                 echo htmlspecialchars($chave) . ": " . htmlspecialchars($valor) . "<br>";
//             }
//             echo "<a href='?acao=editar&id=" . htmlspecialchars($cliente->id) . "'>Editar</a> | ";
//             echo "<a href='?acao=remover&id=" . htmlspecialchars($cliente->id) . "'>Remover</a></li><br>";
//         }
//         echo "</ul>";
//     } else {
//         echo "Nenhum cliente cadastrado.";
//     }

// } else if ($acao == 'editar' && isset($_GET['id'])) {
//     // Lógica para exibir o formulário de edição de um cliente
//     $id_cliente = $_GET['id'];
//     $pdo = new Conexao();
//     $cadastroService = new CadastroService($pdo, new Clientes());
//     $cliente = $cadastroService->recuperarCliente($id_cliente);

//     if ($cliente) {
//         echo "<h2>Editar Cliente</h2>";
//         echo "<form method='post' action='?acao=atualizar&id=" . htmlspecialchars($cliente->id) . "'>";
//         // Supondo que a estrutura de $cliente->cliente seja um array associativo
//         if (is_array($cliente->cliente)) {
//             foreach ($cliente->cliente as $chave => $valor) {
//                 echo "<label for='" . htmlspecialchars($chave) . "'>" . htmlspecialchars(ucfirst($chave)) . ":</label><br>";
//                 echo "<input type='text' id='" . htmlspecialchars($chave) . "' name='" . htmlspecialchars($chave) . "' value='" . htmlspecialchars($valor) . "'><br><br>";
//             }
//         }
//         echo "<input type='submit' value='Atualizar Cliente'>";
//         echo "</form>";
//     } else {
//         echo "Cliente não encontrado.";
//     }

// } else if ($acao == 'atualizar' && isset($_GET['id'])) {
//     // Lógica para atualizar os dados de um cliente
//     $id_cliente = $_GET['id'];
//     $cliente = new Clientes();
//     $cliente->id = $id_cliente;
//     $cliente->cliente = $_POST; // Associa os dados do formulário para atualização

//     $pdo = new Conexao();
//     $cadastroService = new CadastroService($pdo, $cliente);
//     if ($cadastroService->atualizarCliente()) {
//         echo "Cliente atualizado com sucesso!";
//         echo "<p><a href='?acao=listar'>Voltar para a lista de clientes</a></p>";
//     } else {
//         echo "Erro ao atualizar o cliente.";
//         echo "<p><a href='?acao=listar'>Voltar para a lista de clientes</a></p>";
//     }

// } else if ($acao == 'remover' && isset($_GET['id'])) {
//     // Lógica para remover um cliente
//     $id_cliente = $_GET['id'];
//     $cliente = new Clientes();
//     $cliente->id = $id_cliente;

//     $pdo = new Conexao();
//     $cadastroService = new CadastroService($pdo, $cliente);
//     if ($cadastroService->removerCliente()) {
//         echo "Cliente removido com sucesso!";
//         echo "<p><a href='?acao=listar'>Voltar para a lista de clientes</a></p>";
//     } else {
//         echo "Erro ao remover o cliente.";
//         echo "<p><a href='?acao=listar'>Voltar para a lista de clientes</a></p>";
//     }

}

// Lógica responsável pelo processo no cadastro de veiculos.
 
if($acao == 'inserir_veiculos') {   
    $veiculo = new Veiculos();
    $veiculo->__set('cliente_id', $_POST['cliente_id']);
    $veiculo->__set('marca', $_POST['marca']);
    $veiculo->__set('modelo', $_POST['modelo']);
    $veiculo->__set('ano', $_POST['ano']);
    $veiculo->__set('placa', $_POST['placa']);   
    $veiculo->__set('cor', $_POST['cor']);

    $conexao = new Conexao();

    $CadastroSerVeiculo = new CadastroSerVeiculo($conexao, $veiculo);  
    $CadastroSerVeiculo->cadastrarVeiculo();

  echo "Veiculo cadastrado com sucesso!";
  header('Location: ../index.php');
}
// Lógica responsável pelo processo no cadastro de novas ordens.
if ($acao == 'nova_ordem') {   
    $novaordem = new OrdensServico();
    $novaordem->__set('cliente_id', $_POST['cliente_id']);
    $novaordem->__set('veiculo_id', $_POST['veiculo_id']);
    $novaordem->__set('data_abertura', $_POST['data_abertura']);
    $novaordem->__set('descricao_problema', $_POST['descricao_problema']);
    $novaordem->__set('servicos_realizados', $_POST['servicos_realizados']);
    $novaordem->__set('pecas_utilizadas', $_POST['pecas_utilizadas']);   
    $novaordem->__set('valor_total', $_POST['valor_total']);
    $novaordem->__set('status', $_POST['status']);

    $conexao = new Conexao();

    $novasordens = new OrdemServico($conexao, $novaordem);
    $novasordens->salvarOrdemServico();

    echo 'Sua ordem de serviço foi cadastrada.';
    header('Location: ../paginas/listar_ordens.php?acao=criada_ordem');
}else if ($acao == 'listar') {  
    $conexao = new Conexao;
    $salvarOrdemServico = new OrdensServico;
    $ordemServico = new OrdemServico($conexao, $salvarOrdemServico);
    $dados = $ordemServico->listarOdemServico();
    $url = '../paginas/listar_ordens.php?dados='.urlencode(json_encode($dados));
    header ('Location:'.$url);
    exit;

//     
}else if ($acao == 'editar_ordem') {
    
}

?>