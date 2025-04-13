<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id_veiculo = filter_input(INPUT_POST, 'cliente_id_veiculo', FILTER_SANITIZE_NUMBER_INT);
    $marca_veiculo = filter_input(INPUT_POST, 'marca_veiculo', FILTER_SANITIZE_STRING);
    $modelo_veiculo = filter_input(INPUT_POST, 'modelo_veiculo', FILTER_SANITIZE_STRING);
    $ano_veiculo = filter_input(INPUT_POST, 'ano_veiculo', FILTER_SANITIZE_NUMBER_INT);
    $placa_veiculo = filter_input(INPUT_POST, 'placa_veiculo', FILTER_SANITIZE_STRING);
    $cor_veiculo = filter_input(INPUT_POST, 'cor_veiculo', FILTER_SANITIZE_STRING);

    try {
        $stmt = $pdo->prepare("INSERT INTO veiculos (cliente_id, marca, modelo, ano, placa, cor)
        VALUES (:cliente_id, :marca, :modelo, :ano, :placa, :cor)");
        $stmt->bindParam(':cliente_id', $cliente_id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam(':marca', $marca_veiculo);
        $stmt->bindParam(':modelo', $modelo_veiculo);
        $stmt->bindParam(':ano', $ano_veiculo);
        $stmt->bindParam(':placa', $placa_veiculo);
        $stmt->bindParam(':cor', $cor_veiculo);
        $stmt->execute();


        echo "Veículo cadastrado com sucesso!";
        header("Location: ../index.php");
    } catch (PDOException $e) {
        echo "Erro ao cadastrar veículo: " . $e->getMessage();
        
    }
}