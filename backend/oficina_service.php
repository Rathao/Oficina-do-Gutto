<?php

	class CadastroService {

		private $conexao;
		private $cliente;

		public function __construct(Conexao $conexao, Clientes $cliente) {
			$this->conexao = $conexao->conectar();
			$this->cliente = $cliente;		
		}
		public function cadastrarCliente() {
			$query ='INSERT INTO  clientes (nome, cpf_cnpj, telefone, email, endereco) VALUES (:nome, :cpf_cnpj, :telefone, :email, :endereco)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':nome', $this->cliente->__get('nome'));
			$stmt->bindValue(':cpf_cnpj', $this->cliente->__get('cpf_cnpj'));
			$stmt->bindValue(':telefone', $this->cliente->__get('telefone'));
            $stmt->bindValue(':email', $this->cliente->__get('email'));
            $stmt->bindValue(':endereco', $this->cliente->__get('endereco'));
			$stmt->execute();					
		}
		public function recuperarCliente() {
			$query = 'SELECT * from clientes WHERE id = id';
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		
	}

class CadastroSerVeiculo  {
	private $conexao;
	private $veiculo ;
	public function __construct (Conexao $conexao, Veiculos $veiculo) {
		$this->conexao = $conexao->conectar();
		$this->veiculo = $veiculo;
	}
	public function cadastrarVeiculo (){
		$query = "INSERT INTO veiculos (cliente_id, marca, modelo, ano, placa, cor) VALUES (:cliente_id, :marca, :modelo, :ano, :placa, :cor)";
		$stmt = $this->conexao->prepare($query);		
        $stmt->bindParam(':cliente_id', $this->veiculo->__get('cliente_id'));
        $stmt->bindParam(':marca', $this->veiculo->__get('marca'));
        $stmt->bindParam(':modelo', $this->veiculo->__get('modelo'));
        $stmt->bindParam(':ano', $this->veiculo->__get('ano'));
        $stmt->bindParam(':placa', $this->veiculo->__get('placa'));
        $stmt->bindParam(':cor', $this->veiculo->__get('cor'));
        $stmt->execute();

	}
}


?>