let tipoPago = document.getElementById('tipoPago')
let formPago = document.getElementById('formPago')
let referencia = document.getElementById('referencia')
let numeroFactura = document.getElementById('numeroFactura')
// ajax numero factura
document.getElementById('numeroFactura').addEventListener('keyup',ajax)
window.addEventListener('load',ajax)
// ajaxx busqueda factura
function ajax() {
    {
        const data = new URLSearchParams(`peticion=buscarFactura&nFactura=${numeroFactura.value}`)
        let objeto = {
            method:'post',
            body:data
        }
        fetch("controller.php",objeto)
        .then(Response=>{
            return Response.json()
        }).then(json=>{
            let template=``
            json.forEach(row => {
                template +=`<tr>`
                template +=`<td>${row.cantidad}</td>`
                template +=`<td>${row.producto}</td>`
                template +=`<td>${row.precio}</td>`
                template +=`</tr>`
            })
            document.getElementById('cuerpoTabla').innerHTML=template
            document.getElementById('templateCliente').innerHTML="Cliente: "+json[0]['cliente']
            document.getElementById('templateMonto').innerHTML="Monto total: "+json[0]['total']
            // console.log(json)
        }).catch(error=>{
            console.log(error)
        })
        
        if (numeroFactura.value.length<1) {
            document.getElementById('tabla').hidden=true
            document.getElementById('templateMonto').hidden=true
            document.getElementById('templateCliente').hidden=true
            document.getElementById('formPago').hidden=true
        }else{
            document.getElementById('tabla').hidden=false
            document.getElementById('templateMonto').hidden=false
            document.getElementById('templateCliente').hidden=false
            document.getElementById('formPago').hidden=false

        }
        document.getElementById('numFactura').value=numeroFactura.value
    }
}
// visibilidad de numero de referencia
tipoPago.addEventListener('mouseout',()=>{
    if (tipoPago.value!="Pago Movil" && referencia.hidden==false) {
        referencia.hidden=true
    }else if(tipoPago.value=="Pago Movil" && referencia.hidden==true){
        referencia.hidden=false
    }
})