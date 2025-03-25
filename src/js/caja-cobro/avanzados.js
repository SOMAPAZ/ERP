import { formatDateText, getSearch, limpiarHTML, formatNum, formatDateMY, getLocalStorage } from "../helpers/index_v1.js";
import GetDatos from "../classes/GetData_v1.js";
import Alerta from "../classes/Alerta_v1.js";
import PostDatos from "../classes/PostData_v1.js";

(() => {
    const table = document.querySelector("#adeudo-desglose tbody");
    const btnPagoParcial = document.querySelector("#btn-pago-parcial");
    const btnCondonarParcial = document.querySelector("#btn-condonar-parcial");
    const btnDescRec = document.querySelector("#btn-condonar-recargos");
    const periodoLabel = document.querySelector("#periodo-label");
    let valoresParcial = {};
    let datos_usuario = [];

    let resUser = [];
    let resDebtParcial = [];
    let resDebt = [];
    let arraySeleccionados = [];
    let proximoPagar = [];
    let costosAdicionales = [];

    document.addEventListener("DOMContentLoaded", () => {
        obtenerAdeudos();
        btnPagoParcial.addEventListener("click", () => obtenerActivos());
        btnCondonarParcial.addEventListener("click", () => obtenerActivos(true));
        // btnDescRec.addEventListener("click", recargosDesc);
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

      resDebtParcial.map((adeudo) => {
          const tr = document.createElement("TR");
          tr.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";
          tr.dataset.idx = adeudo.idxDB

          const tdCheckbox = document.createElement("TD");
          tdCheckbox.className = "w-4 py-1 px-4";
          const checkbox = document.createElement('INPUT');
          checkbox.type = "checkbox";
          checkbox.className = "w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 cursor-pointer disabled:cursor-not-allowed";
          (adeudo.medido.lectura_actual > 0 && resUser.id_servicetype === "Medido") || resUser.id_servicetype === "Fijo"  ? checkbox.disabled = false : checkbox.disabled = true;
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

    const obtenerActivos = (condonacion = false) => {
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

        confirmarActualizacion(condonacion);
    }

    async function pagar() {
      console.log(proximoPagar)
      console.log(costosAdicionales)

      return;
      
      formarData();
      const data = new FormData();
      data.append("id_user", idUsusuario());
      data.append("mes_inicio", valoresParcial.fechaI);
      data.append("mes_fin", valoresParcial.fechaF);
      data.append("monto_agua", valoresParcial.totalAgua.toFixed(2));
      data.append("monto_drenaje", valoresParcial.totalDrenaje.toFixed(2));
      data.append("monto_iva_agua", valoresParcial.totalIvaAgua.toFixed(2));
      data.append("monto_iva_drenaje", valoresParcial.totalIvaDrenaje.toFixed(2));
      data.append("monto_recargo_agua", valoresParcial.totalRecAgua.toFixed(2));
      data.append("monto_recargo_drenaje", valoresParcial.totalRecDrenaje.toFixed(2));
      data.append("numero_meses", valoresParcial.meses);
      data.append("tipo_pago", valoresParcial.tipoPago);
      data.append("total", valoresParcial.total.toFixed(2));

      try {
          const URL = `${location.origin}/api/pago-parcial`;
          const response = await fetch(URL, {
              method: "POST",
              body: data
          });

          const resultado = await response.json();
          console.log(resultado);

          if(resultado.tipo === "Exito") {
            Swal.fire({
              title: `Pago guardado correctamente con folio ${resultado.folio}`,
              text: "El pago se ha guardado correctamente",
              icon: "success",
              confirmButtonText: "Mostrar recibo",
              allowOutsideClick: false,
              allowEscapeKey: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.open(`pdf/recibo?folio=${resultado.folio}&id=${datos_usuario.id}`, '_blank');
              }
            });

            resetAndReload();
          }
      } catch (error) {
          console.log(error)
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
      copiaDebt = [];
      proximoPagar = [];
      obtenerAdeudos();
    }

    const confirmarActualizacion = (condonacion) => {
      let aPagar = [];
      let selects = arraySeleccionados.map( arr => aPagar = [...aPagar, resDebtParcial.find(item => item.idxDB == arr)]);
      proximoPagar = selects[selects.length - 1];

      costosAdicionales = getLocalStorage('costosAdicionales') ? getLocalStorage('costosAdicionales') : [];

      Swal.fire({
        title: `Desea realizar ${condonacion ? 'la siguiente condonación' : 'el siguiente pago'} `,
        html: `<p>¿Está seguro de ${condonacion ? "condonar" : "pagar"} los siguientes meses?</p>
            <ul style="padding:1rem">
                ${proximoPagar.map(item => `
                  <li style="text-transform: uppercase; text-align:left;">
                    ${formatDateMY(item.fecha)} - $ ${formatNum(item.total.general_excedido)} MXN
                  </li>`).join("")}
            </ul>
            <hr/>
                ${ costosAdicionales.length > 0 ? 
                    costosAdicionales.map(costo => `
                        <p style="text-transform: uppercase; text-align:left; margin-top:1rem;">Costos adicionales</p>
                        <li style="text-transform: uppercase; text-align:left; margin-top:1rem;">
                            ${costo.cuenta} - $ ${formatNum(costo.cantidad)} MXN
                        </li>`).join("")
                    :
                    '<li style="text-transform: uppercase; text-align:left; margin-top:1rem;">No hay costos adicionales</li>'
                }
            `,
        showDenyButton: true,
        confirmButtonText: "Aplicar",
        denyButtonText: 'No aplicar'
      }).then((result) => {
        if (result.isConfirmed) {
          condonacion ? condonar() : pagar();
        } else if (result.isDenied) {
          Swal.fire("Cambios no aplicados", "", "warning");
        }
      });
    }
})();