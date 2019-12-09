<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_admin/partials_admin/menu_admin.css">
    <link rel="stylesheet" href="css_admin/addcurso.css">
    <script src="js_admin/preview.js"></script>
    <title></title>
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

    <div class="fundo">
       <div class="addcurso">
        <legend><h1 id="add">Adicionar um Curso</h1></legend>
        <hr>
        <form action="models/addcurso.php" method="POST" enctype="multipart/form-data">
            <span id="icone"><label for="imagem">Icone (Opcional):
                <input type="file" name="imagem" id="cIcone" accept="image/*" onchange="previewIcone();"><br>
                <img style="width: 250px; height: 150px;" alt="" id="preview">
            </label></span>

            <label for="nome">Nome do Curso: <br>
                <input type="text" name="nome" id="">
            </label><br>

            <label for="carga">Carga horária: <br>
                <input type="number" name="carga" id="" min="0">
            </label><br>

            <label for="grau">Grau:
                <select name="grau" id="">
                    <option value="basico">Básico</option>
                    <option value="intermediario">Intermediário</option>
                    <option value="avancado">Avançado</option>
                </select>
            </label><br>

            <label for="descricao">Descrição:<br> 
                <textarea name="descricao" id="" cols="50" rows="4"></textarea>
            </label><br>

            <button type="submit" class="btn-submit">Adicionar Curso</button>
        </form>
       </div>
    </div>
</body>
</html>