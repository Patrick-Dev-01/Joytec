<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_admin/partials_admin/menu_admin.css">
    <link rel="stylesheet" href="css_admin/topico.css">
    <script src="js_admin/topico.js"></script>
    <title>Topico da Duvida</title>
</head>
<body>
    <?php
        require_once '../classes/admin.php';
        require_once '../classes/aluno.php';
        session_start();
        $admin = new Administrador();
        $a = new Aluno();
                   
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

    <div class='topico'>
        <?php
          $id_duvida = $_GET['t'];
          $id_aluno = $_GET['a'];
          $admin->topico($id_duvida, $id_aluno);

          $admin->respostas($id_duvida);
        ?>
        <hr>
        <form action="models/responder.php" method="POST">
            <input type="hidden" name="id_d" value="<?php echo($id_duvida)?>">
            <input type="hidden" name="id_admin" value="<?php echo($id)?>">
            <label for="resposta">Responder: <br>
                <textarea name="resposta" id="comentario" cols="50" rows="5"></textarea>
            </label><br>
            <button type="submit" id="btn-resp" class="btn">Responder</button>
            <button type="button" id="btn-limpar" class="btn" onclick="esvaziar();">Limpar</button>
        </form>
    </div>
</body>
</html>