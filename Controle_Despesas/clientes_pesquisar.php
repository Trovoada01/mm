<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Despesas - Pesquisa</title>
    <link rel="stylesheet" href="css/estilos_menu.css">
    <link rel="stylesheet" href="css/estilos_formulario.css">
</head>
<body>
    <?php
        require "login_verifica.php"; // Verifica se esta logado
        require "menu.php";

        echo "<h3>Listagem dos Clientes</h3>";
        require "conexao.php";

        $sql = "SELECT * FROM clientes ORDER BY nome";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        echo "<table border='1' width='1000' align='center'>";
            echo "<tr>";
                echo "<th width='100' align='right'>Código</th>";
                echo "<th width='300' align='Left'>Nome</th>";
                echo "<th width='100' align='Left'>CPF</th>";
                echo "<th width='250' align='Left'>E-mail</th>";
                echo "<th width='50' align='Left'>Editar</th>";
            echo "</tr>";
            while ($linha=mysqli_fetch_array($resultado)) {
                $codigo = $linha["codigo"];
                $nome = $linha["nome"];
                $cpf = $linha["cpf"];
                $email = $linha["email"];

                echo "<tr>";
                    echo "<th width='100' align='right'>$codigo</th>";
                    echo "<th width='300' align='Left'>$nome</th>";
                    echo "<th width='100' align='Left'>$cpf</th>";
                    echo "<th width='250' align='Left'>$email</th>";
                    echo "<th width='50' align='center'><a href='clientes_editar.php?codigo=$codigo'>Editar</a></th>";
                echo "</tr>";
            }
        echo "</table>";
    ?>
</body>
</html>