<?php

require_once '../../classes/curso.php';
$c = new Curso();

if(isset($_GET['id_c'])){
    $id_c = $_GET['id_c'];

    $c->deleteCurso($id_c);
}

?>