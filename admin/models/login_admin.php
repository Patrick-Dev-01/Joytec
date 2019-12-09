<?php

require_once '../../classes/admin.php';
$admin = new Administrador();

if(isset($_POST['email']) && isset($_POST['senha'])){
    //Addslashes para evitar SQL Injection
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $admin->loginAdmin($email, $senha);
}

?>