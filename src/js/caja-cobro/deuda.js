import Alerta from "../classes/Alerta.js";
import { limpiarHTML, formatNum, roundAndFloat, abrirModal, cerrarModal } from '../helpers/index.js';

(() => {
  const formConsultarSig = document.querySelector("#formConsultarSig");
  const btnSelectorPeriodo = document.querySelector("#btn-selector-periodo");
  const btnPagarDeuda = document.querySelector("#realizar-pago");
  const mostrarModalCargosExtras = document.querySelector("#mostrarModalCargosExtras");
  const mostrarModalDescSubtotal = document.querySelector("#mostrarModalDescSubtotal");
  const mostrarModalDescRecargos = document.querySelector("#mostrarModalDescRecargos");

  if (formConsultarSig) {
    formConsultarSig.addEventListener("submit", (e) => {
      const input = document.querySelector("input");
      if(!input.value) {
        e.preventDefault();
        Alerta.ToastifyError("El campo de búsqueda no puede estar vacío");
        return;
      }
    });
  }

  if(btnSelectorPeriodo) {
    const btnClosePeriodoModal = document.querySelector("#btnClosePeriodoModal");
    const selectorPeriodoModal = document.querySelector("#selectorPeriodoModal");
    const form = document.querySelector("#formPeriodo");
    const selectMes = document.querySelector("#mes_periodo");
    form.addEventListener("submit", (e) => {
      if(!selectMes.value) {
        e.preventDefault();
        Alerta.ToastifyError("Debe seleccionar un periodo para poder continuar");
        return;
      }
    });
    btnSelectorPeriodo.addEventListener("click", () => abrirModal(selectorPeriodoModal))
    btnClosePeriodoModal.addEventListener("click", () => cerrarModal(selectorPeriodoModal))
  }

  if(btnPagarDeuda) {
    btnPagarDeuda.addEventListener("click", async (e) => {
      const formulario = document.querySelector("#form-pago");
      e.preventDefault();
      if(!formulario.querySelector('select').value) {
        Alerta.ToastifyError("Debe seleccionar un método de pago para poder continuar");
        return;
      }
    })
  }

  if(mostrarModalCargosExtras) {
    const formCargoExtra = document.querySelector("#form-cargo-extra");
    const modalCargosExtras = document.querySelector("#ModalCargosExtras")
    const btnAgregarCargoExtra = document.querySelector("#agregar-cargo-extra");
    let cargosExtras = [];
    const IVA = 0.16;

    formCargoExtra.addEventListener("submit", (e) => {
      e.preventDefault();
      const valorSelect = formCargoExtra.querySelector('select');
      const valorCosto = formCargoExtra.querySelector('input[type="number"]').value;
      const addIVA = formCargoExtra.querySelector('input[type="checkbox"]').checked;
      if(!valorSelect.value) {
        Alerta.ToastifyError("Debe seleccionar un cargo para poder continuar");
        return;
      }
      if(!valorCosto) {
        Alerta.ToastifyError("Debe ingresar un costo para poder continuar");
        return;
      }

      const existe = cargosExtras.some(item => item.id === valorSelect.value);
      if(existe) {
        const cargos = cargosExtras.map( cargo => {
          if(cargo.id === valorSelect.value) {
            cargo.cantidad++;
            return cargo;
          } else {
            return cargo;
          }
        })
        cargosExtras = [...cargos];
      } else {
        const infoCargo = {
          id: valorSelect.value,
          name: valorSelect.options[valorSelect.selectedIndex].text,
          cantidad: 1,
          costo: valorCosto,
          costo_iva: addIVA
        }
        cargosExtras = [...cargosExtras, infoCargo];
      }
      formCargoExtra.reset();
      mostrarEnPantalla(cargosExtras);
      cerrarModal(modalCargosExtras);
    });

    const btnCloseExtrasModal = document.querySelector("#btnCloseExtrasModal");
    mostrarModalCargosExtras.addEventListener('click', () => abrirModal(modalCargosExtras))
    btnCloseExtrasModal.addEventListener("click", () => cerrarModal(modalCargosExtras))
    const montoTotalSpan = document.querySelector("#monto-total");
    const spanIVA = document.querySelector("#monto-iva");
    const monto = montoTotalSpan.textContent.replace(',', '');
    const montoIVA = spanIVA.textContent.replace(',', '');

    function mostrarEnPantalla(cargosExtras) {
      Alerta.ToastifySuccess("Se ha agregado el cargo correctamente");
      const cardPago = document.querySelector("#desglose-extras");
      limpiarHTML(cardPago);

      cargosExtras.forEach(cargo => {
        const subTotal = Number(cargo.costo) * Number(cargo.cantidad);

        const paragraph = document.createElement("p");
        paragraph.className = "text-sky-700 flex justify-between gap-3";
        paragraph.innerHTML = `
          <span>${cargo.name}</span>
          <span class="uppercase text-sky-900">$ ${formatNum(roundAndFloat(subTotal))}</span>
        `
        cardPago.appendChild(paragraph);
      })

      const subTotalExtras = cargosExtras.reduce((acc, act) => {
        const subTot = Number(act.costo) * Number(act.cantidad);
        return acc + subTot;
      }, 0);

      const subtotalIVA = cargosExtras.reduce((acc, act) => {
        const subTot = Number(act.costo) * Number(act.cantidad);
        const iva = act.costo_iva ? subTot * IVA : 0;
        return acc + iva;
      }, 0);
      
      montoTotalSpan.textContent = roundAndFloat(subTotalExtras + subtotalIVA + +monto);
      spanIVA.textContent = roundAndFloat(subtotalIVA + +montoIVA);
    }
  }

  if(mostrarModalDescRecargos) {
    const formDescRecargos = document.querySelector("#form-desc-recargos");
    const modalDescRecargos = document.querySelector("#modalDescRecargos");
    const inputDescRec = document.querySelector("#desc_recargos");
    const inputsTipoDesc = document.querySelectorAll('input[name="tipo-desc-rec"]');
    const btnCloseDescRecModal = document.querySelector("#btnCloseDescRecModal");
    const valorRecargos = document.querySelector("#monto-recargos").textContent?.replace(',', '');
    const btnCalcularDesc = document.querySelector("#btnCalcularDesc");
    const spanMontoRecargos = document.querySelector("#span-monto-recargos");
    let factorDesc = 100;
    let descuentoInput = 0;
    let nuevoRecargo = 0;

    mostrarModalDescRecargos.addEventListener("click", () => abrirModal(modalDescRecargos))
    btnCloseDescRecModal.addEventListener("click", () => {
      cerrarModal(modalDescRecargos)
      formDescRecargos.reset();
      spanMontoRecargos.textContent = valorRecargos;
    })

    inputDescRec.addEventListener('input', e => descuentoInput = +e.target.value)
    Array.from(inputsTipoDesc).forEach(inp => inp.addEventListener('input', e => {
      factorDesc = +e.target.value
      inputDescRec.value = 0;
      descuentoInput = 0;
      spanMontoRecargos.textContent = valorRecargos;
    }))

    btnCalcularDesc.addEventListener('click', () => {
      if(descuentoInput === 0) {
        Alerta.ToastifyError("Debe ingresar un valor para el descuento")
        return;
      }

      if(factorDesc === 100) {
        if (descuentoInput > 100) {
          Alerta.ToastifyError("El valor ingresado es mayor al 100%")
          return
        }

        nuevoRecargo = valorRecargos - (descuentoInput/100) * valorRecargos;
      } else {
        if (descuentoInput > valorRecargos) {
          Alerta.ToastifyError("El valor ingresado es mayor al monto de recargos")
          return
        }

        nuevoRecargo = valorRecargos - descuentoInput
      }

      spanMontoRecargos.textContent = roundAndFloat(nuevoRecargo);
    })
  }
})();
