(() => {
    const table = document.querySelector("#adeudo-desglose tbody");
    const btnPagoParcial = document.querySelector("#btn-pago-parcial");
    const btnCondonarParcial = document.querySelector("#btn-condonar-parcial");
    const btnDescRec = document.querySelector("#btn-condonar-recargos");
    const periodoLabel = document.querySelector("#periodo-label");
    let seleccionados = [];
    let valoresParcial = {};
    let adeudos = [];
    let datos_usuario = [];
    let totalMeses = 0;
    let valoresPago = {};
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

    document.addEventListener("DOMContentLoaded", () => {
        obtenerAdeudos();
        btnPagoParcial.addEventListener("click", () => {
          obtenerActivos('pagar');
        });
        btnCondonarParcial.addEventListener("click", () => {
          obtenerActivos('condonar');
        });

        // btnDescRec.addEventListener("click", recargosDesc);
    });

    async function obtenerAdeudos() {
        const formData = new FormData();
        formData.append("id_user", idUsusuario());
        try {
          const URL = `${location.origin}/api/deuda-mostrar`;
          const response = await fetch(URL, {
            method: "POST",
            body: formData,
          });
          const resultado = await response.json();
          adeudos = resultado.deuda_usuario;
          datos_usuario = resultado.data_usuario;

          const mesesRezago = [...adeudos].reduce((acc, curr) => acc + Number(
            curr.if_recargo === "1" ? curr.if_recargo : 0
          ), 0);
          
          totalMeses = mesesRezago;
          
          renderAdeudos();
        } catch (error) {
          console.log(error);
        }
    }

    function renderAdeudos() {
      
      limpiarHTML(periodoLabel);
      limpiarHTML(table);
      const d1 = new Date(`${adeudos[0].year}-${adeudos[0].mes}-07`);
      const d2 = new Date(`${adeudos[adeudos.length - 1].year}-${adeudos[adeudos.length - 1].mes}-07`);
      
        const date1 = d1.toLocaleDateString("es-MX", {
          year: "numeric",
          month: "long"
        });
        const date2 = d2.toLocaleDateString("es-MX", {
          year: "numeric",
          month: "long"
        });

        const divDate = document.createElement("DIV");
        divDate.className = "flex items-end justify-between rounded-lg border border-gray-200 bg-white p-2 dark:border-gray-800 dark:bg-gray-900 shadow-sm mb-6";
        const pDate = document.createElement("P");
        pDate.className = "text-sm text-gray-500 dark:text-gray-400 mx-auto";
        pDate.innerHTML = `Periodo Adeudado: <span class='text-gray-700 uppercase font-bold dark:text-white'>(${date1} - ${date2})</span>`;
        
        divDate.appendChild(pDate);
        periodoLabel.appendChild(divDate);

        doHead();

        adeudos.map((adeudo) => {
            const tr = document.createElement("TR");
            tr.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";

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
            tdMontoAgua.textContent = adeudo.monto_agua;

            const drenaje = datos_usuario.drenaje === "1" ? adeudo.monto_agua * 0.25 : 0;
            const tdMontoDrenaje = document.createElement("TD");
            tdMontoDrenaje.className = "px-4 py-1";
            tdMontoDrenaje.textContent = drenaje.toFixed(4)

            const recargoAgua = adeudo.monto_agua * 0.0113 * totalMeses;
            const tdRecargoAgua = document.createElement("TD");
            tdRecargoAgua.className = "px-4 py-1";
            const totRecAgua = recargoAgua <= 0 ? 0 : recargoAgua;
            tdRecargoAgua.textContent = totRecAgua.toFixed(4);
            
            const recargoDrenaje = drenaje * 0.0113 * totalMeses;
            const tdRecargoDrenaje = document.createElement("TD");
            tdRecargoDrenaje.className = "px-4 py-1";
            const totRecDrenaje = recargoDrenaje <= 0 ? 0 : recargoDrenaje;
            tdRecargoDrenaje.textContent = totRecDrenaje.toFixed(4);
            totalMeses--;

            const ivaAgua = (parseInt(datos_usuario.id_tipo_toma) === 2) ? 0 : adeudo.monto_agua * 0.16;
            const tdIvaAgua = document.createElement("TD");
            tdIvaAgua.className = "px-4 py-1";
            tdIvaAgua.textContent = ivaAgua;

            const ivaDrenaje = parseInt(datos_usuario.drenaje) ? (drenaje * 0.16) : 0;
            const tdIvaDrenaje = document.createElement("TD");
            tdIvaDrenaje.className = "px-4 py-1";
            tdIvaDrenaje.textContent = ivaDrenaje.toFixed(4);

            const tdTotal = document.createElement("TD");
            tdTotal.className = "px-4 py-1";
            tdTotal.textContent = 
                (parseFloat(adeudo.monto_agua) + 
                parseFloat(drenaje) + 
                parseFloat(totRecAgua) + 
                parseFloat(totRecDrenaje) + 
                parseFloat(ivaAgua) + 
                parseFloat(ivaDrenaje))
                    .toFixed(2);

            const tdAcciones = document.createElement("TD");
            tdAcciones.className = "flex px-4 py-1 items-center";
            const btnPagar = document.createElement("BUTTON");
            btnPagar.className = "font-medium text-blue-600 dark:text-blue-500 hover:underline";
            btnPagar.textContent = "Pagar";
            btnPagar.onclick = obtenerValores;

            const btnCondonar = document.createElement("BUTTON");
            btnCondonar.className = "font-medium text-red-600 dark:text-red-500 hover:underline ms-3";
            btnCondonar.textContent = "Condonar";
            btnCondonar.onclick = condonarUnico;
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

    function doHead(){
        const trMain = document.createElement("TR");
        trMain.className = "whitespace-nowrap bg-gray-100 border-b dark:bg-gray-700 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600";

        const tdCheckboxMain = document.createElement("TD");
        tdCheckboxMain.className = "w-4 p-4";
        tdCheckboxMain.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>`;

        const tdYearMain = document.createElement("TH");
        tdYearMain.scope = "row";
        tdYearMain.className = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
        tdYearMain.textContent = 'Todos';

        const tdMesMain = document.createElement("TD");
        tdMesMain.className = "px-6 py-4";
        tdMesMain.textContent = 'Todos';

        const subtotalAgua = [...adeudos].reduce((acc, curr) => acc + Number(curr.monto_agua), 0);
        const tdMontoAguaMain = document.createElement("TD");
        tdMontoAguaMain.className = "px-6 py-4";
        tdMontoAguaMain.textContent = subtotalAgua.toFixed(2);

        let subtotalDrenaje = 0;
        if(parseInt(datos_usuario.drenaje)) {
          subtotalDrenaje = [...adeudos].reduce((acc, curr) => acc + (Number(curr.monto_agua) * 0.25), 0);
        }
        const tdMontoDrenajeMain = document.createElement("TD");
        tdMontoDrenajeMain.className = "px-6 py-4";
        tdMontoDrenajeMain.textContent = subtotalDrenaje.toFixed(4)


        let totalRezagoAgua = 0;
        let totalRezagoDrenaje = 0;
    
        const mesesRezago = [...adeudos].reduce((acc, curr) => acc + Number(curr.if_recargo), 0);
        for(let i = 0; i < mesesRezago; i++) {
          totalRezagoAgua += Number(adeudos[i].monto_agua * 0.0113 * (i+1));
    
          if(parseInt(datos_usuario.drenaje)) {
            totalRezagoDrenaje += Number((adeudos[i].monto_agua * 0.25) * 0.0113 * (i+1));
          }
        }

        const tdRecargoAguaMain = document.createElement("TD");
        tdRecargoAguaMain.className = "px-6 py-4";
        tdRecargoAguaMain.textContent = totalRezagoAgua.toFixed(4);

        const tdRecargoDrenajeMain = document.createElement("TD");
        tdRecargoDrenajeMain.className = "px-6 py-4";
        tdRecargoDrenajeMain.textContent = totalRezagoDrenaje.toFixed(4);

        const valorToma = parseInt(datos_usuario.id_tipo_toma) !== 2;
        
        let subtotalAguaIVA = 0;
        if(valorToma) {
          subtotalAguaIVA = subtotalAgua * 0.16;
        } 

        const subtotalDrenajeIVA = subtotalDrenaje * 0.16;

        const tdIVAAguaMain = document.createElement("TD");
        tdIVAAguaMain.className = "px-6 py-4";
        tdIVAAguaMain.textContent = subtotalAguaIVA.toFixed(4);

        const tdIVADrenajeMain = document.createElement("TD");
        tdIVADrenajeMain.className = "px-6 py-4";
        tdIVADrenajeMain.textContent = subtotalDrenajeIVA.toFixed(4);

        const tdTotal = document.createElement("TD");
        tdTotal.className = "px-6 py-4";
        tdTotal.textContent = (subtotalAgua + subtotalDrenaje + subtotalAguaIVA + subtotalDrenajeIVA + totalRezagoAgua + totalRezagoDrenaje).toFixed(2);

        const tdAcciones = document.createElement("TD");
        tdAcciones.className = "flex items-center px-6 py-4";
        const btnTotal = document.createElement("BUTTON");
        btnTotal.className = "font-bold text-gray-500 dark:text-gray-400";
        btnTotal.textContent = "Sin acción";
        tdAcciones.appendChild(btnTotal);

        trMain.appendChild(tdCheckboxMain)
        trMain.appendChild(tdYearMain)
        trMain.appendChild(tdMesMain)
        trMain.appendChild(tdMontoAguaMain)
        trMain.appendChild(tdRecargoAguaMain)
        trMain.appendChild(tdIVAAguaMain)
        trMain.appendChild(tdMontoDrenajeMain)
        trMain.appendChild(tdRecargoDrenajeMain)
        trMain.appendChild(tdIVADrenajeMain)
        trMain.appendChild(tdTotal)
        trMain.appendChild(tdAcciones)
        table.appendChild(trMain)
    }

    function obtenerValores(e) {
        const fila = e.target.parentElement.parentElement;
        const celdaYear = fila.querySelector("th").textContent;
        const celdaMes = fila.querySelector("td:nth-child(3)").textContent;
        const celdaAgua = fila.querySelector("td:nth-child(4)").textContent;
        const celdaAguaRec = fila.querySelector("td:nth-child(5)").textContent;
        const celdaAguaIVA = fila.querySelector("td:nth-child(6)").textContent;
        const celdaDrenaje = fila.querySelector("td:nth-child(7)").textContent;
        const celdaDrenajeRec = fila.querySelector("td:nth-child(8)").textContent;
        const celdaDrenajeIVA = fila.querySelector("td:nth-child(9)").textContent;
        const celdaTotal = fila.querySelector("td:nth-child(10)").textContent;

        valoresPago = {
            celdaYear, 
            celdaMes, 
            celdaAgua, 
            celdaAguaRec, 
            celdaAguaIVA, 
            celdaDrenaje, 
            celdaDrenajeRec, 
            celdaDrenajeIVA, 
            celdaTotal
        };

        confirmarPago();
    }

    function confirmarPago() {
        Swal.fire({
            title: `¿Realizar pago por ${valoresPago.celdaTotal} mxn?`,
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
        const formData = new FormData();
        formData.append("id_user", idUsusuario());
        formData.append("mes_inicio", `${valoresPago.celdaYear}-${valoresPago.celdaMes}-07`);
        formData.append("mes_fin", `${valoresPago.celdaYear}-${valoresPago.celdaMes}-07`);
        formData.append("monto_agua", valoresPago.celdaAgua);
        formData.append("monto_drenaje", valoresPago.celdaDrenaje);
        formData.append("monto_iva_agua", valoresPago.celdaAguaIVA);
        formData.append("monto_iva_drenaje", valoresPago.celdaDrenajeIVA);
        formData.append("monto_recargo_agua", valoresPago.celdaAguaRec);
        formData.append("monto_recargo_drenaje", valoresPago.celdaDrenajeRec);
        formData.append("recargos", valoresPago.celdaDrenajeRec);
        formData.append("numero_meses", 1);
        formData.append("tipo_pago", document.querySelector('input[name="tipo_pago"]:checked').value);
        formData.append("total", valoresPago.celdaTotal);

        try {
            const URL = `${location.origin}/api/pago-unico`;
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
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.open(`pdf/recibo?folio=${resultado.folio}&id=${datos_usuario.id}`, '_blank');
                  }
                });
                resetAndReload();
            }
        } catch (error) {
            console.log(error);
        }
    }

    function condonarUnico(e) {
      const fila = e.target.parentElement.parentElement;
      const celdaYear = fila.querySelector("th").textContent;
      const celdaMes = fila.querySelector("td:nth-child(3)").textContent;
      const celdaTotal = fila.querySelector("td:nth-child(10)").textContent;
      const objCond = {};

      objCond.year = celdaYear;
      objCond.mes = celdaMes;
      objCond.montoTotal = celdaTotal;

      Swal.fire({
          title: `¿Realizar condonación por ${celdaTotal} mxn?`,
          text: "Esta acción si se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Confirmar pago",
          cancelButtonText: "Cancelar",
      }).then((result) => {
          if (result.isConfirmed) {
              guardarCondonacion(objCond);
          }
      });
    }

    async function guardarCondonacion(objCond) {
      const formData = new FormData();
      formData.append("id_user", idUsusuario());
      formData.append("mes", objCond.mes);
      formData.append("year", objCond.year);

      try {
        const URL = `${location.origin}/api/condonacion-unico`;
        const response = await fetch(URL, {
          method: "POST",
          body: formData,
        });
        const resultado = await response.json();

        console.log(resultado);
        
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

    function limpiarHTML(div) {
        while (div.firstChild) {
          div.removeChild(div.firstChild);
        }
    }

    function obtenerActivos(cond) {
        const checks = table.querySelectorAll("input[type='checkbox']:checked");
        
        if(checks.length === 0) {
            Swal.fire({
                title: "Error",
                text: "Debe seleccionar al menos un registro",
                icon: "error",
            });

            return;
        }

        checks.forEach(check => {
            const objSeleccionado = {};
            const fila = check.parentElement.parentElement;

            const celdaYear = fila.querySelector("th").textContent;
            const celdaMes = fila.querySelector("td:nth-child(3)").textContent;
            const celdaMontoAgua = fila.querySelector("td:nth-child(4)").textContent;
            const celdaRecAgua = fila.querySelector("td:nth-child(5)").textContent;
            const celdaIvaAgua = fila.querySelector("td:nth-child(6)").textContent;
            const celdaMontoDrenaje = fila.querySelector("td:nth-child(7)").textContent;
            const celdaRecDrenaje = fila.querySelector("td:nth-child(8)").textContent;
            const celdaIvaDrenaje = fila.querySelector("td:nth-child(9)").textContent;
            const celdaMontoTotal = fila.querySelector("td:nth-child(10)").textContent;
            
            objSeleccionado.year = celdaYear;
            objSeleccionado.mes = celdaMes;
            objSeleccionado.montoAgua = celdaMontoAgua;
            objSeleccionado.recargoAgua = celdaRecAgua;
            objSeleccionado.ivaAgua = celdaIvaAgua;
            objSeleccionado.montoDrenaje = celdaMontoDrenaje;
            objSeleccionado.recargoDrenaje = celdaRecDrenaje;
            objSeleccionado.ivaDrenaje = celdaIvaDrenaje;
            objSeleccionado.montoTotal = celdaMontoTotal;
            
            const existe = seleccionados.some(item => item.year === objSeleccionado.year && item.mes === objSeleccionado.mes);

            existe ? seleccionados = [... seleccionados] : seleccionados = [...seleccionados, objSeleccionado];
        })

        confirmarOperacionParcial(cond);
    }

    function confirmarOperacionParcial(cond) {
      const tot = seleccionados.reduce((acum, item) => acum + Number(item.montoTotal), 0);
        Swal.fire({
            title: `Confirmar ${cond === "pagar" ? "pago" : "condonación"} parcial`,
            html: `<p>¿Está seguro de ${cond === "pagar" ? "pagar" : "condonar"} los siguientes meses?</p>
            <ul style="padding:1rem">
                ${seleccionados.map(item => `<li style="text-transform: uppercase; text-align:left;">${crearFecha(item.year, item.mes)}: $ ${item.montoTotal} MNX</li>`).join("")}
            </ul>
            <p style="font-weight:700; font-size:1.5rem">Total a ${cond === "pagar" ? "pagar" : "condonar"}: $ ${tot.toFixed(2)} MNX</p>`,
            icon: "warning",
            showCancelButton: true,
            showDenyButton: cond === "pagar" ? true : false,
            confirmButtonText: "Confirmar",
            denyButtonText: "Desc Rec",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then(result => {
            if (result.isConfirmed) {
               cond === "pagar" ? pagarParcial() : condonarParcial();
            } else if (result.isDenied) {
              modalRecargosDesc();
            }
        });
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

    function idUsusuario() {
        const idParams = new URLSearchParams(window.location.search);
        const usuario = Object.fromEntries(idParams.entries());
        return usuario.usuario;
    }

    function crearFecha(year, mes) {
        const fecha = new Date();
        fecha.setFullYear(year);
        fecha.setMonth(mes - 1);
        
        const fechaEnFormato = fecha.toLocaleDateString("es-ES", {
            year: "numeric",
            month: "long",
        });
        
        return fechaEnFormato;
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

    //Recargos Desc
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
      // btnChange.ondblclick = cambiarTipoDesc;
  
      const input = document.createElement("INPUT");
      input.className = "w-full rounded-lg border border-gray-300 bg-white px-4 py-2 mb-4 text-gray-900 placeholder:text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:placeholder:text-gray-500";
      input.type = "number";
  
      
      const btnConfirm = document.createElement("BUTTON");
      btnConfirm.className = "text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
      btnConfirm.textContent = "Calcular";
      // btnConfirm.onclick = () => {
      //   if(input.value.trim() === "" || parseFloat(input.value) <= 0) {
      //     Toast.fire({
      //       icon: "error",
      //       title: "Debe ingresar un monto",
      //     });
      //     return;
      //   }
  
      //   descontarRecParcial();
      // }
  
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
})();