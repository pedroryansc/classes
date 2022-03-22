<?php
    class Estado{
        private $id;
        private $nome;
        private $sigla;
        public function __construct($nm, $sgl){
            $this->nome = $nm;
            $this->sigla = $sgl;
        }
        public function inserirEstado(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO estado (est_nome, sigla) VALUES(:est_nome, :sigla)");
            $stmt->bindParam(":est_nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(":sigla", $this->sigla, PDO::PARAM_STR);
            return $stmt->execute();
        }
    }
?>