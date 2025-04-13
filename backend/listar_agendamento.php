<?php
require_once 'conexao.php';
try{    
    $stmt = $pdo->query("SELECT os.id, c.nome AS clientes,v.modelo AS veiculos,
     os.data_agendamento, os.hora_agendamento, os.servico_solicitado, os.status
     FROM agendamentos os 
     INNER JOIN clientes c ON os.cliente_id = c.id 
     INNER JOIN veiculos v ON os.veiculo_id = v.id ");   
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao listar ordens de serviço: " . $e->getMessage();
    $agendamentos = []; // Garante que $agendamentos seja um array mesmo em caso de erro
}


?>