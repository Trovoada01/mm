<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Despesas - Editar</title>
    <link rel="stylesheet" href="css/estilos_menu.css">
    <link rel="stylesheet" href="css/estilos_formulario.css">
</head>
<body>
    <?php
        require "login_verifica.php"; // Verifica se esta logado
        require "menu.php";

        echo "<h3>Editar Cadastro de Contas</h3>";
        
        require "conexao.php";
        $lancamento = $_REQUEST["lancamento"];
        $sql = "SELECT * FROM contas WHERE lancamento='$lancamento'";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $linha = mysqli_fetch_array($resultado);

        $lancamento = $linha["lancamento"];
        $codigo_cliente = $linha["codigo_cliente"];
        $valor = $linha["valor"];
        $historico = $linha["historico"];
        $data = $linha["data"];

        echo "<form name='cadastro' method='post' action=''>";
            echo "<table align='center'>";
                echo "<tr>";
                    echo "<td><label for='lancamento'>Lançamento:</label></td>";
                    echo "<td><input type='number' name='lancamento' size='4' value='$lancamento' readonly></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='codigo_cliente'>Código Cliente:</label></td>";
                    echo "<td><input type='number' name='codigo_cliente' size='50' maxlegth='50' value='$codigo_cliente' readonly></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='valor'>Valor:</label></td>";
                    echo "<td><input type='number' name='valor' size='40' min='0' step='0.01' value='$valor' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='historico'>Histórico:</label></td>";
                    echo "<td><textarea name='historico' cols='30' rows='10' placeholder='Informe o histórico do cliente' required>$historico</textarea></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><label for='data'>Data:</label></td>";
                    echo "<td><input type='date' name='data' value='$data' required></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td colspan='2' align='center'><input type='submit' name='salvar' value='Salvar'></td>";
                echo "</tr>";
            echo "</table>";
        echo "</form>";

        if (isset($_POST["salvar"])) {
            $valor = $_POST["valor"];
            $historico = $_POST["historico"];
            $data = $_POST["data"];

            $sql = "UPDATE contas SET valor='$valor', historico='$historico', data='$data' WHERE lancamento='$lancamento'";
            mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            echo "<script type =\"text/javascript\">alert('Conta editada com sucesso!');</script>";
            echo "<p align='center'><a href='home.php'>Voltar</a></p>";
        }
    ?>
</body>
</html>