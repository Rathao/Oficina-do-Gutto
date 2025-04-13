<?php
require_once 'conexao.php';

try{    
    $stmt = $pdo->query("SELECT os.id, c.nome AS clientes,v.modelo AS veiculos, os.data_abertura, os.status, os.valor_total
     FROM ordens_servico os INNER JOIN clientes c ON os.cliente_id = c.id INNER JOIN veiculos v ON os.veiculo_id = v.id ");   
    $ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao listar ordens de serviço: " . $e->getMessage();
    $ordens = []; // Garante que $ordens seja um array mesmo em caso de erro
}

?>
