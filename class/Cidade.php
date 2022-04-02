<?php
    class Cidade{
        private $id;
        private $id_estado;
        private $nome;
        public function __construct($id_est, $nm){
            $this->setIdEstado($id_est);
            $this->setNome($nm);
        }
        public function inserirCidade(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO cidade (id_estado, cid_nome) VALUES(:id_estado, :cid_nome)");
            $stmt->bindParam(":id_estado", $this->getIdEstado(), PDO::PARAM_STR);
            $stmt->bindParam(":cid_nome", $this->getNome(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function alterarCidade($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE cidade SET id_estado = :id_estado, cid_nome = :cid_nome WHERE id = $id");
            $stmt->bindParam(":id_estado", $this->getIdEstado(), PDO::PARAM_STR);
            $stmt->bindParam(":cid_nome", $this->getNome(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function getIdEstado(){
            if($this->id_estado != "")
                return $this->id_estado;
            else
                return "Não informado";
        }
        public function getNome(){
            if($this->nome != "")
                return $this->nome;
            else
                return "Não informado";
        }
        public function setIdEstado($newIdEstado){
            $this->id_estado = $newIdEstado;
        }
        public function setNome($newNome){
            $this->nome = $newNome;
        }
    }
?>