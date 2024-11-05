let paso = 1;

// inicializar el proyecto 

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    
    tabs(); // Cambia la seccion cuando se presionen los tabs
}

function mostrarSeccion(){
    // Seleccionar la seccion con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector)
    
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