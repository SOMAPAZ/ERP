import { formatDateText, getSearch } from "../helpers/index.js";
import GetDatos from "../classes/GetData.js";
import Alerta from "../classes/Alerta.js";

(() => {
    const table = document.querySelector("#adeudo-desglose tbody");
    const btnPagoParcial = document.querySelector("#btn-pago-parcial");
    const btnCondonarParcial = document.querySelector("#btn-condonar-parcial");
    const btnDescRec = document.querySelector("#btn-condonar-recargos");
    const periodoLabel = document.querySelector("#periodo-label");
    let seleccionados = [];
    let valoresParcial = {};
    let datos_usuario = [];

    let resUser = [];
    let resDebtParcial = [];
    let resDebt = [];
    let copiaDebt = [];
    let arrayCond = [];
    let arrayPagos = [];

    document.addEventListener("DOMContentLoaded", () => {
        obtenerAdeudos();
        btnPagoParcial.addEventListener("click", () => {
          obtenerActivos();
        });
        btnCondonarParcial.addEventListener("click", () => {
          obtenerActivos(true);
        });

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
          checkbox.className = "w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 cursor-pointer";
          tdCheckbox.appendChild(checkbox);

          const tdYear = document.createElement("TH");
          tdYear.scope = "row";
          tdYear.className = "px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white";
          tdYear.textContent = adeudo.year;

          const tdMes = document.createElement("TD");
          tdMes.className = "px-4 py-1";
          tdMes.textContent = adeudo.mes;

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

          const tdTotal = document.createElement("TD");
          tdTotal.className = "px-4 py-1";
          tdTotal.textContent = adeudo.total.general

          const tdAcciones = document.createElement("TD");
          tdAcciones.className = "flex px-4 py-1 items-center";
          const btnPagar = document.createElement("BUTTON");
          btnPagar.className = "font-medium text-blue-800 dark:text-blue-500 hover:underline text-xs uppercase font-black py-1";
          btnPagar.textContent = "Pagar";
          btnPagar.onclick = () => confirmarAccion(adeudo);

          const btnCondonar = document.createElement("BUTTON");
          btnCondonar.className = "font-medium text-red-800 dark:text-red-700 hover:underline ms-3 text-xs uppercase font-black py-1";
          btnCondonar.textContent = "Condonar";
          btnCondonar.onclick = () => confirmarAccion(adeudo, true);

          tdAcciones.appendChild(btnPagar);
          tdAcciones.appendChild(btnCondonar);

          tr.appendChild(tdCheckbox);
          tr.appendChild(tdYear);
          tr.appendChild(tdMes);
          tr.appendChild(tdMontoAgua);
          tr.appendChild(tdRecargoAgua);
          tr.appendChild(tdIvaAgua);
          tr.appendChild(tdMontoDrenaje);
          tr.appendChild(tdRecargoDrenaje);
          tr.appendChild(tdIvaDrenaje);
          tr.appendChild(tdTotal);
          tr.appendChild(tdAcciones);
          table.appendChild(tr);
      });
    }

    const confirmarAccion = (adeudo, condonacion = false) => {
        Swal.fire({
            title: condonacion ? `¿Realizar condonación por $${adeudo.total.general} MN?` : `¿Realizar pago por $${adeudo.total.general} MN?`,
            text: "Esta acción lleva un proceso de cancelación",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: condonacion ? "Confirmar condonación" : "Confirmar pago",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                condonacion ? guardarCondonacion() : guardarPago();
            }
        });
    }

    async function guardarPago() {
      console.log('Pagando...')
      // if(resultado.tipo === "Exito") {
      //     Swal.fire({
      //       title: `Pago guardado correctamente con folio ${resultado.folio}`,
      //       text: "El pago se ha guardado correctamente",
      //       icon: "success",
      //       confirmButtonText: "Mostrar recibo",
      //       allowOutsideClick: false,
      //       allowEscapeKey: false,
      //     }).then((result) => {
      //       if (result.isConfirmed) {
      //         window.open(`pdf/recibo?folio=${resultado.folio}&id=${datos_usuario.id}`, '_blank');
      //       }
      //     });
      //     resetAndReload();
      // }
    }

    async function guardarCondonacion() {
      console.log('Condonando...')
    }

    function obtenerActivos(condonacion = false) {
        const checks = table.querySelectorAll("input[type='checkbox']:checked");
        
        if(checks.length === 0) {
            Alerta.Toast.fire({
              icon: 'error',
              title: 'Campos vacíos',
              text: 'Debe seleccionar al menos dos meses'
            })

            return;
        }

        checks.forEach(check => {
            const fila = check.parentElement.parentElement;
            const existePagoSelect = arrayPagos.find(pago => pago == fila.dataset.idx)
            if(!existePagoSelect) arrayPagos = [...arrayPagos, fila.dataset.idx]

          })

        console.log(arrayPagos)
    }

    function formarData() {
        const totalAgua = seleccionados.reduce((acum, item) => acum + Number(item.montoAgua), 0);
        const totalDrenaje = seleccionados.reduce((acum, item) => acum + Number(item.montoDrenaje), 0);
        const totalRecAgua = seleccionados.reduce((acum, item) => acum + Number(item.recargoAgua), 0);
        const totalRecDrenaje = seleccionados.reduce((acum, item) => acum + Number(item.recargoDrenaje), 0);
        const totalIvaAgua = seleccionados.reduce((acum, item) => acum + Number(item.ivaAgua), 0);
        const totalIvaDrenaje = seleccionados.reduce((acum, item) => acum + Number(item.ivaDrenaje), 0);
        const total = totalAgua + totalDrenaje + totalRecAgua + totalRecDrenaje + totalIvaAgua + totalIvaDrenaje;

        const fechaInicial = new Date(seleccionados[0].year, seleccionados[0].mes - 1, 7);
        const fechaFinal = new Date(seleccionados[seleccionados.length - 1].year, seleccionados[seleccionados.length - 1].mes - 1, 7);
        
        const fechaI = fechaInicial.toLocaleDateString("es-ES", {
            year: "numeric",
            month: "numeric",
            day: "numeric",
        });
        
        const fechaF = fechaFinal.toLocaleDateString("es-ES", {
            year: "numeric",
            month: "numeric",
            day: "numeric",
        });

        const meses = seleccionados.length;
        const tipoPago = document.querySelector('input[name="tipo_pago"]:checked').value;

        valoresParcial = {
            totalAgua,
            totalDrenaje,
            totalRecAgua,
            totalRecDrenaje,
            totalIvaAgua,
            totalIvaDrenaje,
            total,
            fechaI,
            fechaF,
            meses,
            tipoPago
        };
    }

    async function pagarParcial() {
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

    async function condonarParcial() {
      const fechaInicial = new Date(seleccionados[0].year, seleccionados[0].mes - 1, 7);
      const fechaFinal = new Date(seleccionados[seleccionados.length - 1].year, seleccionados[seleccionados.length - 1].mes - 1, 7);
      
      const fechaI = fechaInicial.toLocaleDateString("es-ES", {
          year: "numeric",
          month: "numeric",
          day: "numeric",
      });
      
      const fechaF = fechaFinal.toLocaleDateString("es-ES", {
          year: "numeric",
          month: "numeric",
          day: "numeric",
      });

      const dataCond = new FormData();
      dataCond.append("id_user", idUsusuario());
      dataCond.append("mes_inicio", fechaI);
      dataCond.append("mes_fin", fechaF);

      try {
        const URL = `${location.origin}/api/condonacion-parcial`;
        const response = await fetch(URL, {
          method: "POST",
          body: dataCond
        });
        const resultado = await response.json();
        
        if(resultado.tipo === "Exito") {
          Toast.fire({
            icon: "success",
            title: resultado.mensaje,
          });

          resetAndReload();
        }
      } catch (error) {
        console.log(error)
      }
    }

    function resetAndReload() {
      seleccionados = [];
      valoresParcial = {};
      adeudos = [];
      datos_usuario = [];
      totalMeses = 0;
      valoresPago = {};
      obtenerAdeudos();
    }

})();