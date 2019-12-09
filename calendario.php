<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/calendario.css">
    <title>Calendario</title>
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
            require_once 'classes/curso.php';
            session_start();

            $c = new Curso();
            
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

    <div class="corpo">
        <h2 id='title'>Calendário</h2>
        <div class="calendario">
            <br>
            <?php
                $c->todosLancamentos();
            ?>
        </div>
    </div>
</body>
</html>