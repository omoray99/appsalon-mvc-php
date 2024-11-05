let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:n}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`Gs. ${n}`;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(a),r.appendChild(c),document.querySelector("#servicios").appendChild(r)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,n=document.querySelector(`[data-id-servicio="${t}"]`);o.some((t=>t.id===e.id))?(cita.servicios=o.filter((e=>e.id!==t)),n.classList.remove("seleccionado")):(cita.servicios=[...o,e],n.classList.add("seleccionado"))}function idCliente(){const e=document.querySelector("#id").value;cita.id=e}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e,console.log(e)}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semanas no permitidos","error",".formulario")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>21?(e.target.value="",console.log("Horas no validas"),mostrarAlerta("Hora no válida","error",".formulario")):cita.hora=e.target.value}))}function mostrarAlerta(e,t,o,n=!0){const a=document.querySelector(".alerta");a&&a.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta"),c.classList.add(t);document.querySelector(o).appendChild(c),n&&setTimeout((()=>{c.remove()}),4e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(console.log(cita.servicios.length);e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("faltan datos de servicios, fecha u hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:n,servicios:a}=cita,c=document.createElement("H3");c.textContent="Resumen de servicios solicitados",e.appendChild(c),a.forEach((t=>{const{id:o,precio:n,nombre:a}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicio");const r=document.createElement("P");r.textContent=a;const i=document.createElement("P");i.innerHTML=`<span>Precio: </span> Gs.${n}`,c.appendChild(r),c.appendChild(i),e.appendChild(c)}));const r=document.createElement("H3");r.textContent="Resumen de Cita",e.appendChild(r);const i=document.createElement("P");i.innerHTML=`<span>Nombre: </span> ${t}`;const s=new Date(o+" 00:00"),d=(s.getMonth(),s.getDay(),s.getFullYear(),s.toLocaleDateString("es-PY",{weekday:"long",year:"numeric",month:"long",day:"numeric"}));console.log(d);const l=document.createElement("P");l.innerHTML=`<span>Fecha: </span> ${d}`;const u=document.createElement("P");u.innerHTML=`<span>Hora: </span> ${n} Horas`;const m=document.createElement("BUTTON");m.classList.add("boton"),m.textContent="Reservar Cita",m.onclick=reservarCita,e.appendChild(i),e.appendChild(l),e.appendChild(u),e.appendChild(m),console.log(i)}async function reservarCita(){const{nombre:e,fecha:t,hora:o,servicios:n,id:a}=cita,c=n.map((e=>e.id)),r=new FormData;r.append("fecha",t),r.append("hora",o),r.append("usuarioId",a),r.append("Servicios",c);try{const e="/api/citas",t=await fetch(e,{method:"POST",body:r}),o=await t.json();console.log(o.resultado),o.resultado&&Swal.fire({icon:"success",title:"Cita creada",text:"Tu cita fue creada correctamente!",button:"OK"}).then((()=>{setTimeout((()=>{window.location.reload()}),3e3)}))}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));