<?php

require_once '../../classes/curso.php';
//Instaciar classe cursd
$c = new Curso();

if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['carga']) && isset($_POST['grau'])
&& isset($_FILES['imagem'])){

    $nomeCurso = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $carga = $_POST['carga'];
    $grau = $_POST['grau'];
    $icone = $_FILES['imagem'];

     //Pegar a extensão da imagem
     $extensao = substr($icone['name'], -4);
     //Atribuir um novo nome
     $novo_nome = date("Y.m.d. -H.i.s").$extensao;
     //diretório
     $diretorio = '../img_cursos/';
     //Mover para o diretório com o novo nome
     move_uploaded_file($icone['tmp_name'], $diretorio.$novo_nome);

     $c->validarCurso($nomeCurso, $descricao, $grau, $carga, $novo_nome);
}



?>