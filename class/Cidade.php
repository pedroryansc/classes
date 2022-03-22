<?php
    class Cidade{
        private $id;
        private $id_estado;
        private $nome;
        public function __construct($id_est, $nm){
            $this->id_estado = $id_est;
            $this->nome = $nm;
        }
        public function inserirCidade(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO cidade (id_estado, cid_nome) VALUES(:id_estado, :cid_nome)");
            $stmt->bindParam(":id_estado", $this->id_estado, PDO::PARAM_STR);
            $stmt->bindParam(":cid_nome", $this->nome, PDO::PARAM_STR);
            return $stmt->execute();
        }
    }
?>