export default class Alerta {
  constructor({ msg, position }) {
    this.msg = msg;
    this.position = position;

    this.render();
  }

  render() {
    const alerta = document.createElement("div");
    alerta.className = 'w-full bg-red-200 text-red-800 text-sm my-2 py-2 px-4 rounded text-center font-bold alert';
    alerta.textContent = this.msg;

    const alertaPrevia = document.querySelector(".alert");
    alertaPrevia?.remove();

    this.position.appendChild(alerta);

    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}