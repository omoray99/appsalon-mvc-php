let paso = 1;

// inicializar el proyecto 

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
}

function mostrarSeccion(){

    // ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la seccion con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }
    
    // Resalta el tab anterior
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    
    botones.forEach( boton =>{ 
        boton.addEventListener('click', function(e){ //e -> el evento que se va a registrar
            //console.log(parseInt(e.target.dataset.paso) );
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();
            
        });
    });
    
}