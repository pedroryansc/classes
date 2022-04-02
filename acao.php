<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    
    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    if($acao == "cidade"){
        if($id == 0)
            cadastrarCidade();
        else
            editarCidade($id);
    } else if($acao == "estado"){
        if($id == 0){
            cadastrarEstado();
        }else
            editarEstado($id);
    }

    function cadastrarCidade(){
        require_once "class/Cidade.php";
        $cidade = new Cidade($_POST["estado"], $_POST["cidade"]);
        $cidade->inserirCidade();
        header("location:index.php");
    }
    function cadastrarEstado(){
        require_once "class/Estado.php";
        $estado = new Estado($_POST["est_nome"], $_POST["sigla"]);
        $estado->inserirEstado();
        header("location:index.php");
    }

    function editarCidade($id){
        require_once "class/Cidade.php";
        $cidade = new Cidade($_POST["estado"], $_POST["cidade"]);
        $cidade->alterarCidade($id);
        header("location:index.php");
    }
    function editarEstado($id){
        require_once "class/Estado.php";
        $estado = new Estado($_POST["est_nome"], $_POST["sigla"]);
        $estado->alterarEstado($id);
        header("location:index.php");
    }
    function buscarDados($id, $obj){
        $pdo = Conexao::getInstance();
        if($obj == "cidade"){
            $consulta = $pdo->query("SELECT * FROM cidade, estado WHERE cidade.id = $id");
            $dados = array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $dados["id_estado"] = $linha["id_estado"];
                $dados["cid_nome"] = $linha["cid_nome"];
            }
        } else if($obj == "estado"){
            $consulta = $pdo->query("SELECT * FROM estado WHERE id = $id");
            $dados = array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $dados["est_nome"] = $linha["est_nome"];
                $dados["sigla"] = $linha["sigla"];
            }
        }
        return $dados;
    }
?>