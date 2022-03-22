<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    
    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    if($acao == "cidade")
        cadastrarCidade();
    else{
        cadastrarEstado();
    }

    function cadastrarCidade(){
        require_once "class/Cidade.php";
        $cidade = new Cidade($_POST["estado"], $_POST["cidade"]);
        if($cidade->inserirCidade())
            echo "Cadastro da cidade realizado com sucesso!";
        else{
            echo "Ocorreu um erro";
        }
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT cid_nome, est_nome
                                FROM cidade, estado
                                WHERE cidade.id_estado = estado.id");
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<br><br>
            Cidade: {$linha['cid_nome']} <br>
            Estado: {$linha['est_nome']} <br>";
        }
    }
    function cadastrarEstado(){
        require_once "class/Estado.php";
        $estado = new Estado($_POST["est_nome"], $_POST["sigla"]);
        if($estado->inserirEstado())
            echo "Cadastro do estado realizado com sucesso!";
        else{
            echo "Ocorreu um erro";
        }
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT est_nome, sigla
                                FROM estado");
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<br><br>
            Nome do Estado: {$linha['est_nome']} <br>
            Sigla do Estado: {$linha['sigla']} <br>";
        }
    }
?>