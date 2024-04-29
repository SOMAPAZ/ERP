let input = document.getElementById("usuario");
input.addEventListener("keyup", (e) => {
  let inputValue = input.value.trim(); // Eliminar espacios en blanco al principio y al final

  if (inputValue === "") {
    // Si el campo de entrada está vacío
    removeElements(); // Eliminar la lista
    return; // Salir de la función
  }

  // Fetch materials from server
  fetch("/reports/data-consult/get_info_usuarios.php?search=" + inputValue)
    .then((response) => response.json())
    .then((data) => {
      removeElements(); // Clear previous results
      data.forEach((usuario) => {
        let listItem = document.createElement("li");
        listItem.classList.add("list-items");
        listItem.style.cursor = "pointer";
        listItem.setAttribute(
          "onclick",
          "displayNames('" + usuario.usuario + "')"
        );
        listItem.textContent = usuario.usuario;
        document.querySelector(".list").appendChild(listItem);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

function displayNames(value) {
  input.value = value;
  removeElements();
}

function removeElements() {
  let items = document.querySelectorAll(".list-items");
  items.forEach((item) => {
    item.remove();
  });
}
