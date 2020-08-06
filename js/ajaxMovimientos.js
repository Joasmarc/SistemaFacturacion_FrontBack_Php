window.addEventListener('load',leerAjax)
// leer lista
function leerAjax(){
    const data = new URLSearchParams("peticion=leerMovimientos");
    let objeto = {
        method:'POST',
        body:data
    }
    fetch("controller.php",objeto)
    .then(Response=>{
        return Response.json()
    }).then(json=>{
        let body = ``
        json.forEach(row=>{
            body+=`<tr>`
            body+=`<th class="bg-primary">${row.nCompra}</th>`
            body+=`<th>${row.cantidad}</th>`
            body+=`<td>${row.producto}</td>`
            body+=`<td>${row.precio}</td>`
            body+=`<td>${row.cliente}</td>`
            body+=`<td>${row.fecha}</td>`
            body+=`<td>${row.totalCompra}</td>`
            // body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-success">${row.pago}</button></a></th>`
            if (row.pago=="Solvente") body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-success">${row.pago}</button></a></th>`
            if (row.pago=="Insolvente") body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-danger">${row.pago}</button></a></th>`
            if (row.pago=="Revisar") body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-warning">${row.pago}</button></a></th>`
            // if (row.pago=="Solvente") body+=`<td class="bg-success">${row.pago}</td>`
            // else if (row.pago=="Insolvente") body+=`<td class="bg-danger">${row.pago}</td>`
            // else if (row.pago=="Revisar") body+=`<td class="bg-warning">${row.pago}</td>`
            body+=`<td>${row.tipo}</td>`
            body+=`</tr>`
            document.getElementById('cuerpoTabla').innerHTML=body
        })
    }).catch(error=>{
        console.log(error)
    })
}
// buscar cliente
let valorCliente = document.getElementById('buscarCliente')

valorCliente.addEventListener('keyup',buscarCliente)
valorCliente.addEventListener('click',buscarCliente)

function buscarCliente() {
    
    if (valorCliente.value.length > 0) {
        document.getElementById('cuerpoTabla').innerHTML='Buscando...'

        const data = new URLSearchParams(`peticion=buscarMovimientos&valor=${document.getElementById('buscarCliente').value}`)
        let objeto = {
            method:'POST',
            body:data
        }
        fetch("controller.php",objeto)
        .then(Response=>{
            return Response.json()
        }).then(json=>{
            let body = ``
            json.forEach(row=>{
                body+=`<tr>`
                body+=`<th class="bg-primary">${row.nCompra}</th>`
                body+=`<th>${row.cantidad}</th>`
                body+=`<td>${row.producto}</td>`
                body+=`<td>${row.precio}</td>`
                body+=`<td>${row.cliente}</td>`
                body+=`<td>${row.fecha}</td>`
                body+=`<td>${row.totalCompra}</td>`
                if (row.pago=="Solvente") body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-success">${row.pago}</button></a></th>`
                if (row.pago=="Insolvente") body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-danger">${row.pago}</button></a></th>`
                if (row.pago=="Revisar") body+=`<th><a href="pagos.php?nFactura=${row.nCompra}"><button class="btn btn-warning">${row.pago}</button></a></th>`
                body+=`<td>${row.tipo}</td>`
                body+=`</tr>`
                document.getElementById('cuerpoTabla').innerHTML=body
            })
        }).catch(error=>{
            console.log(error)
        })

    }else if(valorCliente.value.length == 0){
        leerAjax()
    }
}