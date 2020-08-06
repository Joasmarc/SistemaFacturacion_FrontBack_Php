<?php
if (isset($_GET['msj'])) {
    echo $_GET['msj'];
}
$activo1='danger';
$activo2='dark';
$activo3='dark';
$activo4='dark';
$activo5='dark';
$activo6='dark';
$titulo='Inicio';
require('template1.php');
?>
    <center class='container mt-5 shadow-lg'>
        <h1 class='h1 text-danger'>Bienvenidos!!!</h1>
        <img clas="row" src="logo joa.png" height="150" width="600">
    </center>

<?php require('template2.php'); ?>