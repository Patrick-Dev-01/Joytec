<?php

require_once '../classes/aluno.php';

if(isset($_POST['cpf']) && isset($_POST['senha'])){
    
    $aluno = new Aluno();

    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $aluno->login($cpf, $senha);
}

?>