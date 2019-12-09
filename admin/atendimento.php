<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_admin/partials_admin/menu_admin.css">
    <link rel="stylesheet" href="css_admin/atendimento.css">
    <script src="js_admin/atendimento.js"></script>
    <title>Duvidas dos Alunos</title>
</head>
<body>
<?php
        require_once '../classes/admin.php';
        session_start();
        $admin = new Administrador();
                   
        //Se existir sessão
        if(isset($_SESSION['admin'])){
            //continue na pagina
            $id = $_SESSION['admin'];
        }
        //Se não existir 
        else{
            //Volte para tela de login
            header("location: login_admin.html");
        }
    ?>
    <header>
        <ul id="navegacao">
            <li><img src="img_admin/admin_page.jpg" alt="" id="admin"></li>
            <li class="pages"><a href="home_admin.php">Home</a></li>
            <li class="pages"><a href="admin_cursos.php?f=">Cursos</a></li>
            <li class="pages"><a href="atendimento.php?d=">Duvidas</a></li>
            <li class="pages"><a href="novo_curso.php">+ Novo Curso</a></li>
            <li class="pages" id="joytec"><a href="../home.php">Ir para Joytec</a></li>
        </ul>
    </header>

    <div class="conteudo">
       <!-- <article id="filtros">
           
        </article>-->
        <section class='duvidas'>
        <?php
            $filtro = $_GET['d'];
            $admin->duvidas($filtro);
        ?>
        </section>
    </div>
</body>
</html>