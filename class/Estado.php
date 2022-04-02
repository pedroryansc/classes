<?php
    class Estado{
        private $id;
        private $nome;
        private $sigla;
        public function __construct($nm, $sgl){
            $this->setNome($nm);
            $this->setSigla($sgl);
        }
        public function inserirEstado(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO estado (est_nome, sigla) VALUES(:est_nome, :sigla)");
            $stmt->bindParam(":est_nome", $this->getNome(), PDO::PARAM_STR);
            $stmt->bindParam(":sigla", $this->getSigla(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function alterarEstado($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE estado SET est_nome = :est_nome, sigla = :sigla WHERE id = $id");
            $stmt->bindParam(":est_nome", $this->getNome(), PDO::PARAM_STR);
            $stmt->bindParam(":sigla", $this->getSigla(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function getNome(){
            if($this->nome != "")
                return $this->nome;
            else
                return "Não informado";
        }
        public function getSigla(){
            if($this->sigla != "")
                return $this->sigla;
            else
                return "Não informado";
        }
        public function setNome($newNome){
            $this->nome = $newNome;
        }
        public function setSigla($newSigla){
            $this->sigla = $newSigla;
        }
    }
?>