(() => {
  const menu = document.querySelector("#sidebar");
  const btnMenu = document.querySelector("#btn-menu");
  const btnCerrarMenu = document.querySelector("#btn-cerrar-menu");
  const btnLinks = document.querySelector("#links-button");
  const dropdownLinks = document.querySelector("#dropdown-links");

  btnCerrarMenu.addEventListener("click", () => {
    menu.classList.add("-translate-x-full");
    menu.classList.remove("translate-none");
  });

  btnMenu.addEventListener("click", () => {
    menu.classList.remove("-translate-x-full");
    menu.classList.add("translate-none");
  });

  btnLinks.addEventListener("click", () => {
    dropdownLinks.classList.toggle("hidden");
  });
})();
