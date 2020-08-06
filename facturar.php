<?php
$activo1='dark';
$activo2='dark';
$activo3='danger';
$activo4='dark';
$activo5='dark';
$activo6='dark';
$titulo='Facturar';
require('template1.php');
?>
    <!-- form -->
    <!-- cliente y monto -->
    <form action="controller.php" method='post'>
    <div class="container my-3">
        <div class="row my-2">
            <input id='factura' name='nFactura' type="text" class="col-2 form-control" readonly='readonly'>
            <input id='cliente' name='cliente' list="sugerencias2" type="search" class="form-control col-6" placeholder="Cliente">
            <input id='contador' name='contador' type="number" hidden>
            <input id='total' name='total' type="text" class="form-control col-4" placeholder="Monto Total" readonly='readonly'>
            <datalist id="sugerencias2"></datalist>
        </div>
    </div>
    <!-- fila de producto -->
    <div class="container my-3">
        <div id='padre' class="row my-2">
            <input id="boxCant" value=1 type="number" class="col-2 form-control" placeholder="Cantidad">
            <input id="btnCant" type="button" value="+" class="btn btn-dark col-1 mx-2">
            <input id="producto" list="sugerencias" type="search" class="col-5 form-control" placeholder="Producto">
            <input id="precio" type="text" class="col-3 form-control" placeholder="Precio">
            <datalist id="sugerencias"><datalist>
        </div>
    </div>
    <!-- fila de botones -->
    <div class="container">
        <div class="row my-2">
            <input id="btnCrear" class="btn btn-dark col" type="button" value="Agregar">
        </div>
    </div>
    <!-- productos agregados -->
    <!-- <form action="controller.php" method='post'> -->
        <div id='agregados' class="container my-3">
        </div>
        <div class="container">
            <input name='facturacion' id="facturacion" type="submit" class="btn btn-danger col" value="Facturar">
        </div>
    </form>
    <!-- script -->
    <script src="js/AjaxFacturar.js"></script>
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<?php require('template2.php') ?>