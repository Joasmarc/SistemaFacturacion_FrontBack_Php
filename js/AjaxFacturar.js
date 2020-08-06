let btnCant=document.getElementById('btnCant')
btnCant.onclick=aumentar
let producto = document.getElementById('producto')
producto.onkeyup=asincronus
let btnAdd=document.getElementById('btnCrear')
btnAdd.onclick=agregar
let contador=0
let total=0
let cliente = document.getElementById('cliente')
cliente.onkeyup=asincronus2
// iniciar en primera casilla
window.addEventListener('load',()=>{
    document.getElementById('cliente').select()

    const data = new URLSearchParams("peticion=factura")
    var objeto = {
        method:'POST',
        body:data
    }

    fetch('controller.php',objeto)
    .then(response=>{
        return response.text()
    }).then(text=>{
        document.getElementById('factura').value=text
    }).catch(error=>{
        console.log(error)
    })
})
// aumentar cantidad de producto
function aumentar(){
    document.getElementById('boxCant').value++
}
// ajax autocompletado
function asincronus(e){
    // direccion del servidor
    var url = 'controller.php';
    // datos
    var peticion = 'buscar';
    var valor = document.getElementById('producto').value;
    // construir variable datos
    const data = new URLSearchParams(`valor=${valor}&peticion=${peticion}`);
    // armar objeto con method header body para fetch
    var objeto = {
    method: 'POST',
    body: data
    }
    // funcion fetch
    fetch(url , objeto)
    .then(Response=> {
    // depende de que datos esperamos .tex() para texto o .json() para json
    return Response.json()
    }).then(json=>{
        let sugerencias
        json.forEach(row => {
            // console.log(row)
            sugerencias += `<option value='${row.nombreCompleto}'>`
        })
        document.getElementById('sugerencias').innerHTML=sugerencias
        document.getElementById('precio').value=json[0]['precio']
    }).catch(err=> {
    console.log(err)
    })
    if (e.keyCode ==13) {
        agregar()
    }
}
// ajax agregar a factura
function agregar(){
    let productoSelect=document.getElementById("producto")
    let cantSelect=document.getElementById("boxCant")
    let precioSelect=document.getElementById("precio")
    let totalSelect = document.getElementById('total')

    if (productoSelect.value==""||cantSelect.value==""||precioSelect.value==""){
        alert('Faltan Datos!!!')
    }else{
        let padre = document.getElementById('agregados')

        let fila = document.createElement('div')
        fila.className='row'
        fila.id='fila'+contador

        let cant = document.createElement('input')
        cant.type='number'
        cant.readOnly="readOnly"
        cant.className='col-1 form-control'
        cant.id='cant'+contador
        cant.name='cant'+contador
        cant.value=cantSelect.value

        let producto = document.createElement('input')
        producto.type='text'
        producto.name='producto'+contador
        producto.readOnly="readOnly"
        producto.className='col-6 form-control'
        producto.value=productoSelect.value

        let precio = document.createElement('input')
        precio.type='number'
        precio.readOnly="readOnly"
        precio.className='col-3 form-control'
        precio.id='precio'+contador
        precio.name='precio'+contador
        precio.value=precioSelect.value

        // let cliente = document.createElement('input')
        // cliente.type= 'text'
        // cliente.value=document.getElementById('cliente').value
        // cliente.name='cliente'
        // cliente.hidden=true

        let boxContador = document.createElement('input')
        boxContador.type='text'
        boxContador.value=contador
        boxContador.name='contador'
        boxContador.hidden=true

        let eliminar = document.createElement('input')
        eliminar.type='button'
        eliminar.value="X"
        eliminar.className='btn btn-danger col-2'
        eliminar.onclick=eliminacion

        padre.appendChild(fila)
        fila.appendChild(cant)
        fila.appendChild(producto)
        fila.appendChild(precio)
        fila.appendChild(eliminar)
        // fila.appendChild(cliente)
        fila.appendChild(boxContador)

        total += Number(cantSelect.value)*Number(precioSelect.value)

        document.getElementById('boxCant').value="1"
        document.getElementById('producto').value=""
        document.getElementById('precio').value=""

        function eliminacion(){
            objetivo = document.getElementById(fila.id)
            total -=Number(document.getElementById(cant.id).value)*Number(document.getElementById(precio.id).value)
            padre.removeChild(objetivo)
            totalSelect.value=total
            contador--
        }

        document.getElementById('contador').value=contador
        contador++
        totalSelect.value=total
    }
}
// ajax cliente
function asincronus2(e){
    let url = 'controller.php'
    let peticion = 'cliente'
    let valor = document.getElementById('cliente').value
    const data = new URLSearchParams(`valor=${valor}&peticion=${peticion}`)
    let objeto = {
        method:'post',
        body:data
    }
    fetch(url,objeto)
    .then(response=>{
        return response.json()
    }).then(json=>{
        // console.log(json)
        let sugerencias
        json.forEach(row=>{
            sugerencias += `<option value='${row.nombre}'>`
            document.getElementById('sugerencias2').innerHTML=sugerencias
        })
    })
    if (e.keyCode ==13) {
        document.getElementById('producto').select()
    }
}