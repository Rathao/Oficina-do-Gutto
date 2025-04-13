<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_cliente = filter_input(INPUT_POST, 'nome_cliente' );
    $cpf_cnpj_cliente = filter_input(INPUT_POST, 'cpf_cnpj_cliente' );
    $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente' );
    $email_cliente = filter_input(INPUT_POST, 'email_cliente' );
    $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente');

    try {
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf_cnpj, telefone, email, endereco)
        VALUES (:nome, :cpf_cnpj, :telefone, :email, :endereco)");
        $stmt->bindParam(':nome', $nome_cliente);
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj_cliente);
        $stmt->bindParam(':telefone', $telefone_cliente);
        $stmt->bindParam(':email', $email_cliente);
        $stmt->bindParam(':endereco', $endereco_cliente);
        $stmt->execute();

        echo "Cliente cadastrado com sucesso!";
        header('Location: ../index.php');
    } catch (PDOException $e) {
        echo "Erro ao cadastrar cliente: " . $e->getMessage();
    }
}