<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/partials/menu.css">
    <link rel="stylesheet" href="_css/cadastro.css">
    <script src="js/verSenha.js"></script>
    <title>Formulário de Cadastro</title>
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
            echo("<span id='log'><a href='ficha.php'><button type='button' id='ficha'><small id='nome'>".$alunoNome." ".$alunoSobrenome."</small></button></a>
            </span><span id='exit'><a href='logout.php'><button type='button' id='sair'>Sair</button></a>");
        }
        //Se não, mostre o botão da "area do aluno"
        else{
            echo("<li><a href='entrar.php'><button type='button' id='candidato'>Àrea do Aluno</button></a></li>");
        }
        ?>
    </ul>
    </header>

    <div class="corpo">
        <article class="imagem">
            <img src="_imagens/fundo_formulario.jpg" id="fundo" alt="">
        </article>

        <section class="formulario">
            <header class="legend">Preencha o Formulário de Inscrição</header>
            <hr>
            <img src="_imagens/imagem_form.png" id="card" alt="">

            <!--Formulário de Cadastro-->
        <form action="models/cadastro.php" method="POST">
            <label for="rg">RG: 
                <input type="number" name="rg" id="" min="0" style="width: 275px;" placeholder="9 digitos">
            </label><br>

            <label for="cpf">CPF: 
                <input type="number" name="cpf" id="" min="0" style="width: 270px;" placeholder="11 digitos">
            </label><br>

            <label for="nome">Nome: 
                <input type="text" name="nome" id="" style="width: 260px;">
            </label><br>

            <label for="sobrenome">Sobrenome: 
                <input type="text" name="sobrenome" id="" style="width: 225px;">
            </label><br>

            <label for="nascimento">Data de Nascimento: 
                <input type="date" name="nascimento" id="" style="width: 165px;"><br>
            </label>

            <label for="senha">Senha: 
                    <input type="password" name="senha" id="cSenha" style="width: 260px;" placeholder="minimo 3 caracteres">
                    <span><img src="_icons/ver_senha.png" id="ver-senha" class="icone" alt="" onclick="mostrar();"></span>
            </label><br>

            <label for="email">Email: 
                <input type="email" name="email" id="" style="width: 260px;">
            </label><br>

            <input type="submit" value="Cadastrar" id="cCadastrar">
        </form>
        </section>
    </div>
</body>
</html>