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
require_once '../Classes/usuario.php';
require_once '../DAO/gendao.php';

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($email, $nome, $senha);

    Gendao::getInstance('usuario')->insert($usuario);

?>

<table>
    <thead>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Senha</th>
    </tr>
    </thead>
    <tbody>

<?php

    $dados = Gendao::getInstance('usuario')->select('usuario');

    foreach ($dados as $dado){
        echo "<tr>";
        echo "<td>".$dado->email."</td>";
        echo "<td>".$dado->nome."</td>";
        echo "<td>".$dado->senha."</td>";
        echo "</tr>";
    }

?>
    </tbody>
</table>
</div>
</body>
</html>