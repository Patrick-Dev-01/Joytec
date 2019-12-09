<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/login.css">
    <title>Login</title>
</head>
<body>
<header id="cabecalho">
    <ul id="menu">
        <li class="links"><a href="home.php">Home</a></li>
        <li class="links"><a href="calendario.php">Calendário</a></li>
        <li class="links"><a href="contato.php">Fale Conosco</a></li>
        <?php

        //iniciar sessão
        include_once 'classes/aluno.php';
        session_start();
        
        //Se existir a sessão, Mostre o nome e sobrenome do aluno
        if(isset($_SESSION['aluno_logado'])){
            $aluno = $_SESSION['aluno_logado'];
            $alunoNome = $_SESSION['aluno_nome'];
            $alunoSobrenome = $_SESSION['aluno_sobrenome'];
            echo("<span id='log'><a href='ficha.php'><button type='button' id='ficha'><small id='nome'>".$alunoNome." ".$alunoSobrenome."</small></button></a></span>
            <span id='exit'><a href='logout.php'><button type='button' id='sair'>Sair</button></a>");
        }
        //Se não, mostre o botão da "area do aluno"
        else{
            echo("<li><a href='entrar.php'><button type='button' id='candidato'>Àrea do Aluno</button></a></li>");
        }
        ?>
    </ul>
    </header>

     <!--Formulario de Login-->
     <div class="corpo">
            <h2 id="area">Àrea do Aluno</h2>
         <div class="login">
            <section>
                <article class="informacao">
                <h2 id="boas-vindas">Bem-Vindo(a)!</h2>
                <small class="msg">Nessa pagina você pode acessar a Àrea do Aluno para consultar suas informações.<br>
                    <small class="msg">Você pode alterar alguns dados caso houver erros ou mudanças, fique a vontade.</small> 
                </small>
                <br>
                <br>
                <p class="msg">Informe seu CPF e Senha ao lado para acessar.</p>
            </article>
            <article class="form">
                <form action="models/login.php" method="POST">
                    <label for="cpf">CPF do Aluno <br>
                        <input type="number" name="cpf" id="" min="0">
                    </label><br>

                    <label for="senha" id="cSenha">Senha <br>
                        <input type="password" name="senha" id="">
                    </label><br>

                    <button type="submit" id="entrar">Entrar</button>
                    <!--<a href=""><span class="esqueceu-senha">Esqueci minha senha</span></a>-->
                </form>
            </article>
        </section>
        </div>
     </div>
</body>
</html>