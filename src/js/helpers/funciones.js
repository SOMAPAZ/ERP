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

export { limpiarHTML, formatNum, roundAndFloat };
