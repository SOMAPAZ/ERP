import Alerta from "../classes/Alerta.js";
import { limpiarHTML, formatNum, roundAndFloat } from '../helpers/index.js';

(() => {
  const formConsultarSig = document.querySelector("#formConsultarSig");
  const btnSelectorPeriodo = document.querySelector("#btn-selector-periodo");
  const btnPagarDeuda = document.querySelector("#realizar-pago");
  const mostrarModalCargosExtras = document.querySelector("#mostrarModalCargosExtras");

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
    const form = document.querySelector("#formPeriodo");
    const selectMes = document.querySelector("#mes_periodo");
    form.addEventListener("submit", (e) => {
      if(!selectMes.value) {
        e.preventDefault();
        Alerta.ToastifyError("Debe seleccionar un periodo para poder continuar");
        return;
      }
    });
    btnSelectorPeriodo.addEventListener("click", () => {
      const selectorPeriodoModal = document.querySelector("#selectorPeriodoModal");
      selectorPeriodoModal.classList.remove('hidden');
      setTimeout(() => selectorPeriodoModal.classList.remove('opacity-0'), 10);
    })

    btnClosePeriodoModal.addEventListener("click", () => {
      const selectorPeriodoModal = document.querySelector("#selectorPeriodoModal");
      selectorPeriodoModal.classList.add('opacity-0');
      setTimeout(() => selectorPeriodoModal.classList.add('hidden'), 300);
    })
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
    const btnAgregarCargoExtra = document.querySelector("#agregar-cargo-extra");
    const montoTotal = document.querySelector("#monto-total").textContent;
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
    });

    const btnCloseExtrasModal = document.querySelector("#btnCloseExtrasModal");
    mostrarModalCargosExtras.addEventListener('click', () => {
      const modalCargosExtras = document.querySelector("#ModalCargosExtras");
      modalCargosExtras.classList.remove('hidden');
      setTimeout(() => modalCargosExtras.classList.remove('opacity-0'), 10);
    })
    btnCloseExtrasModal.addEventListener("click", () => {
      const modalCargosExtras = document.querySelector("#ModalCargosExtras");
      modalCargosExtras.classList.add('opacity-0');
      setTimeout(() => modalCargosExtras.classList.add('hidden'), 300);
    })

    function mostrarEnPantalla(cargosExtras) {
      Alerta.ToastifySuccess("Se ha agregado el cargo correctamente");
      const cardPago = document.querySelector("#desglose-extras");
      const montoTotalSpan = document.querySelector("#monto-total");
      limpiarHTML(cardPago);

      cargosExtras.forEach(cargo => {
        const subTotal = Number(cargo.costo) * Number(cargo.cantidad);
        const iva = cargo.costo_iva ? subTotal * IVA : 0;
        const total = subTotal + iva;
        const paragraph = document.createElement("p");
        paragraph.className = "text-gray-500 flex justify-between gap-3";
        paragraph.innerHTML = `
          <span>${cargo.name}</span>
          <span class="uppercase text-black">$ ${formatNum(roundAndFloat(total))}</span>
        `
        cardPago.appendChild(paragraph);
      })

      const totalExtras = cargosExtras.reduce((acc, act) => Number(acc) + Number(act.costo) + (act.costo_iva ? Number(act.costo) * IVA : 0), 0);
      montoTotalSpan.textContent = roundAndFloat(totalExtras + Number(montoTotal));
    }
  }
})();
