<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "acao.php";

    $obj = isset($_GET["obj"]) ? $_GET["obj"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    if($obj == "cidade" || $obj == "estado"){
        if($id > 0)
            $dados = buscarDados($id, $obj);
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidade e Estado (Implementação de classes)</title>
</head>
<body>
    <form action="acao.php?id=<?php echo $id; ?>" method="post">
        Cidade: <input type="text" name="cidade" value="<?php if($obj == "cidade") echo $dados["cid_nome"]; ?>">
        Estado: <select name="estado">
                    <?php
                        $pdo = Conexao::getInstance(); 
                        $consulta = $pdo->query("SELECT * FROM estado");
                        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                    ?>
                    <option value="<?php echo $linha["id"]; ?>" <?php if($obj == "cidade" && $dados["id_estado"] == $linha["id"]) echo "selected"; ?>>
                        <?php echo $linha['est_nome']; ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
        <button type="submit" name="acao" value="cidade">Salvar Cidade</button>
    </form>
    <br>
    <br>
    <form action="acao.php?id=<?php echo $id; ?>" method="post">
        Estado: <input type="text" name="est_nome" value="<?php if($obj == "estado") echo $dados["est_nome"]; ?>">
        Sigla: <input type="text" name="sigla" value="<?php if($obj == "estado") echo $dados["sigla"]; ?>">
        <button type="submit" name="acao" value="estado">Salvar Estado</button>
    </form>
    <br>
    <table border="1">
        <th>Cidade</th>
        <th>Estado</th>
        <th>Editar</th>
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT cidade.id, cid_nome, est_nome, sigla
                                    FROM cidade JOIN estado ON cidade.id_estado = estado.id");
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
        ?>
        <tr>
            <td><?php echo $linha['cid_nome']; ?></td>
            <td><?php echo "{$linha['est_nome']} ({$linha['sigla']})"; ?></td>
            <td><a href="index.php?obj=cidade&id=<?php echo $linha['id'];?>">Editar</a></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <br>
    <table border="1">
        <th>Nome do Estado</th>
        <th>Sigla</th>
        <th>Editar</th>
        <?php
            $consulta = $pdo->query("SELECT * FROM estado");
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
        ?>
        <tr>
            <td><?php echo $linha['est_nome']; ?></td>
            <td><?php echo $linha['sigla']; ?></td>
            <td><a href="index.php?obj=estado&id=<?php echo $linha['id'];?>">Editar</a></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>