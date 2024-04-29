// Datos para las subcategorías
const subcategorias = {
  Agua: [
    "Azolve",
    "Nueva toma ó medidor",
    "Poca presión",
    "Sin servicio",
    "Rehubicación de toma",
    "Reconexión",
    "Agua Turbia",
    "Desperdicio",
    "Suspensión",
    "Reparación",
    "Suspencion voluntaria",
    "Reconexion voluntaria",
    "Suministro Tinaco/Pipa",
  ],
  Drenaje: [
    "Fuga",
    "Mal olor",
    "Azolve",
    "Reconexión",
    "Nueva toma",
    "Suspensión",
    "Reparación",
    "Limpieza",
  ],
  ViasPublicas: [
    "Fuga en calle",
    "Hundimiento",
    "Roptura de concreto",
    "Suavizamiento",
    "Limpieza",
    "Rehubicación de tuberia",
    "Alcantarilla",
    "Registro",
  ],
  Visitas: [
    "Inspección de tarifa",
    "Inspección de infraestructura",
    "Inspección de adeudo",
    "Detección de uso",
    "Inspección sanitaria",
    "Verificación especial",
    "Factibilidad",
  ],
};

function cargarSubcategorias() {
  const categoriaSeleccionada =
    document.getElementById("inputGroupSelect").value;
  const subcategoriaSelect = document.getElementById("inputGroupSelect01");

  // Limpiar las opciones actuales
  subcategoriaSelect.innerHTML = "";

  // Obtener las subcategorías para la categoría seleccionada
  const subcategoriasDeCategoria = subcategorias[categoriaSeleccionada];

  // Añadir las nuevas opciones al segundo select
  if (subcategoriasDeCategoria) {
    subcategoriasDeCategoria.forEach((subcategoria) => {
      const option = document.createElement("option");
      option.value = subcategoria;
      option.textContent = subcategoria;
      subcategoriaSelect.appendChild(option);
    });
  }
}

// Cargar las subcategorías al inicio
cargarSubcategorias();
