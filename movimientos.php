<?php
$activo1='dark';
$activo2='danger';
$activo3='dark';
$activo4='dark';
$activo5='dark';
$activo6='dark';
$titulo='Movimientos';
require('template1.php');
?>
    <!-- lista -->
    <div class="container mt-3">
      <div class="row">
        <h4 class='col-4 h4'>Buscar</h4>
        <input id="buscarCliente" class='col-4 form-control' type="search" placeholder='Cliente' list="sugerencias">
        <datalist id='sugerencias'></datalist>
      </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                      <tr>
                        <th>N</th>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Monto</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Pago</th>
                        <th>Tipo</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla" >
                     
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <!-- script -->
    <script src="js/ajaxMovimientos.js"></script>
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<?php require('template2.php') ?>