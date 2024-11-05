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
    console.log(botones);
    
}