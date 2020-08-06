document.getElementById("inse").addEventListener("click",insertar)
window.addEventListener('load',leer)
window.addEventListener('load',()=>{
    document.getElementById('cant').select()
})
document.getElementById('cant').onkeyup=avanzar1
document.getElementById('prod').onkeyup=avanzar2
document.getElementById('marc').onkeyup=avanzar3
document.getElementById('peso').onkeyup=avanzar4
document.getElementById('prec').onkeyup=avanzar5
document.getElementById('divi').onkeyup=avanzar6
// leer
function leer(){
    let url = 'controller.php';
    let data = new URLSearchParams(`peticion=leer`)
    let objeto = {
        method: 'POST',
        body: data
    }
    fetch(url, objeto)
    .then(Response=> {
        return Response.json()
    }).then(json=>{
        let template=``
        json.forEach(row => {
            template +=`<tr>`
            template +=`<td>${row.id}</td>`
            template +=`<td>${row.cantidad}</td>`
            template +=`<td>${row.producto}</td>`
            template +=`<td>${row.marca}</td>`
            template +=`<td>${row.peso}</td>`
            template +=`<td>${row.precio}</td>`
            template +=`<td>${row.divi}</td>`
            template +=`<td>${row.fecha}</td>`
            template +=`</tr>`
        })
        document.getElementById('cuerpoTabla').innerHTML=template
    }).catch(errr=> {
        console.log(errr);
    })
}
// insertar
function insertar(){
    let cant = document.getElementById("cant").value
    let prod0 = document.getElementById("prod").value
    let prod = prod0[0].toUpperCase() + prod0.slice(1).toLowerCase()
    let marc0 = document.getElementById("marc").value
    let marc = marc0[0].toUpperCase() + marc0.slice(1).toLowerCase()
    let peso0 = document.getElementById("peso").value
    let peso = peso0.toUpperCase()
    let prec = document.getElementById("prec").value
    let divi = document.getElementById("divi").value

    let url = 'controller.php';
    let data = new URLSearchParams(`peticion=insertar&cant=${cant}&prod=${prod}&marc=${marc}&peso=${peso}&prec=${prec}&divi=${divi}`)
    let objeto = {
        method: 'POST',
        body: data
    }

    fetch(url, objeto)
    .then(Response2=> {
        return Response2.text()
    }).then(text=>{
        alert(text)
        leer()
        limpiar()
    }).catch(err=> {
        console.log(err)
    })
}
// Limpiar 
function limpiar(){
    document.getElementById("cant").value=""
    document.getElementById("prod").value=""
    document.getElementById("marc").value=""
    document.getElementById("peso").value=""
    document.getElementById("prec").value=""
    document.getElementById("divi").value=""
}
// avanzar1
function avanzar1(e){
    if (e.keyCode ==13) {
        document.getElementById('prod').select()
    }
}
// avanzar2
function avanzar2(e){
    if (e.keyCode ==13) {
        document.getElementById('marc').select()
    }
}
// avanzar3
function avanzar3(e){
    if (e.keyCode ==13) {
        document.getElementById('peso').select()
    }
}
// avanzar4
function avanzar4(e){
    if (e.keyCode ==13) {
        document.getElementById('prec').select()
    }
}
// avanzar5
function avanzar5(e){
    if (e.keyCode ==13) {
        document.getElementById('divi').select()
    }
}
// avanzar6
function avanzar6(e){
    if (e.keyCode ==13) {
        insertar()
        document.getElementById('cant').select()
    }
}