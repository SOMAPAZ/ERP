const limpiarHTML = (position) => {
  while (position.firstChild) {
    position.removeChild(position.firstChild);
  }
};

const formatNum = (num) => {
  return num.toLocaleString("en-US")
}

const roundAndFloat = (number) => {
  return parseFloat(number.toFixed(2));
}

const getSearch = () => {
  const params = new URLSearchParams(window.location.search);
  const objParams = Object.fromEntries(params.entries());
  return objParams;
}

const saveLocalStorage = (name, value) => {
  localStorage.setItem(name, JSON.stringify(value))
}

const getLocalStorage = (name) => {
  return JSON.parse(localStorage.getItem(name))
}

const deleteLocalStorage = (name) => {
  localStorage.removeItem(name)
}

const formatDateText = (date) => {
  const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
  const fecha = new Date(date);
  return fecha.toLocaleDateString('es-MX', opciones)
}

const formatDateMY = (date) => {
  const opciones = { year: 'numeric', month: 'long'};
  const fecha = new Date(date);
  return fecha.toLocaleDateString('es-MX', opciones)
}

const formatDateD = (date) => {
  const opciones = { day: 'numeric'};
  const fecha = new Date(date);
  return fecha.toLocaleDateString('es-MX', opciones)
}

const abrirModal = (modal) => {
  modal.classList.remove('hidden');
  setTimeout(() => modal.classList.remove('opacity-0'), 10);
}

const cerrarModal = (modal) => {
  modal.classList.add('opacity-0');
  setTimeout(() => modal.classList.add('hidden'), 300);
}

export { limpiarHTML, formatNum, roundAndFloat, getSearch, saveLocalStorage, getLocalStorage, deleteLocalStorage, formatDateText, formatDateMY, formatDateD, abrirModal, cerrarModal };