<?php
Class Clientes{
	private $id;
	private $nome;
	private $cpf_cnpj;
	private $telefone;
	private $email;
    private $endereco;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}
class Veiculos {
	private $id;	
	private $cliente_id;
	private $marca;
	private $modelo;
	private $ano;
    private $placa;
	private $cor;
	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}
class OrdensServico {	
	private $id;
	private $cliente_id;
	private $veiculo_id;
	private $data_abertura;
	private $descricao_problema;
    private $servicos_realizados;
    private $pecas_utilizadas;
    private $valor_total;
    private $status;
    
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}
class Agendamentos {	
	private $id;
	private $cliente_id;
	private $veiculo_id;
	private $data_agendamento;
	private $hora_agendamento;
    private $servico_solicitado;
    
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}
class Status {	
	private $id;
	private $status;
		   
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}


?>