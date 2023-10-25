<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "<div class='error-message'>Preencha seu e-mail</div>";
        echo "<script>
            setTimeout(function() {
                var errorDiv = document.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
            }, 6000); // Desaparecer após 3 segundos (3000 milissegundos)
          </script>";
    } else if(strlen($_POST['senha']) == 0) {
        echo "<div class='error-message'>Preencha sua senha</div>";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else {
            echo "<div class='error-message'>Falha ao logar! E-mail ou senha incorretos</div>";
            echo "<script>
            setTimeout(function() {
                var errorDiv = document.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
            }, 6000); // Desaparecer após 3 segundos (3000 milissegundos)
          </script>";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="box header">
            <h2>T</h2>
            <h2>A</h2>
            <h2>S</h2>
            <h2>K</h2>
            <h2>D</h2>
            <h2>A</h2>
            <h2>Y</h2>
        </div>
    </header>
    <div class="container">
        <div class="error-message"></div>  
        <div class="whiteBg">
            <div class="box signin">
                <h2>Já tem uma conta?</h2>
                <button class="loginBtn">Login</button>
            </div>
            <div class="box signup">
                <h2>Não está cadastrado?</h2>
                <button class="signupBtn">Cadastrar</button>
            </div>
        </div>
       
       <div class="formBx">      
           <div class="form loginForm">
                <form action="" method="POST">
                    <h3>Login</h3>
                    <input type="text" name="email" placeholder="E-mail">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="submit" value="Entrar">
                    <a href="#" class="forgot">Esqueceu a senha?</a>
                </form>
        </div>

        <div class="form signupForm">
            <form action="">
                <h3>Cadastro</h3>
                <input type="text" placeholder="Nome de Usuário">
                <input type="text" placeholder="Endereço de email">
                <input type="text" placeholder="Senha">
                <input type="text" placeholder="Confirme sua senha">
                <input type="submit" value="Cadastrar">
            </form>
        </div>
       </div> 
    </div>
    
    <script>
        const loginBtn = document.querySelector('.loginBtn');
        const signupBtn = document.querySelector('.signupBtn');
        const formBx = document.querySelector('.formBx');
        const body = document.querySelector('body')

        signupBtn.onclick = function(){
            formBx.classList.add('active')
            body.classList.add('active')
        }

        loginBtn.onclick = function(){
            formBx.classList.remove('active')
            body.classList.remove('active')
        }
    </script>

</body>
</html>