<?php

require_once '../classes/aluno.php';

$a = new Aluno();

$idaluno = $_POST['id_a'];
$idcurso = $_POST['id_c'];
$data = $_POST['inicio'];

$a->inscreverCurso($idaluno, $idcurso, $data);

?>