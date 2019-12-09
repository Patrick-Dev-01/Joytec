<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css_admin/partials_admin/menu_admin.css">
    <link rel="stylesheet" href="css_admin/edit_curso.css">
    <script src="js_admin/preview.js"></script>
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
            $c_id = $_GET['id'];
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

    <div class="corpo">
        <h2 id="title">Alterar Dados do Curso</h2>
        <hr>
        <?php
             $c->dadosCurso($c_id);
        ?>
        <form action="models/update_curso.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_c" value="<?php echo($c_id)?>">
            <span id="icone"><label for="imagem">Icone (Opcional):
                <input type="file" name="imagem" id="cIcone" accept="image/*" onchange="previewIcone();" disabled><br>
                <img style="width: 250px; height: 150px;" alt="" id="preview">
            </label></span>

            <label for="nome">Nome: <br>
                <input type="text" name="nome" value="<?php echo($c->getNome())?>">
            </label><br>

            <label for="carga">Carga Horária: <br> 
                <input type="number" name="carga" id="" min="0" value="<?php echo($c->getCarga())?>">
            </label><br>

            <label for="grau">Grau: <br>
                <select name="grau" id=""><br>
                    <option value="basico">Básico</option>
                    <option value="intermediario">Intermediário</option>
                    <option value="avancado">Avançado</option>
                </select>
            </label><br>

            <label for="descricao">Descrição: <br>
                <textarea name="descricao" id="" cols="47" rows="4"><?php echo($c->getDescricao())?></textarea>
            </label><br>

            <button type="submit" id="btn-alterar">Atualizar Curso</button>
        </form>
    </div>
</body>
</html>