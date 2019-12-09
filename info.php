<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/info.css">
    <title></title>
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

    <div class="corpo">
        <h2 id="agradecimento">Obrigado pela Visita!</h2>
        <div class="nota"><br>
            <h3 id="ol">Olá Visitante! </h3>
            <p>- Agradeço o seu tempo para ver o Projeto "Joytec". Joytec é uma instituição fictícia que oferece cursos relacionados
                a programação onde pessoas interessadas na área poderão se inscrever e escolher o seu curso de preferência de forma gratuita.
            </p>

            <h3 id="obs">Observações no Projeto</h3>
            <p>- A pasta "admin" é onde contem páginas que supostamente não seriam acessíveis ao Usuário, por isso deixei 
                em arquivos separados, use ela para cadastrar os cursos. Lembrando que neste Projeto sou um Dev junior, se houver bugs, faltar algo, etc. 
                tentarei corrigir. 
            </p>
            
            <h3 id="info">Estrutura</h3>
            <p>
                <strong id="front">Front-end: </strong><small>HTML5, CSS3 e Javascript.</small><br>
                <strong id="back">Back-end: </strong><small>PHP e MYSQL.</small><br>
                <strong id="pdg">Paradigma: </strong><small>Programação Orientada a Objetos.</small><br>
                <strong id="soft">Softwares Utilizados: </strong><small>Google Chrome, Visual Studio Code, Xampp e GIT.</small>
            </p>
            
            <span class="admin">
                <a href="admin/admin_cadastro.html" target="_blank"><h4>Ir para área Administrativa</h4></a>
            </span>

            <span class="autor">
                <a href="https://github.com/PatrickPHPJR" target="_blank"><h3>Made by: PatrickPHPJR</h3></a>
            </span>
        </div>
    </div>
</body>
</html>