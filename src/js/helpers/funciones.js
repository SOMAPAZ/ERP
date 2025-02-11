const limpiarHTML = (position) => {
  while (position.firstChild) {
    position.removeChild(position.firstChild);
  }
};

const formatNum = (num) => {
  return num.toLocaleString("en-US")
}

export { limpiarHTML, formatNum };
