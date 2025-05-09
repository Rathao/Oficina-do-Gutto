<?php
// $host = "localhost"; // Seu host (geralmente localhost)
// $dbname = "oficina_bd"; // Nome do seu banco de dados
// $username = "root"; // Seu nome de usuário do banco de dados
// $password = ""; // Sua senha do banco de dados

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//     // Defina o modo de erro do PDO para exceções
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Erro na conexão com o banco de dados: " . $e->getMessage());
// }

class Conexao {

	private $host = 'localhost';
	private $dbname = 'oficina_bd';
	private $username = 'root';
	private $password = '';

	public function conectar() {
		try {
            $conexao = new PDO("mysql:host=$this->host; dbname=$this->dbname;charset=utf8", 
					  		$this->username, 
							$this->password
			);           
        
			return $conexao;

		} catch (PDOException $e) {
			echo " na conexão com o banco de dados: " . $e->getMessage();
		}
	}
}


?>