<?php

require_once '../../classes/admin.php';
$admin = new Administrador();

if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['senha']) && isset($_POST['email'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    $admin->validarAdmin($nome, $sobrenome, $senha, $email);
}

?>