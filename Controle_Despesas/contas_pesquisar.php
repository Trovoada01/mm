<!DOCTYPE html>
<html lang="pt_BR">
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

        echo "<h3>Listagem das contas</h3>";
        require "conexao.php";

        // $sql = "SELECT * FROM contas ORDER BY codigo_cliente";
        $sql = "SELECT * FROM contas INNER JOIN clientes ON contas.codigo_cliente = clientes.codigo ORDER BY clientes.nome";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        echo "<table border='1' align='center'>";
            echo "<tr>";
                echo "<th width='100' align='right'>Lançamento</th>";
                echo "<th width='300' align='left'>Nome</th>";
                echo "<th width='100' align='right'>CPF</th>";
                echo "<th width='100' align='right'>Código do cliente</th>";
                echo "<th width='300' align='right'>Valor</th>";
                echo "<th width='100' align='left'>Histórico</th>";
                echo "<th width='100' align='right'>Data</th>";
                echo "<th width='50' align='center'>Editar</th>";
            echo "</tr>";
            while ($linha=mysqli_fetch_array($resultado)) {
                $lancamento = $linha["lancamento"];
                $nome = $linha["nome"];
                $cpf = $linha["cpf"];
                $codigo_cliente = $linha["codigo_cliente"];
                $valor = $linha["valor"];
                $historico = $linha["historico"];
                $data = date("d/m/Y", strtotime($linha["data"]));

                echo "<tr>";
                    echo "<th width='100' align='right'>$lancamento</th>";
                    echo "<th width='300' align='left'>$nome</th>";
                    echo "<th width='100' align='right'>$cpf</th>";
                    echo "<th width='100' align='right'><a href='clientes_editar.php?codigo=$codigo_cliente'>$codigo_cliente</a></th>";
                    echo "<th width='100' align='right'>$valor</th>";
                    echo "<th width='250' align='left'>$historico</th>";
                    echo "<th width='100' align='right'>$data</th>";
                    echo "<th width='50' align='center'><a href='contas_editar.php?lancamento=$lancamento'>Editar</a></th>";
                echo "</tr>";
            }
        echo "</table>";
    ?>
</body>
</html>