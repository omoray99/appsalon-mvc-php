let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

// inicializar el proyecto 

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // consulta la API en el backend de php

    nombreCliente(); // añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto

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
            //e.defaultPrevented();
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();
            
        });
    });
    
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3){
        paginaSiguiente.classList.add('ocultar');
        paginaAnterior.classList.remove('ocultar');
    } else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}
function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;

        paso-- ;

        botonesPaginador();
        
    })
}
function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++ ;

        botonesPaginador();
        
    })
}
async function consultarAPI(){

    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        mostrarServicios(servicios);
        
        
    } catch (error) {
        console.log(error);
        
    }

}
function mostrarServicios(servicios){
    servicios.forEach ( servicio => {     // para ir iterando por cada uno de los servicios
        const {id, nombre, precio} = servicio;
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;
        
        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `Gs. ${precio}` ;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv); //se busca en index de cita en paso-1 y el id de servicios
    });             
}
function seleccionarServicio(servicio){
    const { id } = servicio; // cuando doy click estoy pasando el objeto completo
    const { servicios } = cita; // es el objeto que tiene la informacion de cita, el arreglo vacio
    // identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // comprobar si un servicio ya fue agregado o quitado
    if ( servicios.some( agregado => agregado.id === servicio.id ) ){  // agregado es lo que esta en memoria y servicio.id es el que estoy dando click en el interface de usuario
        // eliminarlo
        cita.servicios = servicios.filter( agregado => agregado.id !== id );  // nos va a permitir sacar un elemento basado en cierta condicion 
        divServicio.classList.remove('seleccionado');
        
    }else{
         // agregarlo
         cita.servicios = [...servicios, servicio];
         divServicio.classList.add('seleccionado');

    }
    
    console.log(cita);
}
function nombreCliente(){
    const nombre =  document.querySelector('#nombre').value;
    cita.nombre = nombre;

    console.log(nombre);
}

function seleccionarFecha(){
    const inputFecha = document.querySelector("#fecha");
    inputFecha.addEventListener('input', function(e){
        
        const dia = new Date(e.target.value).getUTCDay();
        
        if([6,0].includes(dia)){
            e.target.value = '';
            mostrarAlerta();
        }else{
            cita.fecha = e.target.value;
        }  
    });
}