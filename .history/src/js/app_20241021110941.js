let paso = 1;

// inicializar el proyecto 

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    
    tabs(); // Cambia la seccion cuando se presionen los tabs
}
function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    
    botones.forEach( boton =>{ 
        boton.addEventListener('click', function(e){ //e -> el evento que se va a registrar
            console.log( typeof e.target.dataset.paso);
            
        });
    });
    
}