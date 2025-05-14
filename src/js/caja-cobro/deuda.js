import Alerta from "../classes/Alerta.js";
import { getSearch } from "../helpers/index.js";

(() => {
  const formConsultarSig = document.querySelector("#formConsultarSig");
  const btnSelectorPeriodo = document.querySelector("#btn-selector-periodo");
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
})();
