<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Acesso</title>
    <link rel="stylesheet" href="css/estilos_login.css">
</head>
<body>
    <div class="container">
        <h3>Login de Acesso</h3>
        <form name="login" method="post" action="">
            <div class="form_grupo">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" maxlength="30" required>
            </div>
            <div class="form_grupo">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" maxlength="20" required>
            </div>
            <input type="submit" name="acessar" value="Acessar">
        </form>
        <p align="center"><a href="criar_conta.php">Criar Conta</a></p>
    </div>
    <?php
        if(isset($_POST["acessar"])) // Se clicou no botão cadastrar
        {
            $usuario    =   $_POST["usuario"];
            $senha      =   $_POST["senha"];
            require "conexao.php";
            
            $sql = "SELECT * FROM logins WHERE usuario='$usuario'";
            $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            $linha = mysqli_fetch_array($resultado);
            if ($linha == null || $linha["senha"] != $_POST["senha"]) {
                echo "<p align='center'>Usuário ou senha incorreta!</p>";
            }
            else {
                session_start(); // Inicia a sessão
                $_SESSION["usuario"]    = $usuario; // Salva a variável na sessão
                $_SESSION["senha"]      = $senha;
                
                echo "<meta http-equiv='refresh' content='0;url=home.php' />";
            }

            
        }
    ?>
</body>
</html>