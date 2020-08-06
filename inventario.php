<?php
$activo1='dark';
$activo2='dark';
$activo3='dark';
$activo4='dark';
$activo5='danger';
$activo6='dark';
$titulo='Inventario';
require('template1.php');
?>
    <!-- form -->
    <div class="container  mt-3">
        <div class="row">
            <input id="cant" value=1 type="number" class="col-sm-1 form-control-lg" placeholder="Cantidad">
            <input id="prod" type="text" class="col-sm-3 form-control-lg" placeholder="Producto">
            <input id="marc" type="text" class="col form-control-lg" placeholder="Marca">
            <input id="peso" type="text" class="col form-control-lg" placeholder="Peso">
            <input id="prec" type="number" class="col-sm-2 form-control-lg" placeholder="Precio">
            <input id="divi" type="text" class="col-sm-2 form-control-lg" placeholder="$">
            <button id="inse" class="btn btn-danger col-sm-1 form-control-lg"><h5>+</h5></button>
        </div>
        <div class="row mt-2">
        </div>
    </div>
    <!-- list -->
    <div class="container mt-3">
            <!-- <div class="col"> -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Peso</th>
                    <th>Precio</th>
                    <th>Divisa</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla">
                <!-- ajax actua aqui -->
            </tbody>
        </table>
    </div>
    <!-- script -->
    <script src="js/AjaxInsert.js"></script>
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<?php require('template2.php'); ?>