<?php

require_once '../../classes/admin.php';
session_start();

$admin = new Administrador();

$admin->logoutAdmin();

?>