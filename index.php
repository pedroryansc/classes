<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidade e Estado (Implementação de classes)</title>
</head>
<body>
    <form action="acao.php" method="post">
        Cidade: <input type="text" name="cidade">
        Estado: <select name="estado">
                    <?php
                        $pdo = Conexao::getInstance(); 
                        $consulta = $pdo->query("SELECT * FROM estado");
                        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                            echo "<option value='{$linha['id']}'>{$linha['est_nome']}</option>";
                        }
                    ?>
                </select>
        <button type="submit" name="acao" value="cidade">Cadastrar Cidade</button>
    </form>
    <br>
    <br>
    <form action="acao.php" method="post">
        Estado: <input type="text" name="est_nome">
        Sigla: <input type="text" name="sigla">
        <button type="submit" name="acao" value="estado">Cadastrar Estado</button>
    </form>
</body>
</html>