(() => {
  const btnConsulta = document.querySelector("#consultar-montos");
  const inputConsulta = document.querySelector("#busqueda");
  const divDatosUser = document.querySelector("#datos-usuario");
  const divDeudaUser = document.querySelector("#deuda-usuario");
  const divBoton = document.querySelector("#boton");
  let descRecargosAgua = 0;
  let descRecargosDrenaje = 0;
  let RecNaturalAgua = 0;
  let RecNaturalDrenaje = 0;

  let montos = [];
  let usuario_informacion = [];
  let fechas = [];
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });

  let deudaGral = {
    agua: 0,
    drenaje: 0,
    aguaIVA: 0,
    drenajeIVA: 0,
    recargoAgua: 0,
    recargoDrenaje: 0,
    meses: 0,
    total: 0,
    tipoPago: 1,
  }

  document.addEventListener("DOMContentLoaded", () => {
    btnConsulta.addEventListener("click", obtenerID);
  });

  async function consultarDeuda(idUsuario) {
    const formData = new FormData();
    formData.append("id_user", idUsuario);
    try {
      const URL = `${location.origin}/api/deuda-mostrar`;
      const response = await fetch(URL, {
        method: "POST",
        body: formData,
      });
      const resultado = await response.json();

      montos = resultado.deuda_usuario;
      usuario_informacion = resultado.data_usuario;
      renderUsuario();
      deuda();
    } catch (error) {
      console.log(error);
    }
  }

  function obtenerID() {
    const valorInput = inputConsulta.value.trim();

    if (valorInput === "") {
      Swal.fire({
        title: "Error",
        text: "Debe ingresar ID o Nombre",
        icon: "error",
      });

      return;
    }
    
    const indexOf = valorInput.indexOf("-");

    if(indexOf === -1 && isNaN(parseInt(valorInput))) {
      Swal.fire({
        title: "Error",
        text: "Debe ingresar un ID válido",
        icon: "error",
      });
      return;
    }

    let idUser;

    if(isNaN(parseInt(valorInput)) === false) {
      idUser = parseInt(valorInput)
    } else {
      idUser = parseInt(valorInput.substring(0, indexOf));
    }
    
    consultarDeuda(idUser);
    limpiarHTML(document.querySelector("#listado-coincidencias"));
    valorInput.value = "";
  }

  function renderUsuario() {
    limpiarHTML(divDatosUser);
    const div = document.createElement("DIV");
    div.className =
      "rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm w-full mx-auto";

    const divHeader = document.createElement("DIV");
    divHeader.className = "space-y-1.5 p-4 flex flex-row items-center gap-4";
    const spanImg = document.createElement("SPAN");
    spanImg.className =
      "relative flex shrink-0 overflow-hidden rounded-full w-16 h-16";
    spanImg.innerHTML = `<img class="aspect-square h-full w-full" alt=${usuario_informacion.nombre} src="https://api.dicebear.com/6.x/initials/svg?seed=${usuario_informacion.nombre}">`;
    divHeader.appendChild(spanImg);

    const divDatos = document.createElement("DIV");
    divDatos.className = "space-y-1.5 p-6 flex flex-row items-center gap-4";
    divDatos.innerHTML = `
    <div>
      <div class="text-2xl font-semibold leading-none tracking-tight uppercase">
        ${usuario_informacion.nombre}
      </div>
      <p class="text-sm"><span class="font-bold">ID:</span> ${usuario_informacion.id}</p>
    </div>`;
    divHeader.appendChild(divDatos);

    const divMain = document.createElement("DIV");
    divMain.className = "p-6 pt-0 grid gap-4";
    const divGrid = document.createElement("DIV");
    divGrid.className = "grid sm:grid-cols-1 md:grid-cols-2 gap-2";

    const divDireccion = document.createElement("DIV");
    divDireccion.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Dirección: </span><span class="text-sm font-medium">${
      usuario_informacion.direccion || "Sin Dirección registrada"
    }</span>`;

    const divEmail = document.createElement("DIV");
    divEmail.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Correo: </span><span class="text-sm font-medium">${
      usuario_informacion.correo || "Sin Correo registrado"
    }</span>`;

    const divRFC = document.createElement("DIV");
    divRFC.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">RFC: </span><span class="text-sm font-medium">${
      usuario_informacion.rfc || "Sin RFC registrado"
    }</span>`;

    const divColonia = document.createElement("DIV");
    divColonia.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Colonia: </span><span class="text-sm font-medium">${
      usuario_informacion.colonia || "Sin Colonia Registrada"
    }</span>`;

    const divEstadoServ = document.createElement("DIV");
    divEstadoServ.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Estado: </span><span class="text-sm font-medium">${usuario_informacion.estado_servicio}</span>`;

    const divTipoServ = document.createElement("DIV");
    divTipoServ.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Tipo Servicio: </span><span class="text-sm font-medium">${usuario_informacion.tipo_servicio}</span>`;

    const divTipoUser = document.createElement("DIV");
    divTipoUser.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Tipo Usuario: </span><span class="text-sm font-medium">${usuario_informacion.tipo_usuario}</span>`;

    const divTipoToma = document.createElement("DIV");
    divTipoToma.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Tipo toma: </span><span class="text-sm font-medium">${usuario_informacion.toma_consumo}</span>`;

    const divDrenaje = document.createElement("DIV");
    divDrenaje.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Otro: </span><span class="text-sm font-medium">${parseInt(usuario_informacion.drenaje) ? "Con Drenaje" : "Sin Drenaje"}</span>`;

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

  function deuda() {
    limpiarHTML(divDeudaUser);
    limpiarHTML(divBoton);
    limpiarHTML(document.querySelector("#radio_inputs"));

    if (montos.length === 0) {
      const div = document.createElement("DIV");
      div.className =
        "rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm w-full mx-auto mt-6";
      const p = document.createElement("P");
      p.className = "text-center text-lg font-semibold py-2";
      p.textContent = "No hay deudas registradas";
      div.appendChild(p);
      divDatosUser.appendChild(div);
      return;
    }

    if(parseInt(usuario_informacion.estado_servicio_id) !== 1) {
      const div = document.createElement("DIV");
      div.className =
        "rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm w-full mx-auto mt-6";
      const p = document.createElement("P");
      p.className = "text-center text-lg font-semibold py-2";
      p.textContent = "Este estado de servicio no permite consultar el adeudo";
      div.appendChild(p);
      divDatosUser.appendChild(div);
      return;
    }

    montos.forEach(monto => {
      const date = new Date(Date.UTC(monto.year, monto.mes - 1, '07'));
      const fecha = formatearFecha(date);
      fechas = [...fechas, fecha];
    });
    
    const subtotalAgua = [...montos].reduce((acc, curr) => acc + Number(curr.monto_agua), 0);
    
    let subtotalAguaIVA = 0;
    if(parseInt(usuario_informacion.id_tipo_toma) !== 2) {
      subtotalAguaIVA = subtotalAgua * 0.16;
    }
    
    let subtotalDrenaje = 0;
    if(parseInt(usuario_informacion.drenaje)) {
      subtotalDrenaje = [...montos].reduce((acc, curr) => acc + (Number(curr.monto_agua) * 0.25), 0);
    }
    
    const subtotalDrenajeIVA = subtotalDrenaje * 0.16;
    
    let totalRezagoAgua = 0;
    let totalRezagoDrenaje = 0;

    const mesesRezago = [...montos].reduce((acc, curr) => acc + Number(
      curr.if_recargo === "1" ? curr.if_recargo : 0
    ), 0);
    for(let i = 0; i < mesesRezago; i++) {
      totalRezagoAgua += Number(montos[i].monto_agua * 0.0113 * (i+1));

      if(parseInt(usuario_informacion.drenaje)) {
        totalRezagoDrenaje += Number((montos[i].monto_agua * 0.25) * 0.0113 * (i+1));
      }
    }
    
    const mesesTotales =  montos.length;

    deudaGral.agua = redondear(subtotalAgua, 2);
    deudaGral.drenaje = redondear(subtotalDrenaje, 2);
    deudaGral.aguaIVA = redondear(subtotalAguaIVA, 2);
    deudaGral.drenajeIVA = redondear(subtotalDrenajeIVA, 2);
    deudaGral.recargoAgua = redondear(totalRezagoAgua, 2);
    deudaGral.recargoDrenaje = redondear(totalRezagoDrenaje, 2);
    deudaGral.meses = mesesTotales;
    deudaGral.total = redondear(subtotalAgua + subtotalDrenaje + subtotalAguaIVA + subtotalDrenajeIVA + totalRezagoAgua + totalRezagoDrenaje, 2);

    renderizarDeuda();
  }

  function limpiarHTML(div) {
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
  }

  function renderizarDeuda() {
    limpiarHTML(divDeudaUser);
    limpiarHTML(divBoton);
    limpiarHTML(document.querySelector("#radio_inputs"));

    const radios = {
      1: "Efectivo",
      2: "Cheque",
      3: "Depósito",
      4: "Transferencia",
      5: "T.P.V",
    };

    const periodoInicial = `${montos[0].year}-${montos[0].mes}-07`;
    const periodoFinal = `${montos[montos.length - 1].year}-${montos[montos.length - 1].mes}-07`;

    const date1 = new Date(periodoInicial).toLocaleDateString("es-MX", {
      year: "numeric",
      month: "long"
    });
    const date2 = new Date(periodoFinal).toLocaleDateString("es-MX", {
      year: "numeric",
      month: "long"
    });

    if (montos.length !== 0) {
      Object.keys(radios).forEach(key => {
         const div = document.createElement("DIV");
         div.className = "flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700";
         const input = document.createElement("INPUT");
         input.id = `tipo_pago_${key}`;
         input.type = "radio";
         input.value = key;
         input.name = "tipo_pago";
         input.className = "w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer";
         const label = document.createElement("LABEL");
         label.setAttribute("for", `tipo_pago_${key}`);
         label.className = "w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer";
         label.textContent = radios[key];
         div.appendChild(input);
         div.appendChild(label);
         document.querySelector("#radio_inputs").appendChild(div);
      });
    }

    //
    const divDate = document.createElement("DIV");
    divDate.className = "flex items-end justify-between rounded-lg border border-gray-200 bg-white p-2 dark:border-gray-800 dark:bg-gray-900 shadow-sm col-span-3";

    const divBodyDate = document.createElement("DIV");
    divBodyDate.className = "flex items-center gap-4";

    const spanIconDate = document.createElement("SPAN");
    spanIconDate.className = "hidden rounded-full bg-gray-100 p-2 text-gray-600 sm:block dark:bg-gray-800 dark:text-gray-300";
    spanIconDate.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" /></svg>`;

    const datosDate = document.createElement("DIV");
    const pKeyDate = document.createElement("P");
    pKeyDate.className = "text-sm text-gray-500 dark:text-gray-400";
    pKeyDate.textContent = "Periodo Adeudado";

    const pValue = document.createElement("P");
    pValue.className = "text-xl font-medium text-gray-900 dark:text-white uppercase";
    pValue.textContent = `${date1} - ${date2}`;
    
    datosDate.appendChild(pKeyDate);
    datosDate.appendChild(pValue);
    
    divBodyDate.appendChild(spanIconDate);
    divBodyDate.appendChild(datosDate);
    
    divDate.appendChild(divBodyDate);
    divDeudaUser.appendChild(divDate);
    //

    crearCard("Total Agua", deudaGral.agua);
    crearCard("Total Drenaje", deudaGral.drenaje);
    crearCard("IVA de Agua", deudaGral.aguaIVA);
    crearCard("IVA de Drenaje", deudaGral.drenajeIVA);
    crearCard("Recargos Agua", deudaGral.recargoAgua);
    crearCard("Recargos Drenaje", deudaGral.recargoDrenaje);
    crearCard("Meses", deudaGral.meses);
    crearCard("Total", deudaGral.total);

    const btnPagar = document.createElement("BUTTON");
    btnPagar.className = "md:me-4 flex items-center justify-center sm:w-full md:w-auto uppercase bg-blue-600 text-font-light text-lg py-2 px-6 rounded-md shadow-md hover:bg-blue-500 gap-2";
    btnPagar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Pagar Adeudo</p>`;
    btnPagar.onclick = confirmarPago;

    const btnDescRecPorc = document.createElement("BUTTON");
    btnDescRecPorc.className = "md:me-4 flex items-center justify-center sm:w-full md:w-auto uppercase bg-indigo-700 text-font-light text-xs py-2 px-6 rounded-md shadow-md hover:bg-indigo-600 gap-2";
    btnDescRecPorc.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg><p class="font-bold text-xs">Des Recargos</p>`;
    btnDescRecPorc.onclick = modalRecargosDesc;

    const btnAvanzados = document.createElement("A");
    btnAvanzados.className = "md:me-4 flex items-center justify-center sm:w-full md:w-auto uppercase bg-slate-600 text-font-light text-xs py-2 px-6 rounded-md shadow-md hover:bg-slate-500 gap-2";
    btnAvanzados.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" /></svg><p class="font-bold text-xs">Avanzados</p>`;
    btnAvanzados.href = `/consultar-avanzados?usuario=${usuario_informacion.id}`;

    divBoton.appendChild(btnPagar);
    divBoton.appendChild(btnAvanzados);
    divBoton.appendChild(btnDescRecPorc);
  }

  function redondear(numero, decimales) {
    const redondeado = Math.round(numero * Math.pow(10, decimales)) / Math.pow(10, decimales);
   
    return redondeado.toLocaleString("es-MX");
  }

  function crearCard(name, value) {
    const div = document.createElement("DIV");
    div.className = "flex items-end justify-between rounded-lg border border-gray-200 bg-white p-2 dark:border-gray-800 dark:bg-gray-900 shadow-sm";

    const divBody = document.createElement("DIV");
    divBody.className = "flex items-center gap-4";

    const spanIcon = document.createElement("SPAN");
    spanIcon.className = "hidden rounded-full bg-gray-100 p-2 text-gray-600 sm:block dark:bg-gray-800 dark:text-gray-300";
    if(name === "Meses"){
      spanIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" /></svg>
      `;
    } else {
      spanIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path  stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
      `;
    }

    const datos = document.createElement("DIV");
    const pKey = document.createElement("P");
    pKey.className = "text-sm text-gray-500 dark:text-gray-400";
    pKey.textContent = name;

    const pValue = document.createElement("P");
    pValue.className = "text-2xl font-medium text-gray-900 dark:text-white";
    if(name === "Meses"){
      pValue.textContent = value;
    } else {
      pValue.textContent = `$ ${value}`;
    }

    datos.appendChild(pKey);
    datos.appendChild(pValue);

    divBody.appendChild(spanIcon);
    divBody.appendChild(datos);

    div.appendChild(divBody);
    divDeudaUser.appendChild(div);
  }

  function confirmarPago() {
    const t = deudaGral.total.replace(',', '');

    Swal.fire({
      title: `¿Realizar pago por $${t - RecNaturalAgua - RecNaturalDrenaje} mxn?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Confirmar pago",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        guardarPago();
      }
    });
  }

  async function guardarPago() {
    const periodo = fechaMinMax();
    const radios = document.querySelectorAll("input[type='radio']");
        radios.forEach(radio => {
          if (radio.checked) {
            deudaGral.tipoPago = radio.value;
          }
    });

    const formData = new FormData();
    formData.append("id_user", usuario_informacion.id);
    formData.append("mes_incio", periodo.min.toLocaleDateString("en-US"));
    formData.append("mes_fin", periodo.max.toLocaleDateString("en-US"));
    formData.append("monto_agua", deudaGral.agua);
    formData.append("monto_drenaje", deudaGral.drenaje);
    formData.append("monto_iva_agua", deudaGral.aguaIVA);
    formData.append("monto_iva_drenaje", deudaGral.drenajeIVA);
    formData.append("monto_recargo_agua", deudaGral.recargoAgua);
    formData.append("monto_recargo_drenaje", deudaGral.recargoDrenaje);
    formData.append("numero_meses", deudaGral.meses);
    formData.append("tipo_pago", deudaGral.tipoPago);
    formData.append("monto_descuento_recargo_agua", RecNaturalAgua ? Number(RecNaturalAgua) : 0);
    formData.append("monto_descuento_recargo_drenaje", RecNaturalDrenaje ? Number(RecNaturalDrenaje) : 0);
    formData.append("total", deudaGral.total);

    try {
      const URL = `${location.origin}/api/pago-total`
      const response = await fetch(URL, {
        method: "POST",
        body: formData,
      });
      const resultado = await response.json();

      if(resultado.tipo === "Exito") {
        Swal.fire({
          title: `Pago guardado correctamente con folio ${resultado.folio}`,
          text: "El pago se ha guardado correctamente",
          icon: "success",
          confirmButtonText: "Mostrar recibo",
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false, 
        }).then((result) => {
          if (result.isConfirmed) {
            window.open(`pdf/recibo?folio=${resultado.folio}&id=${usuario_informacion.id}`, '_blank');
          }
        });

        limpiarHTML(document.querySelector("#radio_inputs"));
        limpiarHTML(divBoton);
        consultarDeuda(usuario_informacion.id);
        fechas = [];
      }
    } catch (error) {
      console.log(error);
    }
  }

  function fechaMinMax() {
    const arrayFechas = fechas.map((fechaActual) => new Date(fechaActual) );

    const max = new Date(Math.max.apply(null,arrayFechas));
    const min = new Date(Math.min.apply(null,arrayFechas));

    return {
      min,
      max,
    }
  }

  function formatearFecha(fecha) {
    const resultado = fecha.toLocaleDateString("en-US", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
    });

    return resultado;
  }

  function modalRecargosDesc() {

    const modalRez = document.createElement("DIV");
    modalRez.className = "overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full bg-gray-500 bg-opacity-75 dark:bg-gray-800 dark:bg-opacity-80";
    const modalRezContent = document.createElement("DIV");
    modalRezContent.className = "relative p-4 w-full max-w-md max-h-full mx-auto mt-20";
    const modalBody = document.createElement("DIV");
    modalBody.className = "relative bg-white rounded-lg shadow dark:bg-gray-700";

    const btnX = document.createElement("BUTTON");
    btnX.className = "absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white";
    btnX.innerHTML = `<svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg><span class="sr-only">Close modal</span>`;
    btnX.onclick = () => document.body?.removeChild(modalRez);

    
    const divInput = document.createElement("DIV");
    divInput.className = "p-4 md:p-5 text-center";
    divInput.id = "divInputContainer";
    divInput.innerHTML = `<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>`;
    const h3 = document.createElement("H3");
    h3.className = "mb-5 text-lg font-normal text-gray-500 dark:text-gray-400";
    h3.textContent = "Ingrese el monto de recargos a descontar";

    const btnChange = document.createElement("BUTTON");
    btnChange.className ="text-xs font-semibold rounded-full text-yellow-900 hover:bg-yellow-900 hover:text-white border border-yellow-900 px-3 py-1 dark:text-yellow-200 dark:border-yellow-200 dark:hover:bg-yellow-200 dark:hover:text-gray-900 mb-2";
    btnChange.textContent = "Porcentaje";
    btnChange.id = "btnChange";
    btnChange.ondblclick = cambiarTipoDesc;

    const input = document.createElement("INPUT");
    input.className = "w-full rounded-lg border border-gray-300 bg-white px-4 py-2 mb-4 text-gray-900 placeholder:text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:placeholder:text-gray-500";
    input.type = "number";

    
    const btnConfirm = document.createElement("BUTTON");
    btnConfirm.className = "text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
    btnConfirm.textContent = "Calcular";
    btnConfirm.onclick = () => {
      if(input.value.trim() === "" || parseFloat(input.value) <= 0) {
        Toast.fire({
          icon: "error",
          title: "Debe ingresar un monto",
        });
        return;
      }

      descontarRecParcial();
    }

    const btnCancel = document.createElement("BUTTON");
    btnCancel.className = "py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700";
    btnCancel.textContent = "Cancelar";
    btnCancel.onclick = () => document.body?.removeChild(modalRez);

    divInput.appendChild(h3);
    divInput.appendChild(btnChange);
    divInput.appendChild(input);
    divInput.appendChild(btnConfirm);
    divInput.appendChild(btnCancel);
    modalBody.appendChild(btnX);
    modalBody.appendChild(divInput);
    
    modalRezContent.appendChild(modalBody);
    modalRez.appendChild(modalRezContent);
    document.body.appendChild(modalRez);
  }

  function cambiarTipoDesc(e) {
    let tipo = e.target;
    tipo.parentElement.querySelector('input').value = "";
    tipo.textContent === "Porcentaje" ? tipo.textContent = "Pesos" : tipo.textContent = "Porcentaje";
  }

  function descontarRecParcial() {
    const recAgua = Number((deudaGral.recargoAgua).replace(',', ''));
    const recDrenaje = Number((deudaGral.recargoDrenaje).replace(',', ''));

    const tipo = document.querySelector("#divInputContainer button");
    const input = document.querySelector("#divInputContainer input");
    let number = Number(input.value);

    if(tipo.textContent === "Porcentaje") {

      if(number > 100) {
        Toast.fire({
          icon: "error",
          title: "Debe ingresar un porcentaje menor al 100%",
        });
        return;
      }

      const descA = ((number/100) * recAgua);
      const descD = ((number/100) * recDrenaje);
      
      Swal.fire({
          title: "Confirmar descuento",
          html: `<p>¿Está seguro de realizar el siguiente descuento?</p>
          <ul style="padding:1rem">
          <li>Desc Rec Agua: $ ${descA.toFixed(2)} MNX</li>
          <li>Desc Rec Drenaje: $ ${descD.toFixed(2)} MNX</li>
          </ul>
          <p style="font-weight:700; font-size:1.5rem">Total a descontar: $ ${(descA + descD).toFixed(2)} MNX</p>`,
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Confirmar",
          cancelButtonText: "Cancelar",
          reverseButtons: true
      }).then(result => {
          if (result.value) {
            console.log('Confirmado');
            aplicarDescRecParc(descA, descD);
            input.parentElement.parentElement.parentElement.parentElement?.remove();
            Toast.fire({
              icon: "success",
              title: "Descuento aplicado correctamente",
            });
          }   
        });
        
        return;
      }
      
    if(number > recAgua + recDrenaje) {
      Toast.fire({
        icon: "error",
        title: `Debe ingresar un monto menor a ${recAgua + recDrenaje}`,
      });
      return;
    }

    const per = (number * 100) / (recAgua + recDrenaje);
        const descA = ((per/100) * recAgua);
        const descD = ((per/100) * recDrenaje);

        Swal.fire({
          title: "Confirmar descuento",
          html: `<p>¿Está seguro de realizar el siguiente descuento?</p>
          <ul style="padding:1rem">
              <li>Desc Rec Agua: $ ${descA.toFixed(2)} MNX</li>
              <li>Desc Rec Drenaje: $ ${descD.toFixed(2)} MNX</li>
          </ul>
          <p style="font-weight:700; font-size:1.5rem">Total a descontar: $ ${(descA + descD).toFixed(2)} MNX</p>`,
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Confirmar",
          cancelButtonText: "Cancelar",
          reverseButtons: true
      }).then(result => {
          if (result.value) {
            console.log('Confirmado');
           aplicarDescRecParc(descA, descD);
           input.parentElement.parentElement.parentElement.parentElement?.remove();
           Toast.fire({
              icon: "success",
              title: "Descuento aplicado correctamente",
            });
          }   
      });
  }

  function aplicarDescRecParc(descA, descD) {
    RecNaturalAgua = descA;
    RecNaturalDrenaje = descD;

    const divRecAgua = divDeudaUser.querySelector("div:nth-child(6) p:nth-child(2)");
    const divRecDren = divDeudaUser.querySelector("div:nth-child(7) p:nth-child(2)");
    const divTot = divDeudaUser.querySelector("div:nth-child(9) p:nth-child(2)");

    const a = deudaGral.recargoAgua.replace(',', '');
    const d = deudaGral.recargoDrenaje.replace(',', '');
    const t = deudaGral.total.replace(',', '');
    
    if(deudaGral.recargoDrenaje === 0) {
      divRecAgua.textContent = `$ ${(a - descA - descD).toFixed(2)} MNX`;
      divTot.textContent = `$ ${(Number(t) - descA - descD).toFixed(2)} MNX`;
      return;
    }
    
    if(deudaGral.recargoAgua === 0) {
      divRecDren.textContent = `$ ${(d - descD - descA).toFixed(2)} MNX`;
      divTot.textContent = `$ ${(Number(t) - descA - descD).toFixed(2)} MNX`;
      return;
    }
    
    divRecAgua.textContent = `$ ${(a - descA).toFixed(2)} MNX`;
    divRecDren.textContent = `$ ${(d - descD).toFixed(2)} MNX`;
    divTot.textContent = `$ ${(Number(t) - descA - descD).toFixed(2)} MNX`;
  }
})();
