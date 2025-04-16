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
			$query = 'SELECT id, nome from clientes' ;
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
	
			$stmt->bindValue(':cliente_id', $this->veiculo->__get('cliente_id'));
			$stmt->bindValue(':marca', $this->veiculo->__get('marca'));
			$stmt->bindValue(':modelo', $this->veiculo->__get('modelo'));
			$stmt->bindValue(':ano', $this->veiculo->__get('ano'));
			$stmt->bindValue(':placa', $this->veiculo->__get('placa'));
			$stmt->bindValue(':cor', $this->veiculo->__get('cor'));
			$stmt->execute();
		}
		public function recuperarVeiculo() {
			$query = 'SELECT id, nome from veiculos' ;
			$stmt = $this->conexao->prepare($query);			
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

	}

class StatusService {
	private $conexao;
	private $status;
	public function __construct( Conexao $conexao, Status $status){
		$this->conexao = $conexao->conectar();
		$this->status = $status;
	}
	public function recuperarStatus(){
		$query = 'SELECT id, status FROM status';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

class OrdemServico {
	private $conexao;
	private $salvarOrdemServico;
	public function __construct(Conexao $conexao, OrdensServico $salvarOrdemServico) {
		$this->conexao = $conexao->conectar();
		$this->salvarOrdemServico = $salvarOrdemServico;
	}
	public function getDados() {
		$query = "SELECT c.id as cliente_id, c.nome, v.modelo, v.id AS veiculo_id FROM clientes c
		INNER JOIN veiculos v ON c.id = v.cliente_id";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
		
	}
	public function salvarOrdemServico(){
		$query =
		'INSERT INTO ordens_servico (cliente_id, veiculo_id, descricao_problema, servicos_realizados, pecas_utilizadas, valor_total, status )
		VALUES (:cliente_id, :veiculo_id, :data_abertura, :descricao_problema, :servicos_realizados, :pecas_utilizadas, :valor_total, :status )	';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cliente_id', $this->salvarOrdemServico->__get('cliente_id'));
		$stmt->bindValue(':veiculo_id', $this->salvarOrdemServico->__get('veiculo_id'));
		$stmt->bindValue(':data_abertura', $this->salvarOrdemServico->__get('data_abertura'));
		$stmt->bindValue(':descricao_problema', $this->salvarOrdemServico->__get('decricao_problema'));
		$stmt->bindValue(':servicos_realizados', $this->salvarOrdemServico->__get('servicos_realizados'));
		$stmt->bindValue(':pecas_utilizadas', $this->salvarOrdemServico->__get('pecas_utilizadas'));
		$stmt->bindValue(':valor_total', $this->salvarOrdemServico->__get('valor_total'));
		$stmt->bindValue(':status', $this->salvarOrdemServico->__get('status'));		
		$stmt->execute();
	}
}









?>