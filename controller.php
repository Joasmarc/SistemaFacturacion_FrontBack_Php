<?php
// conexion
$conexion = new mysqli("localhost","root","","mercado");
// Insertar Inventario
if(isset($_POST['peticion']) && $_POST['peticion']=='insertar'){
    $cantidad=$_POST['cant'];
    $producto=$_POST['prod'];
    $marca=$_POST['marc'];
    $peso=$_POST['peso'];
    $precio=$_POST['prec'];
    $precioDivisa=$_POST['divi'];
    $nombreCompleto = $producto." ".$marca." de ".$peso;
    $query = "INSERT INTO inventario(cantidad,producto,marca,peso,precio,precioDivisa,NombreCompleto)VALUES('$cantidad','$producto','$marca','$peso','$precio','$precioDivisa','$nombreCompleto')";
    if($conexion->query($query)){
        echo "INSERTADO CON EXITO!!!";
    }else{
        echo "OCURRIO UN  ERROR!!!";
    }
}
// Leer Inventario
if (isset($_POST[ 'peticion']) && $_POST['peticion']=='leer') {
    $query = "SELECT * FROM inventario";
    $result = $conexion->query($query);
    while ($row = $result->fetch_assoc()) {
        $array[]=[
            'id'=>$row['id'],
            'cantidad'=>$row['cantidad'],
            'producto'=>$row['producto'],
            'marca'=>$row['marca'],
            'peso'=>$row['peso'],
            'precio'=>$row['precio'],
            'divi'=>$row['precioDivisa'],
            'fecha'=>$row['fecha']
        ];
    }
    $json = json_encode($array);
    echo $json;
}
// Buscar Inventario
if (isset($_POST['peticion']) && $_POST['peticion']=='buscar') {
    // obtener valor
    $valor = $_POST['valor'];
    // redactar peticion
    $query = "SELECT * FROM inventario WHERE NombreCompleto LIKE'%$valor%'";
    // ejecutar peticion
    $result = $conexion->query($query);
    // rellenar una array con pocos resultados
    for ($i=0; $i <= 4; $i++) { 
        $row = $result->fetch_assoc();
        $array[]=[
            'nombreCompleto'=>$row['NombreCompleto'],
            'precio'=>$row['precio']
        ];
    }
    // convertir array en json
    $json = json_encode($array);
    // devolver datos json
    echo $json;
}
// buscar cliente
if(isset($_POST['peticion']) && $_POST['peticion']=='cliente'){
    $valor=$_POST['valor'];

    $query = "SELECT * FROM clientes WHERE nombre LIKE'%$valor%'";
    $result = $conexion->query($query);
    
    for ($i=0; $i<=4; $i++) { 
        $row=$result->fetch_assoc();
        $array[]=[
            'nombre'=>$row['nombre']
        ];
    }

    $json = json_encode($array);
    echo $json;
}
// facturacion
if (isset($_POST['facturacion'])) {
    $nFactura = $_POST['nFactura'];
    $cliente = $_POST['cliente'];
    $contador = $_POST['contador'];
    $total = $_POST['total'];
    $status = 'Insolvente';

    // echo "la factura $nFactura es de $cliente de $total con contador total:$contador";
    // echo "<br>";

    for ($i=0 ; $i<=$contador ; $i++) { 
        // armarArray
        // $arrayProducto['cantidad']=$_POST["cant$i"];
        // $arrayProducto['producto']=$_POST["producto$i"];
        // $arrayProducto['monto']=$_POST["precio$i"];
        $query="INSERT INTO movimientos(cantidad,producto,precio,cliente,nCompra,totalCompra,pago) values('{$_POST["cant$i"]}','{$_POST["producto$i"]}','{$_POST["precio$i"]}','$cliente','$nFactura','$total','$status')";
        // $conexion->query($query);
        $conexion->query($query);
        $query2="SELECT cantidad from inventario where Nombrecompleto = '{$_POST["producto$i"]}'";
        // $result = $conexion->query($query2)->fetch_assoc();
        $result = $conexion->query($query2)->fetch_assoc();
        // $registro = $result['cantidad']-$_POST["cant$i"];
        $registro = $result['cantidad']-$_POST["cant$i"];
        $query3="UPDATE inventario set cantidad='$registro' where Nombrecompleto ='{$_POST["producto$i"]}'";
        // $conexion->query($query3);
        $conexion->query($query3);
    }

    // insertar facturas
    $query="INSERT into facturas(id,cliente,monto,estado)values('$nFactura','$cliente','$total','$status')";
    // $conexion->query($query);
    $conexion->query($query);

    $query2="SELECT * FROM clientes WHERE nombre='$cliente'";
    if ($conexion->query($query2)->num_rows==0) {
        $query3="INSERT INTO clientes(nombre)VALUES('$cliente')";
        $conexion->query($query3);
    }

    header("location:pagos.php?nFactura=$nFactura");
}
// buscar factura
if (isset($_POST['peticion']) && $_POST['peticion']=="buscarFactura") {
    $query = "SELECT * from movimientos where nCompra={$_POST['nFactura']}";
    $result = $conexion->query($query);
    while ($row=$result->fetch_assoc()) {
        $array[]=[
            'cantidad'=>$row['cantidad'],
            'producto'=>$row['producto'],
            'precio'=>$row['precio'],
            'cliente'=>$row['cliente'],
            'total'=>$row['totalCompra']
        ];
    }
    $json = json_encode($array);
    echo $json;
}
// numero factura
if(isset($_POST['peticion']) && $_POST['peticion'] == 'factura'){
    $query = "SELECT * from facturas";
    $result = $conexion->query($query)->num_rows;
    echo $result+1;
}
// vincular pagos
if (isset($_POST['peticion']) && $_POST['peticion']=='Pagar') {
    $tipoPago = $_POST['tipoPago'];
    $numFactura = $_POST['numFactura'];
    if ($tipoPago == 'Pago Movil') {
        $numReferencia = $_POST['numReferencia'];
        $query1="UPDATE movimientos set pago='Revisar',tipo='$numReferencia' where nCompra=$numFactura";
        $query2="UPDATE facturas set estado='Revisar',tipo='$numReferencia' where id=$numFactura";
        $conexion->query($query1);
        $conexion->query($query2);
        header('location:movimientos.php');
    }else if($tipoPago == 'Efectivo'){
        $query1="UPDATE movimientos set pago='Solvente',tipo='Efectivo' where nCompra=$numFactura";
        $query2="UPDATE facturas set estado='Solvente',tipo='Efectivo' where id=$numFactura";
        $conexion->query($query1);
        $conexion->query($query2);
        header('location:movimientos.php');
    }else{
        header('location:movimientos.php');
    }
}
// leer movimientos
if (isset($_POST['peticion']) && $_POST['peticion']=='leerMovimientos') {
    $query = "SELECT * from movimientos order by id desc";
    $result=$conexion->query($query);
    while($row=$result->fetch_assoc()){
        $array[]=[
            'cantidad'=>$row['cantidad'],
            'producto'=>$row['producto'],
            'precio'=>$row['precio'],
            'cliente'=>$row['cliente'],
            'nCompra'=>$row['nCompra'],
            'fecha'=>$row['fecha'],
            'totalCompra'=>$row['totalCompra'],
            'pago'=>$row['pago'],
            'tipo'=>$row['tipo']
        ];
    }
    $json = json_encode($array);
    echo $json;
}
// buscar movimientos
if (isset($_POST['peticion']) && $_POST['peticion']=='buscarMovimientos') {
    $valor = $_POST['valor'];
    $query = "SELECT * FROM movimientos WHERE cliente like '%$valor%' order by id DESC";
    $result=$conexion->query($query);
    while($row=$result->fetch_assoc()){
        $array[]=[
            'cantidad'=>$row['cantidad'],
            'producto'=>$row['producto'],
            'precio'=>$row['precio'],
            'cliente'=>$row['cliente'],
            'nCompra'=>$row['nCompra'],
            'fecha'=>$row['fecha'],
            'totalCompra'=>$row['totalCompra'],
            'pago'=>$row['pago'],
            'tipo'=>$row['tipo']
        ];
    }
    $json = json_encode($array);
    echo $json;
}
?>