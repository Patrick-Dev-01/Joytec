<?php

require_once '../classes/aluno.php';

$a = new Aluno();

$id_curso = $_GET['id_c'];
$id_aluno = $_GET['id_a'];

$a->cancelarInscricao($id_curso, $id_aluno);
?>