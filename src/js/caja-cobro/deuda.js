import Alerta from "../classes/Alerta.js";
import { formatNum, limpiarHTML } from "../helpers/funciones.js";
import GetDatos from "../classes/GetData.js"
import Modal from "../classes/Modal.js";
import PostDatos from "../classes/PostData.js";

(() => {
  const form = document.querySelector("#formulario-busqueda");
  const divError = document.querySelector("#error");
  const inputBusqueda = document.querySelector("#busqueda");

  const divDatosUser = document.querySelector("#datos-usuario");
  const divDeudaUser = document.querySelector("#deuda-usuario");
  const divBoton = document.querySelector("#boton");

  let resUser;
  let resDebt;

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

  document.addEventListener('DOMContentLoaded', function () {
    form.addEventListener("submit", validarInput);
  })

  const validarInput = (e) => {
    e.preventDefault()
    if (inputBusqueda.value.trim() === "") {
      new Alerta({
        msg: "Debe ingresar un ID, Nombre o Dirección Válido",
        position: divError
      });

      return;
    };

    obtenerID(inputBusqueda.value)
    form.reset();
  }

  const consultarInfoUsuario = async (id) => {
    const urlUser = `${location.origin}/api/usuario?id=${id}`;
    const urlDebt = `${location.origin}/deuda-usuario?id=${id}`;
    resUser = await GetDatos.consultar(urlUser);
    resDebt = await GetDatos.consultar(urlDebt);
    renderUsuario()
    renderizarDeuda()
  }

  const obtenerID = (valor) => {
    let idUser;
    const indexOf = valor.indexOf(" - ");

    if (indexOf === -1) {
      if (isNaN(parseInt(valor))) {
        Alerta.Toast.fire({
          icon: "error",
          title: `El id '${valor}' no es válido`,
        });
        return;
      }

      idUser = parseInt(valor)
    } else {

      idUser = parseInt(valor.substring(0, indexOf));

    }

    consultarInfoUsuario(idUser);
    limpiarHTML(document.querySelector("#listado-coincidencias"));
  }

  const renderUsuario = () => {
    limpiarHTML(divDatosUser);
    const div = document.createElement("DIV");
    div.className =
      "rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm w-full mx-auto px-4 md:px-10";

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
    divDireccion.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Dirección: </span><span class="text-sm font-medium">${resUser.direccion || "Sin Dirección registrada"}</span>`;

    const divEmail = document.createElement("DIV");
    divEmail.innerHTML = `<span class="text-sm font-bold dark:text-gray-400">Correo: </span><span class="text-sm font-medium">${resUser.correo || "Sin Correo registrado"}</span>`;

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

    const divDeuda = document.createElement('DIV')
    divDeuda.className = "rounded-lg border dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow w-full mx-auto px-4 md:px-10 py-6";

    if (resDebt.estado === 'pagado') {
      const p = document.createElement('P')
      p.className = "text-center font-black uppercase text-lg"
      p.textContent = resDebt.msg;

      divDeuda.appendChild(p)
      divDeudaUser.appendChild(divDeuda)
      return;
    }

    const p = document.createElement('P')
    p.className = "mb-3 font-bold uppercase text-xl"
    p.textContent = "Información del adeudo";

    divPeriodo = document.createElement('DIV')


    const ul = document.createElement('UL')
    const divDebt = document.createElement('DIV')
    divDebt.className = "w-full grid grid-cols-1 md:grid-cols-3"
    const imgIcon = document.createElement('P');
    imgIcon.className = "col-span-1"
    imgIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-48"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
`
    ul.className = "grid grid-cols-1 sm:grid-cols-2 col-span-2 uppercase"

    const liAgua = document.createElement('LI')
    liAgua.innerHTML = `<span class="font-bold">Agua</span>: $ ${formatNum(resDebt.agua)}`;
    const liDren = document.createElement('LI')
    liDren.innerHTML = `<span class="font-bold">Drenaje:</span> $ ${formatNum(resDebt.drenaje)}`;
    const liRec = document.createElement('LI')
    liRec.innerHTML = `
    <div>
      <span class="font-bold">Recargos:</span> $ ${formatNum(resDebt.recargos.total)}
      <p class="font-bold text-gray-700 text-xs dark:text-gray-400 ms-6">- Agua: <span class="font-normal">$  ${formatNum(resDebt.recargos.agua)}</span></p>
      <p class="font-bold text-gray-700 text-xs dark:text-gray-400 ms-6">- Drenaje: <span class="font-normal">$  ${formatNum(resDebt.recargos.drenaje)}</span></p>
    </div>
    `;
    const liIva = document.createElement('LI')
    liIva.innerHTML = `
    <div>
      <span class="font-bold">IVA:</span> $ ${formatNum(resDebt.iva.total)}
      <p class="font-bold text-gray-700 text-xs dark:text-gray-400 ms-6">- Agua: <span class="font-normal">$ ${formatNum(resDebt.iva.agua)}</span></p>
      <p class="font-bold text-gray-700 text-xs dark:text-gray-400 ms-6">- Drenaje: <span class="font-normal">$ ${formatNum(resDebt.iva.drenaje)}</span></p>
    </div>
    `;
    const liMeses = document.createElement('LI')
    liMeses.innerHTML = `
    <div>
      <span class="font-bold">Meses totales:</span> ${resDebt.meses.totales}
      <p class="font-bold text-gray-700 text-xs dark:text-gray-400 ms-6">- Rezagados: <span class="font-normal">${resDebt.meses.rezagados}</span></p>
      <p class="font-bold text-gray-700 text-xs dark:text-gray-400 ms-6">- Naturales: <span class="font-normal">${resDebt.meses.naturales}</span></p>
    </div>
    `;

    const liTotal = document.createElement('LI')
    liTotal.className = "text-2xl text-gray-900 underline dark:text-yellow-200"
    liTotal.innerHTML = `<span class="font-black">Total:</span> $ ${formatNum(resDebt.total)}`;

    ul.appendChild(liAgua)
    ul.appendChild(liDren)
    ul.appendChild(liRec)
    ul.appendChild(liIva)
    ul.appendChild(liMeses)
    ul.appendChild(liTotal)

    divDebt.appendChild(imgIcon)
    divDebt.appendChild(ul)
    divDeuda.appendChild(p)
    divDeuda.appendChild(divDebt)
    divDeudaUser.appendChild(divDeuda)

    const btnPagar = document.createElement("BUTTON");
    btnPagar.className = "text-white text-lg flex items-center justify-center sm:w-full md:w-auto uppercase bg-gray-500 dark:bg-gray-700 text-lg py-2 px-6 rounded-sm hover:bg-gray-300 hover:text-gray-800 dark:hover:bg-gray-600 gap-2";
    btnPagar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg><p class="font-bold text-xs">Pagar</p>`;
    btnPagar.onclick = confirmarPago;

    const btnDescRecPorc = document.createElement("BUTTON");
    btnDescRecPorc.className = "text-gray-800 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase bg-gray-200 dark:bg-gray-800 text-xs py-2 px-6 rounded-sm hover:bg-gray-300 dark:hover:bg-gray-600 gap-2";
    btnDescRecPorc.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Descuento</p>`;
    btnDescRecPorc.onclick = formDescRec;

    const btnAvanzados = document.createElement("A");
    btnAvanzados.className = "text-gray-900 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase text-xs py-2 px-6 rounded-sm gap-2";
    btnAvanzados.innerHTML = `<svg class="h-6 w-6 text-gray-900 dark:text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />  <circle cx="12" cy="12" r="3" /></svg><p class="font-bold text-xs">Configurar</p>`;
    btnAvanzados.href = `/consultar-avanzados?usuario=${resUser.id}`;

    divBoton.appendChild(btnPagar);
    divBoton.appendChild(btnDescRecPorc);
    divBoton.appendChild(btnAvanzados);
  }

  function confirmarPago() {
    Swal.fire({
      title: `¿Realizar pago por $${formatNum(resDebt.total)} MN?`,
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

      if (resultado.tipo === "Exito") {
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
        consultarInfoUsuario(usuario_informacion.id);
        fechas = [];
      }
    } catch (error) {
      console.log(error);
    }
  }

  function fechaMinMax() {
    const arrayFechas = fechas.map((fechaActual) => new Date(fechaActual));

    const max = new Date(Math.max.apply(null, arrayFechas));
    const min = new Date(Math.min.apply(null, arrayFechas));

    return {
      min,
      max,
    }
  }

  const formDescRec = () => {
    const formulario = document.createElement("FORM");
    formulario.className = "p-4 md:p-5 text-right";
    formulario.innerHTML = `<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>`;
    formulario.onsubmit = (e) => descontarRecParcial(e);
    const h3 = document.createElement("H3");
    h3.className = "mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 text-center";
    h3.textContent = "Ingrese el monto de recargos a descontar";
    const divAlerta = document.createElement('DIV');
    divAlerta.id = 'div-notif';

    const btnChange = document.createElement("BUTTON");
    btnChange.className = "text-xs font-semibold rounded-sm text-yellow-900 hover:bg-yellow-900 hover:text-white border border-yellow-900 px-3 py-1 dark:text-yellow-200 dark:border-yellow-200 dark:hover:bg-yellow-200 dark:hover:text-gray-900 mb-2";
    btnChange.textContent = "Porcentaje";
    btnChange.type = "button";
    btnChange.id = "botton-desc-tipo";
    btnChange.dataset.tipo = 1;
    btnChange.ondblclick = (e) => cambiarTipoDesc(e);

    const input = document.createElement("INPUT");
    input.className = "w-full rounded-lg border border-gray-300 bg-white px-4 py-2 mb-4 text-gray-900 placeholder:text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:placeholder:text-gray-500";
    input.type = "number";
    input.name = "descuento"

    const btnConfirm = document.createElement("BUTTON");
    btnConfirm.className = "text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
    btnConfirm.textContent = "Calcular";
    btnConfirm.onclick = (e) => descontarRecParcial(e);

    formulario.appendChild(h3);
    formulario.appendChild(divAlerta);
    formulario.appendChild(input);
    formulario.appendChild(btnChange);
    formulario.appendChild(btnConfirm);

    Modal.renderModal(formulario, btnConfirm)
  }

  function cambiarTipoDesc(e) {
    e.preventDefault()
    let tipoDesc = e.target;

    tipoDesc.parentElement.querySelector('input').value = "";
    tipoDesc.dataset.tipo === "1" ? tipoDesc.textContent = "Pesos" : tipoDesc.textContent = "Porcentaje";
    tipoDesc.dataset.tipo === "1" ? tipoDesc.dataset.tipo = 2 : tipoDesc.dataset.tipo = 1;
  }

  function descontarRecParcial(e) {
    e.preventDefault();
    const divModal = e.target.parentElement.parentElement;
    const inputs = divModal.querySelectorAll('input')
    PostDatos.crearFormData(inputs);

    const number = divModal.querySelector('input').value;
    const tipo = document.querySelector(".default-modal #botton-desc-tipo").dataset.tipo;
    if (tipo === "1") {
      if (number > 100) {
        Alerta.Toast.fire({
          icon: "error",
          title: "Debe ingresar un porcentaje menor al 100%",
        });
        return;
      }

      const desc_agua = ((number / 100) * resDebt);
      const desc_drain = ((number / 100) * recDrenaje);

      // Swal.fire({
      //     title: "Confirmar descuento",
      //     html: `<p>¿Está seguro de realizar el siguiente descuento?</p>
      //     <ul style="padding:1rem">
      //     <li>Desc Rec Agua: $ ${descA.toFixed(2)} MNX</li>
      //     <li>Desc Rec Drenaje: $ ${descD.toFixed(2)} MNX</li>
      //     </ul>
      //     <p style="font-weight:700; font-size:1.5rem">Total a descontar: $ ${(descA + descD).toFixed(2)} MNX</p>`,
      //     icon: "warning",
      //     showCancelButton: true,
      //     confirmButtonText: "Confirmar",
      //     cancelButtonText: "Cancelar",
      //     reverseButtons: true
      // }).then(result => {
      //     if (result.value) {
      //       console.log('Confirmado');
      //       aplicarDescRecParc(descA, descD);
      //       input.parentElement.parentElement.parentElement.parentElement?.remove();
      //       Toast.fire({
      //         icon: "success",
      //         title: "Descuento aplicado correctamente",
      //       });
      //     }   
      //   });

      //   return;
    }

    // if(number > recAgua + recDrenaje) {
    //   Toast.fire({
    //     icon: "error",
    //     title: `Debe ingresar un monto menor a ${recAgua + recDrenaje}`,
    //   });
    //   return;
    // }

    // const per = (number * 100) / (recAgua + recDrenaje);
    //     const descA = ((per/100) * recAgua);
    //     const descD = ((per/100) * recDrenaje);

    //     Swal.fire({
    //       title: "Confirmar descuento",
    //       html: `<p>¿Está seguro de realizar el siguiente descuento?</p>
    //       <ul style="padding:1rem">
    //           <li>Desc Rec Agua: $ ${descA.toFixed(2)} MNX</li>
    //           <li>Desc Rec Drenaje: $ ${descD.toFixed(2)} MNX</li>
    //       </ul>
    //       <p style="font-weight:700; font-size:1.5rem">Total a descontar: $ ${(descA + descD).toFixed(2)} MNX</p>`,
    //       icon: "warning",
    //       showCancelButton: true,
    //       confirmButtonText: "Confirmar",
    //       cancelButtonText: "Cancelar",
    //       reverseButtons: true
    //   }).then(result => {
    //       if (result.value) {
    //         console.log('Confirmado');
    //        aplicarDescRecParc(descA, descD);
    //        input.parentElement.parentElement.parentElement.parentElement?.remove();
    //        Toast.fire({
    //           icon: "success",
    //           title: "Descuento aplicado correctamente",
    //         });
    //       }   
    //   });
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

    if (deudaGral.recargoDrenaje === 0) {
      divRecAgua.textContent = `$ ${(a - descA - descD).toFixed(2)} MNX`;
      divTot.textContent = `$ ${(Number(t) - descA - descD).toFixed(2)} MNX`;
      return;
    }

    if (deudaGral.recargoAgua === 0) {
      divRecDren.textContent = `$ ${(d - descD - descA).toFixed(2)} MNX`;
      divTot.textContent = `$ ${(Number(t) - descA - descD).toFixed(2)} MNX`;
      return;
    }

    divRecAgua.textContent = `$ ${(a - descA).toFixed(2)} MNX`;
    divRecDren.textContent = `$ ${(d - descD).toFixed(2)} MNX`;
    divTot.textContent = `$ ${(Number(t) - descA - descD).toFixed(2)} MNX`;
  }
})();
