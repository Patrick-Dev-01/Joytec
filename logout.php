<?php

require_once 'classes/aluno.php';
session_start();

$aluno = new Aluno();

$aluno->logout();

?>