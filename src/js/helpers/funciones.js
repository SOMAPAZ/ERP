const limpiarHTML = (position) => {
  while (position.firstChild) {
    position.removeChild(position.firstChild);
  }
};

export { limpiarHTML };
