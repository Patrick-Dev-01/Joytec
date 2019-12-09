<?php

require_once '../classes/aluno.php';
session_start();
$a = new Aluno();

$id_aluno = $_POST['id'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

$a->enviarDuvida($titulo, $descricao, $id_aluno);


?>