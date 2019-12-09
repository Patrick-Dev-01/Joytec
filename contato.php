<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/contato.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/contato.js"></script>
    <title>Fale Conosco</title>
</head>
<body onload="status();">
<header id="cabecalho">
    <ul id="menu">
        <li class="links"><a href="home.php">Home</a></li>
        <li class="links"><a href="calendario.php">Calendário</a></li>
        <li class="links"><a href="contato.php">Fale Conosco</a></li>
        <?php

        //iniciar sessão
        include_once 'classes/aluno.php';
        session_start();
        $a = new Aluno();
        
        //Se existir a sessão, Mostre o nome e sobrenome do aluno
        if(isset($_SESSION['aluno_logado'])){
            $aluno = $_SESSION['aluno_logado'];
            $alunoNome = $_SESSION['aluno_nome'];
            $alunoSobrenome = $_SESSION['aluno_sobrenome'];
            $alunoEmail = $_SESSION['aluno_email'];
            echo("<span id='log'><a href='ficha.php'><button type='button' id='ficha'><small id='nome'>".$alunoNome." ".$alunoSobrenome."</small></button></a></span>
            <span id='exit'><a href='logout.php'><button type='button' id='sair'>Sair</button></a>");
        }
        //Se não, mostre o botão da "Àrea do aluno"
        else{
            echo("<li><a href='entrar.php'><button type='button' id='candidato'>Àrea do Aluno</button></a></li>");
        }
        ?>
    </ul>
    </header>

    <div class="corpo">
        <h2>Fale Conosco</h2>
        <div class="form-contato">
            <p>Em caso de dúvidas, preencha o formulário abaixo: </p>
            <span>
                <div class="atendimento">
                    <div id="suporte">Status do Suporte</div>
                    <img src="_imagens/atendimento.png" alt="" id='cont'><br>
                    <hr>
                    <strong> Capital e Grande São Paulo:</strong><small class="contato">(11) 4002-8922</small> <br>
                    <hr>
                    <strong> Outras Localidades:</strong><small class="contato"> 0800 723 9106</small>
                    <hr>
                    <strong> Atendimento de ligações (humano):</strong><small class="contato"> 8h as 20h </small>
                    <hr>
                    <strong> Atendimento URA (Eletrônico):</strong><small class="contato"> Em breve, será implementado!</small>
                </div>
            </span>

            <form action="models/duvida.php" method="POST">
               <input type="hidden" name="id" value="<?php echo($aluno);?>">

                <label for="titulo">Duvida: <br>
                    <input type="text" name="titulo" id="cTitulo" class="campos" placeholder="Destaque sua duvida principal">
                </label><br>

                <label for="descricao">Descrição: (opcional) <br>
                    <textarea name="descricao" id="cMensagem" cols="47" rows="7" class="campos" placeholder="descreva..."></textarea>
                </label><br>

                <button type="submit" id="cEnviar">Enviar</button>
                <span><button type="button" id="limpar" onclick="esvaziar();">Limpar</button></span>
            </form><br>
        </div>       
    </div>
</body>
</html>