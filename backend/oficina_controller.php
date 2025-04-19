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

// Lógica responsável pelo processo no cadastro de Veiculos.

}else if ($acao == 'inserir_veiculos') {   
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

  // Lógica responsável pelo processo no cadastro de novas ordens.
}else if ($acao == 'nova_ordem') {   
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

}else if ($acao =='listar' || $acao =='criada_ordem' || $acao =='ordem_editada' || $acao == 'ordem_excluida') {  
    $conexao = new Conexao;
    $salvarOrdemServico = new OrdensServico;
    $ordemServico = new OrdemServico($conexao, $salvarOrdemServico);
    $dados = $ordemServico->listarOdemServico();    
    $url = '../paginas/listar_ordens.php?dados='.urlencode(json_encode($dados));
    header ('Location:'.$url);    

  
}else if ($acao == 'editar_ordem') {  
    $editarOrdem = new OrdensServico();
    $editarOrdem->__set('cliente_id', $_POST['cliente_id']);
    $editarOrdem->__set('veiculo_id', $_POST['veiculo_id']);
    $editarOrdem->__set('data_abertura', $_POST['data_abertura']);
    $editarOrdem->__set('descricao_problema', $_POST['descricao_problema']);
    $editarOrdem->__set('servicos_realizados', $_POST['servicos_realizados']);
    $editarOrdem->__set('pecas_utilizadas', $_POST['pecas_utilizadas']);   
    $editarOrdem->__set('valor_total', $_POST['valor_total']);
    $editarOrdem->__set('status', $_POST['status']);

    $conexao = new Conexao();

    $editarOrdens = new OrdemServico($conexao, $editarOrdem);   
    $editarOrdens->editarOrdemServico();

    header('Location: oficina_controller.php?acao=ordem_editada');
}
else if ($acao == 'excluir_ordem') {  
    $editarOrdem = new OrdensServico();
    $editarOrdem->__set(':id', $_POST['id']); 
    $conexao = new Conexao();

    $editarOrdens = new OrdemServico($conexao, $editarOrdem);   
    $editarOrdens->excluirOrdemServico();

    header('Location: oficina_controller.php?acao=ordem_excluida');
}


?>