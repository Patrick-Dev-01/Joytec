<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/cursos.css">
    <title>Cursos</title>
</head>
<body>
<header id="cabecalho">
    <ul id="menu">
        <li class="links"><a href="home.php">Home</a></li>
        <li class="links"><a href="calendario.php">Calendário</a></li>
        <li class="links"><a href="contato.php">Fale Conosco</a></li>
        <?php

        //iniciar sessão
        require_once 'classes/aluno.php';
        require_once 'classes/curso.php';
        session_start();

        //instanciar a classe curso
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

    <!--Opções de Busca-->
    <div class="corpo">
        <h2 id="cTitulo">Cursos Disponíveis</h2>
        <div class="fundo"><small id='a'>a</small>
        <article class="options">
            <form action="cursos.php" method="GET">
                <label for="curso">Faça uma nova busca: <br>
                    <input type="text" name="curso" id="" placeholder="Nova busca...">
                </label>
                <button type="submit" id="btn-buscar">Buscar</button>
            </form>
            <hr>
            <h3>Filtrar por: </h3>
            <hr>
            <small class="filtros"><a href="cursos.php?curso=">Todos os cursos</a></small><br>
            <hr>
            <h4 class="filtrar">Grau</h4>
            <small class="filtros"><a href="cursos.php?curso=basico">Básicos</a></small><br>
            <small class="filtros"><a href="cursos.php?curso=intermediario">Intermediários</a></small><br>
            <small class="filtros"><a href="cursos.php?curso=avancado">Avançados</a></small><br>
            
            <hr>
            <h4 class="filtrar">Carga Horária: </h4>
            <small class="filtros"><a href="cursos.php?curso=20">20 a 40 horas</a></small><br>
            <small class="filtros"><a href="cursos.php?curso=50">50 a 90 horas</a></small><br>
            <small class="filtros"><a href="cursos.php?curso=90">Mais que 90 horas</a></small><br>


            <hr>
            <h4 class="filtrar">Data: </h4>
            <small class="filtros"><a href="cursos.php?curso=asc">Mais Antigo ao mais recente</small></a><br>
            <small class="filtros"><a href="cursos.php?curso=desc">Mais Recente ao mais antigo</small></a>
        </article>

        <!--Cursos-->
       <section class="cursos">
           <?php
           //se um filtro de pesquisa for passado
           if(isset($_GET['curso'])){
              $parametro = $_GET['curso'];
              $c->cursos($parametro);
           }
           ?>
       </section>
    </div>
    </div>
</body>
</html>