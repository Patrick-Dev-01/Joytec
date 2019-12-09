<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_admin/partials_admin/menu_admin.css">
    <link rel="stylesheet" href="css_admin/home_admin.css">
    <title>Pagina Inicial</title>
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

    <div class="sessao">
            <h2 id="title">Seja Bem-Vindo para mais um Expediente!</h2>
        <div id="boas-vindas"><br>
            <div class="admin-info">
                <strong id="title-ficha">Ficha do Administrador</strong>
                <hr>
               <div class="ficha">
                    <img src="./img_admin/icon-headset_87991.png" id="admin-logado" alt="">
                   
                    <?php
                        $admin->fichaAdmin($id);
                    ?>
            </div>
        </div>
    </div>
</body>
</html>