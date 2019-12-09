<?php

require_once '../../classes/admin.php';

$admin = new Administrador();

$resposta = $_POST['resposta'];
$id_duvida = $_POST['id_d'];
$id_admin = $_POST['id_admin'];

$admin->respostaAdmin($resposta, $id_duvida, $id_admin);
?>