<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<!-- nav -->
<div class="container mt-2">
    <div class="row d-flex justify-content-around">
        <!-- <div class="col d-flex justify-content-around"> -->
            <a href="./index.php"><button class="col btn mt-2 btn-outline-<?= $activo1 ?> active">Inicio</button></a>
            <a href="./movimientos.php"><button class="col mt-2 btn btn-outline-<?= $activo2 ?> active">Movimientos</button></a>
            <a href="./facturar.php"><button class="col mt-2 btn btn-outline-<?= $activo3 ?> active">Facturar</button></a>
            <a href="./pagos.php"><button class="col mt-2 btn btn-outline-<?= $activo4 ?> active">Pagos</button></a>
            <a href="./inventario.php"><button class="col mt-2 btn btn-outline-<?= $activo5 ?> active">inventario</button></a>
            <a href="#"><button class="col mt-2 btn btn-outline-<?= $activo6 ?> active">Buscar</button></a>
        <!-- </div> -->
    </div>
</div>