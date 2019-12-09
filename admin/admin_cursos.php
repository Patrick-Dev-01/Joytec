<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_admin/partials_admin/menu_admin.css">
    <link rel="stylesheet" href="css_admin/admin_curso.css">
    <title>Editar</title>
</head>
<body>
    <?php
        require_once '../classes/admin.php';
        require_once '../classes/curso.php';
        session_start();
        $c = new Curso();
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

    <div class="cursos">
        <article class="ordem"><br>
            <small id="pesquisa">Pesquisar Curso: </small>
            <form action="editcurso.php" method="GET">
                <input type="text" name="curso" id="cCurso">
                <button type="submit" id="cBuscar">Buscar</button>
            </form>
            <hr>
        <!--Filtros de Pesquisa-->
            <h2>Filtrar por: </h2>
            <hr>
            <a href="admin_cursos.php?f="><small class="filtros">Todos os cursos</small></a>
            <hr>
            <h3 class="tipos">Grau: </h3>
            <a href="admin_cursos.php?f=basico"><small class="filtros">Básico</small></a><br>
            <a href="admin_cursos.php?f=intermediario"><small class="filtros">Intermediário</small></a><br>
            <a href="admin_cursos.php?f=avancado"><small class="filtros">Avançados</small></a>

            <hr>
            <h3 class="tipos">Carga Horária: </h3>
            <a href="admin_cursos.php?f=20"><small class="filtros">20 a 40 horas</small></a><br>
            <a href="admin_cursos.php?f=40"><small class="filtros">40 a 80 horas</small></a><br>
            <a href="admin_cursos.php?f=80"><small class="filtros">Mais que 80 horas</small></a><br>


            <hr>
            <h3 class="tipos">Data: </h3>
            <a href="admin_cursos.php?f=asc"><small class="filtros">Mais Antigo ao mais recente</small></a><br>
            <a href="admin_cursos.php?f=desc"><small class="filtros">Mais Recente ao mais antigo</small></a>
        </article>

    <!--os Cursos aparecerão nessas sections-->
        <section class="conteudo">
        <?php
           $filtro = $_GET['f'];
           $admin->listarCursos($filtro);
        ?>
        </section>
    </div>
</body>
</html>