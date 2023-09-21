<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Despesas</title>
    <link rel="stylesheet" href="css/estilos_menu.css">
    <link rel="stylesheet" href="css/estilos_formulario.css">
</head>

<body>
    <?php
        require "login_verifica.php"; // Verifica se esta logado
        require "menu.php"; // Importa o menu do sistema de Controle de Despesas
    ?>
    <div id="cadastro">
        <h3>CADASTRO DE CONTAS</h3>
        <form name="cadastro" method="post" action="">
            <table>
                <tr>
                    <td><label for="nome">Código:</label></td>
                    <td><input type="number" name="codigo" size="40" min="1" placeholder="Informe o código do cliente" required>
                </tr>
                <tr>
                    <td><label for="valor">Valor:</label></td>
                    <td><input type="number" name="valor" size="40" min="0" step="0.01" placeholder="Informe o valor em conta" required>
                </tr>
                <tr>
                    <td><label for="Historico">Histórico:</label></td>
                    <td><textarea name="historico" cols="30" rows="10" placeholder="Informe o histórico do cliente" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="data">Data:</label></td>
                    <td><input type="date" name="data" required>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="cadastrar" value="Cadastrar">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST["cadastrar"])) {
            $codigo = $_POST["codigo"];
            $valor = $_POST["valor"];
            $historico = $_POST["historico"];
            $data = $_POST["data"];
            require "conexao.php";

            $sql = "SELECT * FROM clientes WHERE codigo='$codigo'";
            $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            $linha = mysqli_fetch_array($resultado);
            if ($linha == null) {
                echo "<p align='center'>Cliente não cadastrado! <a href='clientes_inserir.php'>Cadastrar?</a></p>";
            }
            else {
                $sql = "SELECT * FROM contas WHERE codigo_cliente='$codigo'";
                $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
                $linha = mysqli_fetch_array($resultado);

                if ($linha == null) {
                    $sql = "INSERT INTO contas(codigo_cliente, valor, data, historico)";
                    $sql .= " VALUES ('$codigo', '$valor', '$data', '$historico')";
                    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
                    echo "<script type =\"text/javascript\">alert('Conta cadastrada com sucesso!');</script>";
                    echo "<p align='center'><a href='home.php'>Voltar</a></p>";
                }
                else {
                    echo "<p align='center'>Conta já cadastrada!</p>";
                }
            }
        
        }
        ?>
    </div>
</body>

</html>