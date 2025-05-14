
import { saveLocalStorage, getLocalStorage, deleteLocalStorage } from "./helpers/index.js";

(() => {
  const sidebar = document.querySelector("#sidebar-navigation");
  if(sidebar) {
    document.addEventListener("keydown", (e) => {
      if(e.ctrlKey && e.key.toLowerCase() === "q") {
        if(getLocalStorage("sidebar-open")) {
          sidebar.classList.remove("-translate-x-full");
          sidebar.classList.add("translate-x-0");
          deleteLocalStorage("sidebar-open");
        } else {
          sidebar.classList.remove("translate-x-0");
          sidebar.classList.add("-translate-x-full");
          saveLocalStorage("sidebar-open", true);
        }
      }
    })
    const menuBtn = document.querySelector("#show-sidebar");
    const hideBtn = document.querySelector("#hide-sidebar");
    const btnDropdownAdmin = document.querySelector("#dropdown-admin");
    const listAdmin = document.querySelector("#list-admin");
    const btnDropdownCaja = document.querySelector("#dropdown-caja");
    const listCaja = document.querySelector("#list-caja");
    const btnDropdownReportes = document.querySelector("#dropdown-reportes");
    const listReportes = document.querySelector("#list-reportes");
    const btnDropdownTanques = document.querySelector("#dropdown-tanques");
    const listTanques = document.querySelector("#list-tanques");

    if(getLocalStorage("sidebar-open")) {
      sidebar.classList.add("translate-x-0");
    }

    if(getLocalStorage("sidebar-admin-open") === true) {
      listAdmin.classList?.remove("hidden");
    }

    if(getLocalStorage("sidebar-caja-open") === true) {
      listCaja.classList?.remove("hidden");
    }

    if(getLocalStorage("sidebar-reportes-open") === true) {
      listReportes.classList?.remove("hidden");
    }

    if(getLocalStorage("sidebar-tanques-open") === true) {
      listTanques.classList?.remove("hidden");
    }

    menuBtn.addEventListener("click", () => {
      sidebar.classList.remove("-translate-x-full");
      sidebar.classList.add("translate-x-0");
      saveLocalStorage("sidebar-open", true);
    });
    hideBtn.addEventListener("click", () => {
      sidebar.classList.remove("translate-x-0");
      sidebar.classList.add("-translate-x-full");
      deleteLocalStorage("sidebar-open");
    });
    btnDropdownAdmin.addEventListener("click", () => {
      listAdmin.classList.toggle("hidden");
      if(getLocalStorage("sidebar-admin-open")){
        saveLocalStorage("sidebar-admin-open", false)
      } else {
        saveLocalStorage("sidebar-admin-open", true);
      }
    });
    btnDropdownCaja.addEventListener("click", () => {
      listCaja.classList.toggle("hidden");
      if(getLocalStorage("sidebar-caja-open")){
        saveLocalStorage("sidebar-caja-open", false)
      } else {
        saveLocalStorage("sidebar-caja-open", true);
      }
    });
    btnDropdownReportes.addEventListener("click", () => {
      listReportes.classList.toggle("hidden");
      if(getLocalStorage("sidebar-reportes-open")){
        saveLocalStorage("sidebar-reportes-open", false)
      } else {
        saveLocalStorage("sidebar-reportes-open", true);
      }
    });
    btnDropdownTanques.addEventListener("click", () => {
      listTanques.classList.toggle("hidden");
      if(getLocalStorage("sidebar-tanques-open")){
        saveLocalStorage("sidebar-tanques-open", false)
      } else {
        saveLocalStorage("sidebar-tanques-open", true);
      }
    });
  }
})();
