<?php

require_once '../../classes/curso.php';
$c = new Curso();

if(isset($_POST['id_c']) && isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['carga']) && isset($_POST['grau'])
&& isset($_FILES['imagem'])){

    $id_curso = $_POST['id_c'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $carga = $_POST['carga'];
    $grau = $_POST['grau'];
    $icone = $_FILES['imagem'];

    if(isset($icone)){
        //Pegar a extensão da imagem
        $extensao = substr($icone['name'], -4);
        //Atribuir um novo nome
        $novo_nome = date("Y.m.d. -H.i.s").$extensao;
        //diretório
        $diretorio = '../img_cursos/';
        //Mover para o diretório com o novo nome
        move_uploaded_file($icone['tmp_name'], $diretorio.$novo_nome);
    }

    $c->validarEdicao($id_curso, $nome, $descricao, $carga, $grau, $icone);
}

?>