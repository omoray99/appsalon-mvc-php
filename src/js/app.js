let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

// inicializar el proyecto 

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // consulta la API en el backend de php

    idCliente();
    nombreCliente(); // añade el nombre del cliente al objeto de cita
    seleccionarFecha(); // Añade la fecha de la cita en el objeto
    seleccionarHora(); // Añade la hora de la cita en el objeto

    mostrarResumen(); // Muestra el resumen de la cita

}

function mostrarSeccion() {

    // ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la seccion con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab anterior
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function (e) { //e -> el evento que se va a registrar
            //console.log(parseInt(e.target.dataset.paso) );
            //e.defaultPrevented();
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();

        });
    });

}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        //paginaSiguiente.classList.remove('ocultar');
        //paginaAnterior.classList.add('ocultar');

        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen();
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}
function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {
        if (paso <= pasoInicial) return;

        paso--;

        botonesPaginador();

    })
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {
        if (paso >= pasoFinal) return;
        paso++;

        botonesPaginador();

    })
}
async function consultarAPI() {

    try {
        const url = '/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        mostrarServicios(servicios);


    } catch (error) {
        console.log(error);

    }

}
function mostrarServicios(servicios) {
    servicios.forEach(servicio => {     // para ir iterando por cada uno de los servicios
        const { id, nombre, precio } = servicio;
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `Gs. ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }
        

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv); //se busca en index de cita en paso-1 y el id de servicios
    });
}
function seleccionarServicio(servicio) {
    const { id } = servicio; // cuando doy click estoy pasando el objeto completo
    const { servicios } = cita; // es el objeto que tiene la informacion de cita, el arreglo vacio
    // identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // comprobar si un servicio ya fue agregado o quitado
    if (servicios.some(agregado => agregado.id === servicio.id)) {  // agregado es lo que esta en memoria y servicio.id es el que estoy dando click en el interface de usuario
        // eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);  // nos va a permitir sacar un elemento basado en cierta condicion 
        divServicio.classList.remove('seleccionado');

    } else {
        // agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');

    }

    //console.log(cita);
}
function idCliente() {
    const id = document.querySelector('#id').value;
    cita.id = id;
}

function nombreCliente() {
    const nombre = document.querySelector('#nombre').value;
    cita.nombre = nombre;

    console.log(nombre);
}

function seleccionarFecha() {
    const inputFecha = document.querySelector("#fecha");
    inputFecha.addEventListener('input', function (e) {

        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semanas no permitidos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function (e) {
        //console.log(e.target.value);
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if (hora < 10 || hora > 21) {
            e.target.value = '';
            console.log("Horas no validas");
            mostrarAlerta('Hora no válida', 'error', '.formulario');

        } else {
            cita.hora = e.target.value;
            //console.log(cita);

        }

    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    // Previene que se generen mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) { // consulta si hay uno, si no hay nada continua la ejecucion del codigo
        alertaPrevia.remove();
    }


    // Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        // eliminar la alerta
        setTimeout(() => {  // para eliminar el alerta luego de 4 segundos
            alerta.remove();
        }, 4000);
    }


}
function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');
    console.log(cita.servicios.length);
    // limpiar el contenido de resumen

    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    //console.log(Object.values(cita));
    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('faltan datos de servicios, fecha u hora', 'error', '.contenido-resumen', false);

        return; // para que detenga la ejecucion del codigo y no tener todo en un else
    }

    // Formatear del div del resumen
    const { nombre, fecha, hora, servicios } = cita;

    // Heading para servicios en resumen
    const headinServicios = document.createElement('H3');
    headinServicios.textContent = 'Resumen de servicios solicitados';
    resumen.appendChild(headinServicios);

    // iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio: </span> Gs.${precio}`;

        contenedorServicio.appendChild(textoServicio)
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    // Heading para cita en resumen
    const headinCita = document.createElement('H3');
    headinCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headinCita);


    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;

    // FORMATEAR LA FECHA EN ESPAÑOL
    const fechaObj = new Date(fecha + ' 00:00');
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDay() + 2;
    const year = fechaObj.getFullYear();

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    const fechaFormateada = fechaObj.toLocaleDateString('es-PY', opciones);

    console.log(fechaFormateada);


    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora: </span> ${hora} Horas`;

    // BOTON PARA CREAR UNA CITA

    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;  // cuando asocias un evento de esta forma no le puedes poner el parentesis porque eso llama a mandar una funcion



    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);

    console.log(nombreCliente);
}
async function reservarCita() {
    const { nombre, fecha, hora, servicios, id } = cita;
    const idServicio = servicios.map(servicio => servicio.id);   // map las coincidencias la iran colocando a esta variable
    //console.log(idServicio);



    const datos = new FormData();
    
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('Servicios', idServicio);
    //console.log([...datos]);

    try {
        // Peticcion hacia la Api 
        const url = '/api/citas'

        //por que async wait? porque de aqui a que se conecte al servidor realice la peticion al servidor
        // no sabemos cuanto va a tardar, por lo tanto vamos a bloquear la ejecucion del codigo utilizando await
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos    // es el cuerpo de la peticion que vamos a enviar
        });

        const resultado = await respuesta.json();
        console.log(resultado.resultado);

        if (resultado.resultado) {
            Swal.fire({
                icon: "success",
                title: "Cita creada",
                text: "Tu cita fue creada correctamente!",
                button: 'OK'
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000); 
            })
        }
        //console.log(respuesta);


    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al guardar la cita"
          });
    }



    //console.log([...datos]);


}