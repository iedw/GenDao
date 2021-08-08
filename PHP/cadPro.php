<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css" media="screen"/>
</head>
<body>
<div class="tabela">
    <?php
    require_once '../Classes/produto.php';
    require_once '../DAO/gendao.php';

    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];

    $produto = new Produto($codigo, $descricao, $categoria, $preco);

    Gendao::getInstance('produto')->insert($produto);

    ?>

    <table>
        <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Preço</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $dados = Gendao::getInstance('produto')->select('produto');

        foreach ($dados as $dado){
            echo "<tr>";
            echo "<td>".$dado->codigo."</td>";
            echo "<td>".$dado->descricao."</td>";
            echo "<td>".$dado->categoria."</td>";
            echo "<td>".$dado->preco."</td>";
            echo "</tr>";
        }

        ?>
        </tbody>
    </table>
</div>
</body>
</html>