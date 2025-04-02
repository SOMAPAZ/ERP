import Alerta from "../classes/Alerta_v1.js";
import { deleteLocalStorage, formatDateText, formatNum, getLocalStorage, limpiarHTML, saveLocalStorage } from "../helpers/index_v1.js";
import GetDatos from "../classes/GetData_v1.js"

(() => {
  const form = document.querySelector("#formulario-busqueda");
  const divError = document.querySelector("#error");
  const inputBusqueda = document.querySelector("#busqueda");

  const divDatosUser = document.querySelector("#datos-usuario");
  const divDeudaUser = document.querySelector("#deuda-usuario");
  const divBoton = document.querySelector("#boton");
  let username = ''

  let resUser = [];
  let resDebt = [];
  let locSto;

  document.addEventListener('DOMContentLoaded', function(){
    locSto = getLocalStorage("idUsuario");
    if(locSto !== null) consultarInfoUsuario(locSto);
    form.addEventListener("submit", validarInput);
  })
  
  const validarInput = (e) => {
    limpiarHTML(document.querySelector("#listado-coincidencias ul"))
    e.preventDefault();
    username = inputBusqueda.value.trim();
    if(username === "") {
      new Alerta({ 
        msg: "Debe ingresar un ID, Nombre o Dirección Válido", 
        position: divError 
      });

      return;
    };

    locSto = null;
    deleteLocalStorage("idUsuario")
    obtenerID()
  }

  const consultarInfoUsuario = async (id) => {
    const urlUser = `${location.origin}/api/usuario?id=${id}`;
    const urlDebt = `${location.origin}/deuda-usuario?id=${id}`;

    [resUser, resDebt] = await Promise.all([
      GetDatos.consultar(urlUser),
      GetDatos.consultar(urlDebt)
    ])

    renderUsuario()
    renderizarDeuda()
  }

  const obtenerID = () => {    
    let idUser;
    const indexOf = username.indexOf(" - ");

    if(indexOf === -1) {
      if(isNaN(parseInt(username))) {
        Alerta.Toast.fire({
          icon: "error",
          title: `'${username}' no es un ID válido`,
        });
        return;
      }
      idUser = parseInt(username)
    } else {
      idUser = parseInt(username.substring(0, indexOf));
    }
    
    saveLocalStorage("idUsuario", idUser);
    consultarInfoUsuario(idUser);
    form.reset()
  }

  const renderUsuario = () => {
    if(resUser.tipo === 'Error') {
      Alerta.Toast.fire({
        icon: "warning",
        title: resUser.msg,
      });
      return
    }

    limpiarHTML(divDatosUser);
    const div = document.createElement("DIV");
    div.className =
      "rounded-lg border bg-white dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm w-full mx-auto px-4 md:px-10";

    const divHeader = document.createElement("DIV");
    divHeader.className = "space-y-1.5 p-4 flex flex-row items-center gap-4";
    const spanImg = document.createElement("SPAN");
    spanImg.className =
      "relative flex shrink-0 overflow-hidden rounded-full w-16 h-16";
    spanImg.innerHTML = `<img class="aspect-square h-full w-full" alt=${resUser.user} src="https://api.dicebear.com/6.x/initials/svg?seed=${resUser.user}">`;
    divHeader.appendChild(spanImg);

    const divDatos = document.createElement("DIV");
    divDatos.className = "space-y-1.5 p-6 flex flex-row items-center gap-4";
    divDatos.innerHTML = `
    <div>
      <div class="text-2xl font-semibold leading-none tracking-tight uppercase">
        ${resUser.user} ${resUser.lastname}
      </div>
      <p class="text-sm"><span class="font-bold">ID:</span> ${resUser.id}</p>
    </div>`;
    divHeader.appendChild(divDatos);

    const divMain = document.createElement("DIV");
    divMain.className = "p-6 pt-0 grid gap-4";
    const divGrid = document.createElement("DIV");
    divGrid.className = "grid sm:grid-cols-1 md:grid-cols-2 gap-2";

    const divDireccion = document.createElement("DIV");
    divDireccion.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Dirección: </span><span class="text-sm font-medium">${resUser.address || "Sin Dirección registrada"}</span>`;

    const divEmail = document.createElement("DIV");
    divEmail.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Correo: </span><span class="text-sm font-medium">${resUser.mail || "Sin Correo registrado"}</span>`;

    const divRFC = document.createElement("DIV");
    divRFC.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">RFC: </span><span class="text-sm font-medium">${resUser.rfc || "Sin RFC registrado"}</span>`;

    const divColonia = document.createElement("DIV");
    divColonia.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Colonia: </span><span class="text-sm font-medium">${resUser.id_colony || "Sin Colonia Registrada"}</span>`;

    const divEstadoServ = document.createElement("DIV");
    divEstadoServ.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Estado: </span><span class="text-sm font-medium">${resUser.id_servicestatus}</span>`;

    const divTipoServ = document.createElement("DIV");
    divTipoServ.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Tipo Servicio: </span><span class="text-sm font-medium">${resUser.id_servicetype}</span>`;

    const divTipoUser = document.createElement("DIV");
    divTipoUser.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Tipo Usuario: </span><span class="text-sm font-medium">${resUser.id_usertype}</span>`;

    const divTipoToma = document.createElement("DIV");
    divTipoToma.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Tipo toma: </span><span class="text-sm font-medium">${resUser.id_intaketype} - ${resUser.id_consumtype}</span>`;

    const divDrenaje = document.createElement("DIV");
    divDrenaje.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Otro: </span><span class="text-sm font-medium">${parseInt(resUser.drain) ? "Con Drenaje" : "Sin Drenaje"}</span>`;

    divGrid.appendChild(divDireccion);
    divGrid.appendChild(divEmail);
    divGrid.appendChild(divRFC);
    divGrid.appendChild(divColonia);
    divGrid.appendChild(divEstadoServ);
    divGrid.appendChild(divTipoServ);
    divGrid.appendChild(divTipoUser);
    divGrid.appendChild(divTipoToma);
    divGrid.appendChild(divDrenaje);

    divMain.appendChild(divGrid);

    div.appendChild(divHeader);
    div.appendChild(divMain);
    divDatosUser.appendChild(div);
  }

  const renderizarDeuda = () => {
    limpiarHTML(divDeudaUser);
    limpiarHTML(divBoton);

    if(resDebt.tipo === 'Error') {
      Alerta.Toast.fire({
        icon: "warning",
        title: resDebt.msg,
      });
      return
    }
    
    if(resDebt.estado === 'debe') {
      const divPeriodo = document.createElement('DIV')
      divPeriodo.className = "bg-white rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow w-full mx-auto px-4 md:px-10 py-6";
  
      const divFechas = document.createElement('DIV')
      divFechas.className = "flex flex-col md:flex-row justify-center items-center gap-8 font-bold uppercase text-center";
      
      const pFecha = document.createElement('P')
      pFecha.className = "mb-3 font-bold uppercase text-lg"
      pFecha.textContent = "Periodo de adeudo:";

      const parrPeriodoI = document.createElement('P')
      parrPeriodoI.innerHTML = `Inicio: <span class="font-normal">${formatDateText(resDebt.periodo.inicio)}</span>`
  
      const parrPeriodoF = document.createElement('P')
      parrPeriodoF.innerHTML = `Fin: <span class="font-normal">${formatDateText(resDebt.periodo.final)}</span>`
  
      divPeriodo.appendChild(pFecha)
      divFechas.appendChild(parrPeriodoI)
      divFechas.appendChild(parrPeriodoF)
      divPeriodo.appendChild(divFechas)
      divDeudaUser.appendChild(divPeriodo)
    }

    const divDeuda = document.createElement('DIV')
    divDeuda.className = "bg-white rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow w-full mx-auto px-4 md:px-10 py-6 mt-6";

    const btnCondonaciones = document.createElement("A");
    btnCondonaciones.className = "text-gray-900 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase text-xs py-2 px-6 rounded-sm gap-2";
    btnCondonaciones.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-800 dark:text-red-300"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg><p class="font-bold text-xs text-red-800 dark:text-red-300">Eliminar condonaciones</p>`;
    btnCondonaciones.href = `/consultar-condonaciones?usuario=${resUser.id}`;

    const btnRecibos = document.createElement("A");
    btnRecibos.className = "text-gray-900 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase text-xs py-2 px-6 rounded-sm gap-2";
    btnRecibos.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path d="M5.127 3.502 5.25 3.5h9.5c.041 0 .082 0 .123.002A2.251 2.251 0 0 0 12.75 2h-5.5a2.25 2.25 0 0 0-2.123 1.502ZM1 10.25A2.25 2.25 0 0 1 3.25 8h13.5A2.25 2.25 0 0 1 19 10.25v5.5A2.25 2.25 0 0 1 16.75 18H3.25A2.25 2.25 0 0 1 1 15.75v-5.5ZM3.25 6.5c-.04 0-.082 0-.123.002A2.25 2.25 0 0 1 5.25 5h9.5c.98 0 1.814.627 2.123 1.502a3.819 3.819 0 0 0-.123-.002H3.25Z" /></svg><p class="font-bold text-xs">Historial Recibos</p>`;
    btnRecibos.href = `/historial-recibos?usuario=${resUser.id}`;

    if(resDebt.estado === 'pagado') {
      const p = document.createElement('P')
      p.className = "text-center font-black uppercase text-lg"
      p.textContent = resDebt.msg;
      
      divDeuda.appendChild(p)
      divDeudaUser.appendChild(divDeuda)
      divBoton.appendChild(btnRecibos)
      divBoton.appendChild(btnCondonaciones)
      return;
    }
    
    const p = document.createElement('P')
    p.className = "mb-3 font-bold uppercase text-lg"
    p.textContent = "Información del adeudo";
    const ul = document.createElement('UL')
    ul.className = "grid grid-cols-1 sm:grid-cols-2"
    
    const liAguaIncial = document.createElement('LI')
    liAguaIncial.innerHTML = `<span class="font-bold">Agua inicial:</span> $ ${formatNum(resDebt.agua_inicial)}`;
    
    const lidrenajeInicial = document.createElement('LI')
    lidrenajeInicial.innerHTML = `<span class="font-bold">Drenaje incial:</span> $ ${formatNum(resDebt.drenaje_inicial)}`;
    
    const liAgua = document.createElement('LI')
    liAgua.innerHTML = `<span class="font-bold">Agua a pagar:</span> $ ${formatNum(resDebt.agua)}`;
    const liDren = document.createElement('LI')
    liDren.innerHTML = `<span class="font-bold">Drenaje a pagar:</span> $ ${formatNum(resDebt.drenaje)}`;
    
    const liRec = document.createElement('LI')
    liRec.innerHTML = `
    <div>
      <span class="font-bold">Recargos:</span> $ ${formatNum(resDebt.recargos.total)}
      <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Agua: <span class="font-normal">
        $  ${formatNum(resDebt.recargos.agua)}
      </span></p>
      <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Drenaje: <span class="font-normal">
        $  ${formatNum(resDebt.recargos.drenaje)}
      </span></p>
    </div>
    `;
    const liIva = document.createElement('LI')
    liIva.innerHTML = `
    <div>
    <span class="font-bold">IVA:</span> $ ${formatNum(resDebt.iva.total)}
    <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Agua: <span class="font-normal">
    $ ${formatNum(resDebt.iva.agua)}
    </span></p>
    <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Drenaje: <span class="font-normal">
      $ ${formatNum(resDebt.iva.drenaje)}
    </span></p>
    ${ resDebt.m3_excedido_agua > 0 ?
      `
      <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Exc Agua: <span class="font-normal">
      $ ${formatNum(resDebt.iva.m3_excedido_agua)}
      </span></p>
      <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Exc Drenaje: <span class="font-normal">
      $ ${formatNum(resDebt.iva.m3_excedido_drenaje)}
      </span></p>` : ''
    }
    </div>
    `;
    const liMeses = document.createElement('LI')
    liMeses.innerHTML = `
    <div>
    <span class="font-bold">Meses totales:</span> ${resDebt.meses.totales}
    <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Rezagados: <span class="font-normal">${resDebt.meses.rezagados}</span></p>
    <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Naturales: <span class="font-normal">${resDebt.meses.naturales}</span></p>
    </div>
    `;
    const liDescuento = document.createElement('LI')
    liDescuento.innerHTML = `
    <div>
      <span class="font-bold">Descuento total aplicable:</span> $ ${formatNum(resDebt.descuentos.total)}
      <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Agua: <span class="font-normal">$ ${formatNum(resDebt.descuentos.agua)}</span></p>
      <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Drenaje: <span class="font-normal">$ ${formatNum(resDebt.descuentos.drenaje)}</span></p>
    </div>
    `;
    
    const liTotal = document.createElement('LI')
    liTotal.className = "text-2xl text-gray-900 underline dark:text-yellow-200"
    liTotal.innerHTML = `<span class="font-black">Total:</span> $ ${formatNum(resDebt.total)}`;
    
    ul.appendChild(liAguaIncial)
    ul.appendChild(lidrenajeInicial)
    ul.appendChild(liAgua)
    ul.appendChild(liDren)
    ul.appendChild(liRec)
    
    
    if(resDebt.excedio > 0) {
      const liMedido = document.createElement('LI')
      liMedido.innerHTML = `
      <div>
        <span class="font-bold">Excedido Medido:</span> $ ${formatNum(resDebt.m3_excedido_agua + resDebt.m3_excedido_drenaje)}
        <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Agua: <span class="font-normal">
        $ ${formatNum(resDebt.m3_excedido_agua)}
        </span></p>
        <p class="font-bold text-gray-600 dark:text-gray-400 ms-6">- Drenaje: <span class="font-normal">
        $ ${formatNum(resDebt.m3_excedido_drenaje)}
        </span></p>
      </div>
      `;
      ul.appendChild(liMedido)
    }

    ul.appendChild(liDescuento)
    ul.appendChild(liIva)
    ul.appendChild(liMeses)
    ul.appendChild(liTotal)
    
    divDeuda.appendChild(p)
    divDeuda.appendChild(ul)
    divDeudaUser.appendChild(divDeuda)

    const btnPagar = document.createElement("A");
    btnPagar.className = "py-2 px-4 bg-gray-200 dark:bg-gray-700 rounded text-sm text-gray-800 dark:text-white my-4 hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold flex flex-row gap-2 items-center uppercase";
    btnPagar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg><p class="font-bold text-xs">Realizar pago</p>`;
    const fechaActual = new Date();
    if((fechaActual.getMonth() >= 2 && resUser.id_servicetype === "Medido") || 
        (resUser.id_servicetype === "Medido" && resDebt.recargos.total > 0)) {
      btnPagar.setAttribute('disabled', true);
      btnPagar.classList.add('opacity-50');
      btnPagar.classList.add('cursor-not-allowed');
    } else {
      btnPagar.href = `/pagar-total?usuario=${resUser.id}`;
      btnPagar.classList.remove('opacity-50');
      btnPagar.classList.remove('cursor-not-allowed');
    }
    
    const btnAvanzados = document.createElement("A");
    btnAvanzados.className = "text-gray-900 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase text-xs py-2 px-6 rounded-sm gap-2";
    btnAvanzados.innerHTML = `<svg class="h-6 w-6 text-gray-900 dark:text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />  <circle cx="12" cy="12" r="3" /></svg><p class="font-bold text-xs">Desglose</p>`;
    btnAvanzados.href = `/consultar-avanzados?usuario=${resUser.id}`;

    divBoton.appendChild(btnPagar);
    divBoton.appendChild(btnAvanzados);
    divBoton.appendChild(btnRecibos);
    divBoton.appendChild(btnCondonaciones);
  }
})();
