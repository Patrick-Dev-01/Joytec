<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/home.css">
    <title>Home Page</title>
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
        <header class="instituicao">
            
        </header>

        <table class="tabela">
            <tr>
                <td class="col">Inscrever-se</td>
                <td class="col">Área do Aluno</td>
                <td class="col">Calendário</td>
            </tr>

            <tr>
                <td class="row">Quer Aprender a Programar? Então se Inscreva e escolha o Curso de sua preferência com um
                ensino completo e gratuito!
                <hr>
                <a href="inscrever.php"><button type="button" class="btn" id="inscrever">Inscrever-se</button>
                </td>

                <td class="row">Se Você ja realizou a inscrição 
                    acesse a Àrea do Aluno para consultar os detalhes de suas Informações
                    <hr>
                    <br>
                    <a href="entrar.php"><button type="button" class="btn" id="entrar">Entrar</button></a>
                </td>

                <td class="row">
                    <?php
                       $c->novosCursos();
                    ?>
                    <hr>
                    <a href="calendario.php" id="programacao">Programação Completa</a>
                </td>
            </tr>

            <tr>
                <td class="col2"><img src="_imagens/logo_governo.png" id="logo" alt="" style="width: 300px; height: 100px;"></td>
                <td class="col2">
                    <div class="enfeite"><a href="cursos.php?curso=" id="ver">
                        <img src="_icons/pesquisar_cursos.png" id="cursos" alt="">
                    </div></a>
                        <form action="cursos.php" method="GET">
                            <input type="text" name="curso" id="cPesquisa" placeholder=" Pesquisar curso">
                            <button type="submit" id="btn-pesquisa">Buscar</button>
                        </form>
                        <a href="demanda.php" id="cQtd">Quantidade de inscritos por curso</a>
                </td>

                <td class="col2">
                            <img src="_icons/quem_somos.png" alt="" id="icon-qs">
                    <hr>
                    <a href="info.php" id="info"><p>Veja tudo sobre a Joytec e o nosso sistema de ensino</p></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>