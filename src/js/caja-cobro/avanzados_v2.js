import { formatDateText, getSearch, limpiarHTML, formatNum, formatDateMY, getLocalStorage, roundAndFloat, deleteLocalStorage } from "../helpers/index_v1.js";
import GetDatos from "../classes/GetData_v1.js";
import Alerta from "../classes/Alerta_v1.js";
import PostDatos from "../classes/PostData_v1.js";
import Descuento from "../classes/Descuento_v1.js";

(() => {
    const table = document.querySelector("#adeudo-desglose tbody");
    const btnCalcular = document.querySelector("#btn-calcular-parcial");

    const divBtnAcciones = document.querySelector("#div-btn-acciones");
    const btnPagoParcial = document.querySelector("#btn-pago-parcial");
    const btnCondonarParcial = document.querySelector("#btn-condonar-parcial");
    const btnDescRec = document.querySelector("#realizar-desc");
    const btnEliminarDes = document.querySelector("#eliminar-desc");
    const periodoLabel = document.querySelector("#periodo-label");
    const parrafoMonto = document.querySelector("#monto-seleccionado");
    const radioInputs = document.querySelectorAll('input[name="tipo_pago"]');

    let resUser = [];
    let resDebtParcial = [];
    let resDebt = [];
    let arraySeleccionados = [];
    let proximoPagar = [];
    let costosAdicionales = [];
    let recargosDescuentoAgua = 0;
    let recargosDescuentoDren = 0;
    let tipoPago = 1;

    document.addEventListener("DOMContentLoaded", () => {
        obtenerAdeudos();
        btnCalcular.addEventListener("click", checkboxesActivos);
        btnPagoParcial.addEventListener("click", () => confirmarActualizacion());
        btnCondonarParcial.addEventListener("click", () => confirmarActualizacion(true));
        btnDescRec.addEventListener("click", recargosDesc);
        radioInputs.forEach(inp => inp.addEventListener('click', () => {tipoPago = inp.value}));
    });

    const obtenerAdeudos = async () => {
      const id = getSearch().usuario;

      const urlUser = `${location.origin}/api/usuario?id=${id}`;
      const urlDebt = `${location.origin}/deuda-usuario?id=${id}`;
      const urlDebtParcial = `${location.origin}/deuda-desglosada?id=${id}`;
  
      [resUser, resDebt, resDebtParcial] = await Promise.all([
          GetDatos.consultar(urlUser),
          GetDatos.consultar(urlDebt),
          GetDatos.consultar(urlDebtParcial)
      ])

      renderAdeudos()
    }

    const renderAdeudos = () => {
      limpiarHTML(periodoLabel);
      limpiarHTML(table);

      const paragPeriodo = document.createElement('P');
      paragPeriodo.className = 'text-center my-5 py-5 text-sm uppercase font-bold border border-dashed border-gray-300 rounded dark:bg-gray-700 dark:text-gray-300';
      paragPeriodo.textContent = `Periodo: ${formatDateText(resDebt.periodo.inicio)} a ${formatDateText(resDebt.periodo.final)}`;
      periodoLabel.appendChild(paragPeriodo);

      let indice = 0;
      resDebtParcial.map((adeudo) => {
          const tr = document.createElement("TR");
          tr.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";
          tr.dataset.idx = adeudo.idxDB

          const tdCheckbox = document.createElement("TD");
          tdCheckbox.className = "w-4 py-1 px-4";
          const checkbox = document.createElement('INPUT');
          checkbox.type = "checkbox";
          checkbox.dataset.indice = ++indice;
          checkbox.className = "w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 cursor-pointer disabled:cursor-not-allowed";
          (adeudo.medido.lectura_actual > 0 && resUser.id_servicetype === "Medido") || resUser.id_servicetype === "Fijo"  ? checkbox.disabled = false : checkbox.disabled = true;
          checkbox.onclick = () => {
            if(!divBtnAcciones.classList.contains("hidden")) divBtnAcciones.classList.add("hidden");
          }
          tdCheckbox.appendChild(checkbox);

          const tdYear = document.createElement("TH");
          tdYear.scope = "row";
          tdYear.className = "px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white";
          tdYear.textContent = adeudo.year;

          const tdMes = document.createElement("TD");
          tdMes.className = "px-4 py-1";
          tdMes.textContent = adeudo.mes;

          const tdMontoTarifa = document.createElement("TD");
          tdMontoTarifa.className = "px-4 py-1";
          tdMontoTarifa.textContent = adeudo.tarifa;

          const tdMontoDesc = document.createElement("TD");
          tdMontoDesc.className = "px-4 py-1";
          tdMontoDesc.textContent = adeudo.tarifa -adeudo.agua;

          const tdMontoAgua = document.createElement("TD");
          tdMontoAgua.className = "px-4 py-1";
          tdMontoAgua.textContent = adeudo.agua;

          const tdMontoDrenaje = document.createElement("TD");
          tdMontoDrenaje.className = "px-4 py-1";
          tdMontoDrenaje.textContent = adeudo.drenaje
          
          const tdMontoDrenajeDesc = document.createElement("TD");
          tdMontoDrenajeDesc.className = "px-4 py-1";
          tdMontoDrenajeDesc.textContent = adeudo.desc_drenaje

          const tdRecargoAgua = document.createElement("TD");
          tdRecargoAgua.className = "px-4 py-1";
          tdRecargoAgua.textContent = adeudo.rec_agua
          
          const tdRecargoDrenaje = document.createElement("TD");
          tdRecargoDrenaje.className = "px-4 py-1";
          tdRecargoDrenaje.textContent = adeudo.rec_drain

          const tdIvaAgua = document.createElement("TD");
          tdIvaAgua.className = "px-4 py-1";
          tdIvaAgua.textContent = adeudo.iva_agua;

          const tdIvaDrenaje = document.createElement("TD");
          tdIvaDrenaje.className = "px-4 py-1";
          tdIvaDrenaje.textContent = adeudo.iva_drenaje;

          const tdSubTotal = document.createElement("TD");
          tdSubTotal.className = "px-4 py-1";
          tdSubTotal.textContent = adeudo.total.general

          tr.appendChild(tdCheckbox);
          tr.appendChild(tdYear);
          tr.appendChild(tdMes);
          tr.appendChild(tdMontoTarifa);
          tr.appendChild(tdMontoDesc);
          tr.appendChild(tdMontoAgua);
          tr.appendChild(tdRecargoAgua);
          tr.appendChild(tdIvaAgua);
          tr.appendChild(tdMontoDrenaje);
          tr.appendChild(tdMontoDrenajeDesc);
          tr.appendChild(tdRecargoDrenaje);
          tr.appendChild(tdIvaDrenaje);

          if(resUser.id_servicetype === "Medido") {
            const tdLectura = document.createElement("TD");
            tdLectura.className = "px-4 py-1";
            tdLectura.textContent = adeudo.medido.lectura_actual;

            const tdDiferenciaLectura = document.createElement("TD");
            tdDiferenciaLectura.className = "px-4 py-1";
            tdDiferenciaLectura.textContent = adeudo.medido.diferencia_lectura_anterior;

            const tdExcedido = document.createElement("TD");
            tdExcedido.className = "px-4 py-1";
            tdExcedido.textContent = adeudo.medido.excedido;

            const tdCostoLectura = document.createElement("TD");
            tdCostoLectura.className = "px-4 py-1";
            tdCostoLectura.textContent = adeudo.medido.costo_excedido;

            const tdIvaLim = document.createElement("TD");
            tdIvaLim.className = "px-4 py-1";
            tdIvaLim.textContent = adeudo.medido.iva_lim_exc;

            const tdTotal = document.createElement("TD");
            tdTotal.className = "px-4 py-1 text-right";
            tdTotal.textContent = adeudo.total.general_excedido;
            tr.appendChild(tdLectura);
            tr.appendChild(tdDiferenciaLectura);
            tr.appendChild(tdExcedido);
            tr.appendChild(tdCostoLectura);
            tr.appendChild(tdIvaLim);
            tr.appendChild(tdTotal);
            table.appendChild(tr);
            return;
          }
          
          tr.appendChild(tdSubTotal);
          table.appendChild(tr);

        });
    }

    const checkboxesActivos = () => {
      arraySeleccionados = [];

      const checkboxes = table.querySelectorAll("input[type='checkbox']:checked");
      
      if(checkboxes.length === 0) {
          Alerta.Toast.fire({
            icon: 'error',
            title: 'Campos vacíos',
            text: 'Debe seleccionar al menos un mes'
          })

          return;
      }

      let arr = [];
      checkboxes.forEach(check => arr = [...arr, +check.dataset.indice]);
      const arrAscend = arr.sort((a, b) => b - a);
      const esSaltado = arrAscend.slice(1).map((num, i) => arr[i] - num === 1 ? true : false);

      if(esSaltado.includes(false)) {
        Swal.fire({
          icon: 'error',
          title: 'Campos saltados',
          text: 'No puede seleccionar un mes que no sea consecutivo'
        })

        proximoPagar = [];
        return;
      }

      checkboxes.forEach(check => {
          const fila = check.parentElement.parentElement;
          const existePagoSelect = arraySeleccionados.find(pago => pago == fila.dataset.idx)
          if(!existePagoSelect) arraySeleccionados = [...arraySeleccionados, fila.dataset.idx]
      })

      let aPagar = [];
      let selects = arraySeleccionados.map( arr => aPagar = [...aPagar, resDebtParcial.find(item => item.idxDB == arr)]);
      proximoPagar = selects[selects.length - 1];

      costosAdicionales = getLocalStorage('costosAdicionales') ? getLocalStorage('costosAdicionales') : [];

      divBtnAcciones.classList?.remove("hidden");
      divBtnAcciones.classList.contains("flex") ? '' : divBtnAcciones.classList.add("flex");
      btnEliminarDes.classList.contains("hidden") ? '' : btnEliminarDes.classList.add("hidden");
      btnDescRec.classList.contains("hidden") ? btnDescRec.classList.remove("hidden") : '';

      mostrarValores();
    }

    const recargosDesc = () => {
      arraySeleccionados = [];
      const checks = table.querySelectorAll("input[type='checkbox']:checked");

      if(checks.length === 0) {
        Alerta.Toast.fire({
          icon: 'error',
          title: 'Campos vacíos',
          text: 'Debe seleccionar al menos un mes'
        })

        return;
      }
        
      checks.forEach(check => {
          const fila = check.parentElement.parentElement;
          const existePagoSelect = arraySeleccionados.find(pago => pago == fila.dataset.idx)
          if(!existePagoSelect) arraySeleccionados = [...arraySeleccionados, fila.dataset.idx]
      })

      const btnConfirm = document.createElement("BUTTON");
      btnConfirm.className = "text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
      btnConfirm.textContent = "Calcular";
      btnConfirm.onclick = e => descuentoRecargos(e);

      Descuento.formularioDescuentoRecargos(btnConfirm);
    }

    const descuentoRecargos = (e) => {
      e.preventDefault();

      let aPagar = [];
      let selects = arraySeleccionados.map( arr => aPagar = [...aPagar, resDebtParcial.find(item => item.idxDB == arr)]);
      proximoPagar = selects[selects.length - 1];

      const recargosTotalesAgua = proximoPagar.reduce((acum, item) => acum + item.rec_agua, 0);
      const recargosTotalesDren = proximoPagar.reduce((acum, item) => acum + item.rec_drain, 0);

      const divModal = e.target.parentElement.parentElement;
      const inputs = divModal.querySelectorAll('input')
      const res = PostDatos.crearFormData(inputs);
      if(!res) return;
      
      const number = divModal.querySelector('input').value;
      let descuentoAplicado = 0;
      const tipo = document.querySelector(".default-modal #botton-desc-tipo").dataset.tipo;

      if(tipo === "1") {

          if(number > 100) {
              Alerta.Toast.fire({
                  icon: "error",
                  title: "Debe ingresar un porcentaje menor al 100%",
              });
              return;
          }

          descuentoAplicado = number;
      }
          
      if(tipo === "2") {
          const pesos = parseFloat(number)
          if(pesos > (recargosTotalesAgua + recargosTotalesDren)) {
            Alerta.Toast.fire({
                icon: "error",
                title: "Debe ingresar una cantidad menor al total de recargos",
            });
            return;
          }
          descuentoAplicado = (pesos * 100) / (recargosTotalesAgua + recargosTotalesDren)
      }
      
      recargosDescuentoAgua = recargosTotalesAgua * (descuentoAplicado/100);
      recargosDescuentoDren = recargosTotalesDren * (descuentoAplicado/100);
      const totAguaRec = proximoPagar.reduce(( acc, item ) => acc + item.rec_agua, 0);
      const totDrenDesc = proximoPagar.reduce(( acc, item ) => acc + item.rec_drain, 0);
      const totalSuma = proximoPagar.reduce(( acc, item ) => acc + item.total.general_excedido, 0);
      

      btnDescRec.classList.add("hidden");
      btnEliminarDes.classList.remove("hidden");
      btnEliminarDes.onclick = () => {
        recargosDescuentoAgua = 0;
        recargosDescuentoDren = 0;
        btnEliminarDes.classList.add("hidden");
        btnDescRec.classList.remove("hidden");
        document.querySelector('#monto-agua-rec').innerHTML = `Rec Agua: <span class='font-normal'>$ ${formatNum(roundAndFloat(totAguaRec))}</span>`;
        document.querySelector('#monto-drenaje-rec').innerHTML = `Rec Drenaje: <span class='font-normal'>$ ${formatNum(roundAndFloat(totDrenDesc))}</span>`;
        document.querySelector('#total-pago').innerHTML = `Total de $ ${formatNum(roundAndFloat(totalSuma))} MN`;
      };

      document.querySelector('#monto-agua-rec').innerHTML = `Rec Agua: <span class='font-normal'>$ ${formatNum(roundAndFloat(totAguaRec - recargosDescuentoAgua))}</span>`;
      document.querySelector('#monto-drenaje-rec').innerHTML = `Rec Drenaje: <span class='font-normal'>$ ${formatNum(roundAndFloat(totDrenDesc - recargosDescuentoDren))}</span>`;
      document.querySelector('#total-pago').innerHTML = `Total de $ ${formatNum(roundAndFloat(totalSuma - recargosDescuentoAgua - recargosDescuentoDren))} MN`;
      document.querySelector('.default-modal')?.remove();
    }

    const pagar = async () => {
      resDebt.agua_inicial = proximoPagar.reduce((acum, item) => acum + +item.tarifa, 0);
      resDebt.agua = proximoPagar.reduce((acum, item) => acum + +item.agua, 0);
      resDebt.m3_excedido_agua = (proximoPagar.reduce((acum, item) => acum + +item.medido.costo_excedido, 0)) * 0.75;
      resDebt.drenaje_inicial = proximoPagar.reduce((acum, item) => acum + +item.drenaje, 0);
      resDebt.drenaje = proximoPagar.reduce((acum, item) => acum + +item.drenaje, 0);
      resDebt.m3_excedido_drenaje = (proximoPagar.reduce((acum, item) => acum + +item.medido.costo_excedido, 0)) * 0.25;
      resDebt.periodo.inicio = proximoPagar[0].fecha;
      resDebt.periodo.final = proximoPagar[proximoPagar.length - 1].fecha;
      resDebt.recargos.agua = proximoPagar.reduce((acum, item) => acum + +item.rec_agua, 0);
      resDebt.recargos.drenaje = proximoPagar.reduce((acum, item) => acum + +item.rec_drain, 0);
      resDebt.descuentos.agua = proximoPagar.reduce((acum, item) => acum + +item.desc_agua, 0);
      resDebt.descuentos.drenaje = proximoPagar.reduce((acum, item) => acum + +item.desc_drenaje, 0);
      resDebt.meses.totales = proximoPagar.length;
      resDebt.iva.agua = proximoPagar.reduce((acum, item) => acum + +item.iva_agua, 0);
      resDebt.iva.drenaje = proximoPagar.reduce((acum, item) => acum + +item.iva_drenaje, 0);
      resDebt.iva.m3_excedido_agua = (proximoPagar.reduce((acum, item) => acum + +item.medido.iva_lim_exc, 0)) * 0.75;
      resDebt.iva.m3_excedido_drenaje = (proximoPagar.reduce((acum, item) => acum + +item.medido.iva_lim_exc, 0)) * 0.25;
      resDebt.total = proximoPagar.reduce( (acc, item) => acc + item.total.general_excedido, 0);
      
      const montosAgrupados = [
        {id_user: getSearch().usuario},
        {resDebt},
        {descuentoAgua: proximoPagar.reduce((acum, item) => acum + +item.desc_agua, 0)},
        {descuentoRecargoAgua: recargosDescuentoAgua},
        {descuentoDren: proximoPagar.reduce((acum, item) => acum + +item.desc_drenaje, 0)},
        {descuentoRecargoDren: recargosDescuentoDren},
        {tipoPago}, 
        {adicionales: costosAdicionales},
        {seleccionado: arraySeleccionados}
      ];
      
      const formData = new FormData();
        formData.append("montos", JSON.stringify(montosAgrupados));

        try {
            const URL = `${location.origin}/api/pago-total`
            const response = await fetch(URL, {
                method: "POST",
                body: formData,
            });
            const resultado = await response.json();

          if(resultado.tipo === "Exito") {
            resetAndReload();
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
                    window.open(`pdf/recibo?folio=${resultado.folio}&id=${getSearch().usuario}`, '_blank');
                }
          });
        }
      } catch (error) {
            console.log(error);
      }
      
    }

    const condonar = async () => {
      const url = `${location.origin}/condonacion-parcial`
      const res = await PostDatos.enviarArray(url, arraySeleccionados)
      
      if(res.tipo === 'Exito') {
        Swal.fire({
          icon: 'success',
          title: res.title,
          text: res.text
        })

        resetAndReload();
      }
    }

    const resetAndReload = () => {
      resDebtParcial = [];
      resDebt = [];
      proximoPagar = [];
      costosAdicionales = [];
      obtenerAdeudos();
      limpiarHTML(parrafoMonto);
      limpiarHTML(document.querySelector('#listado-adicionales ul'));
      document.querySelector('#listado-adicionales ul').innerHTML = `<li class="text-center font-bold text-gray-700 dark:text-gray-200">No hay costos adicionales</li>`;
      divBtnAcciones.classList.contains("hidden") ? '' : divBtnAcciones.classList.add("hidden");
      parrafoMonto.textContent = 'Sin meses seleccionados';
      document.querySelector('#notas-form').reset();
    }

    const mostrarValores = () => {
      const total = proximoPagar.reduce( (acc, item) => acc + item.total.general_excedido, 0);

      limpiarHTML(parrafoMonto);
      const pTotal = document.createElement('P');
      pTotal.id = 'total-pago';
      pTotal.textContent = `Total de $ ${formatNum(roundAndFloat(total))} MN`;

      const listadoTotal = document.createElement('UL');
      listadoTotal.className = "text-gray-800 dark:text-white text-sm flex flex-col md:flex-row justify-center md:justify-between px-6";

      const liMontoAgua = document.createElement('LI');
      const totAgua = proximoPagar.reduce(( acc, item ) => acc + item.tarifa, 0);
      liMontoAgua.innerHTML = `Agua: <span class='font-normal'>$ ${formatNum(roundAndFloat(totAgua))}</span>`;

      const liMontoAguaDesc = document.createElement('LI');
      const totAguaDesc = proximoPagar.reduce(( acc, item ) => acc + item.desc_agua, 0);
      liMontoAguaDesc.innerHTML = `Desc Agua: <span class='font-normal'>$ ${formatNum(roundAndFloat(totAguaDesc))}</span>`;

      const liMontoAguaRec = document.createElement('LI');
      liMontoAguaRec.id = 'monto-agua-rec';
      const totAguaRec = proximoPagar.reduce(( acc, item ) => acc + item.rec_agua, 0);
      liMontoAguaRec.innerHTML = `Rec Agua: <span class='font-normal'>$ ${formatNum(roundAndFloat(totAguaRec))}</span>`;

      const liMontoAguaIVA = document.createElement('LI');
      const totAguaIVA = proximoPagar.reduce(( acc, item ) => acc + item.iva_agua, 0);
      liMontoAguaIVA.innerHTML = `IVA Agua: <span class='font-normal'>$ ${formatNum(roundAndFloat(totAguaIVA))}</span>`;

      const liMontoDren = document.createElement('LI');
      const totDren = proximoPagar.reduce(( acc, item ) => acc + item.drenaje, 0);
      liMontoDren.innerHTML = `Drenje: <span class='font-normal'>$ ${formatNum(roundAndFloat(totDren))}</span>`;

      const liMontoDrenDesc = document.createElement('LI');
      const totDrenDesc = proximoPagar.reduce(( acc, item ) => acc + item.desc_drenaje, 0);
      liMontoDrenDesc.innerHTML = `Desc Drenje: <span class='font-normal'>$ ${formatNum(roundAndFloat(totDrenDesc))}</span>`;

      const liMontoDrenRec = document.createElement('LI');
      liMontoDrenRec.id = 'monto-drenaje-rec';
      const totDrenRec = proximoPagar.reduce(( acc, item ) => acc + item.rec_drain, 0);
      liMontoDrenRec.innerHTML = `Rec Drenje: <span class='font-normal'>$ ${formatNum(roundAndFloat(totDrenRec))}</span>`;

      const liMontoDrenIVA = document.createElement('LI');
      const totDrenIVA = proximoPagar.reduce(( acc, item ) => acc + item.iva_drenaje, 0);
      liMontoDrenIVA.innerHTML = `IVA Drenje: <span class='font-normal'>$ ${formatNum(roundAndFloat(totDrenIVA))}</span>`;
      
      listadoTotal.appendChild(liMontoAgua);
      listadoTotal.appendChild(liMontoAguaRec);
      listadoTotal.appendChild(liMontoAguaDesc);
      listadoTotal.appendChild(liMontoAguaIVA);
      listadoTotal.appendChild(liMontoDren);
      listadoTotal.appendChild(liMontoDrenRec);
      listadoTotal.appendChild(liMontoDrenDesc);
      listadoTotal.appendChild(liMontoDrenIVA);

      parrafoMonto.appendChild(pTotal);
      parrafoMonto.appendChild(listadoTotal);
    }

    const confirmarActualizacion = (condonacion = false) => {
      costosAdicionales = getLocalStorage('costosAdicionales') ? getLocalStorage('costosAdicionales') : [];
     
      if (condonacion && costosAdicionales.length > 0) {
        Swal.fire({
          icon: 'error',
          title: 'No puedes condonar con cuentas extras',
          text: 'Debes eliminar las cuentas antes de condonar, por favor recargue la página (Ctrl + R)'
        })
        return;
      }

      const total = proximoPagar.reduce( (acc, item) => acc + item.total.general_excedido, 0);
      const totalCostos = costosAdicionales.reduce( (acc, item) => acc + (+item.cantidad + ( item.iva === "1" ? +item.cantidad * 0.16 : 0)), 0);

      resDebt.nota = document.querySelector('#notas').value;
      Swal.fire({
        title: `Desea realizar ${condonacion ? 'la siguiente condonación' : 'el siguiente pago'} por  ${formatNum(roundAndFloat(total + totalCostos))} MXN`,
        html: `<p>¿Está seguro de ${condonacion ? "condonar" : "pagar"} los siguientes meses?</p>
            <ul style="padding:1rem">
                ${proximoPagar.map(item => `
                  <li style="text-transform: uppercase; text-align:left;">
                    ${formatDateMY(item.fecha)} - $ ${formatNum(item.total.general_excedido)} MXN
                  </li>`).join("")}
            </ul>
            <hr/>
                ${ !condonacion ?
                  (costosAdicionales.length > 0) ? 
                  `<p style="text-transform: uppercase; text-align:left; margin-top:1rem;">Costos adicionales</p>
                    ${costosAdicionales.map(costo => `
                        <li style="text-transform: uppercase; text-align:left; margin-top:1rem;">
                            ${costo.cuenta} - $ ${formatNum(+costo.cantidad + ( costo.iva === "1" ? +costo.cantidad * 0.16 : 0))} MXN
                        </li>`).join("")}`
                    :
                    '<li style="text-transform: uppercase; text-align:left; margin-top:1rem;">No hay costos adicionales</li>'
                    : ''
                }
            `,
        showDenyButton: true,
        confirmButtonText: "Aplicar",
        denyButtonText: 'No aplicar'
      }).then((result) => {
        if (result.isConfirmed) {
          condonacion ? condonar() : pagar();
        }
      });
    }
})();