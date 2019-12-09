<?php

require_once '../classes/aluno.php';

$aluno = new Aluno();

if(isset($_POST['rg']) && isset($_POST['cpf']) && isset($_POST['nome']) && isset($_POST['sobrenome']) 
&& isset($_POST['nascimento']) && isset($_POST['senha']) && isset($_POST['email'])){

$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$dt_nascimento = $_POST['nascimento'];
$senha = $_POST['senha'];
$email = $_POST['email'];

$aluno->validar($rg, $cpf, $nome, $sobrenome, $dt_nascimento, $senha, $email);

}

?>