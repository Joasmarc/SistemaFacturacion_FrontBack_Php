<?php
$activo1='dark';
$activo2='dark';
$activo3='dark';
$activo4='danger';
$activo5='dark';
$activo6='dark';
$titulo='Pagos';
require('template1.php');

if (isset($_GET['nFactura'])) {
    $nFactura = $_GET['nFactura'];
}

?>

    <div class="container mt-4">

        <div action="" method="post" class="row">
            <h6 class="col-4">Numero de Compra</h6>
            <input id='numeroFactura' type="number" class="form-control col-4" value="<?= $nFactura ?>">
        </div>
        <div class='row mt-3'>
            <h5 class='col-6' id='templateCliente'></h5>
            <h5 class='col-6' id='templateMonto'></h5>
        </div>
        <table id="tabla" class="table mt-3">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla">
                
            </tbody>
        </table>
        <form id="formPago" class='row' action="controller.php" method="post">
            <h6 class="col-12">Tipo de pago</h6>
            <select class="form-control col-12" name="tipoPago" id="tipoPago">
                <option value="Pago Movil">Pago Movil</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Pendiente">Pendiente</option>
            </select>
            <input type="number" id="referencia" name="numReferencia" class="form-control col-12 mt-2" placeholder='Numero de Referencia'>
            <input type="number" id="numFactura" name="numFactura" hidden>
            <input type="submit" value="Pagar" class="btn btn-danger col-12 mt-2" name='peticion'>
        </form>

    </div>
    <!-- script -->
    <script src="js/pagos.js"></script>
<?php require('template2.php') ?>