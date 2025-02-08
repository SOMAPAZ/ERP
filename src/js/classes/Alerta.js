export default class Alerta {
  constructor({ msg, position }) {
    this.msg = msg;
    this.position = position;

    this.render();
  }

  render() {
    const alerta = document.createElement("div");
    alerta.className = 'text-center w-full text-white bg-red-600 px-5 py-2 font-bold uppercase text-sm rounded alert';
    alerta.textContent = this.msg;

    const alertaPrevia = document.querySelector(".alert");
    alertaPrevia?.remove();

    this.position.appendChild(alerta);

    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}