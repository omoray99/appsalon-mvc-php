document.addEventListener('DOMContentLoaded', function() {

    iniciarApp();

}); 

function iniciarApp() {
    buscarPorFecha();
}

function buscarPorFecha(){
    const fechaImput = document.querySelector('#fecha');
    fechaImput.addEventListener('input', function(e){ // callback que se va a ejecutar una vez que suceda ese evento
        const fechaSeleccionada = e.target.value;
        console.log(fechaSeleccionada);
        

    });
    
}
