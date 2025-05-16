import Toastify from 'toastify-js';
import Swal from 'sweetalert2';

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

    static Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });

    static ToastifyError(msg) {
      Toastify({
        text: msg,
        duration: 3000,
        style: {
            background: "linear-gradient(to right, #e7000b, #c10007)",
            color: "#fff",
            boxShadow: "0 0 20px rgba(0, 0, 0, 0.5)",
        },
      }).showToast();
    }
    static ToastifySuccess(msg) {
      Toastify({
        text: msg,
        duration: 3000,
        style: {
            background: "linear-gradient(to right, #00b300, #007a00)",
            color: "#fff",
            boxShadow: "0 0 20px rgba(0, 0, 0, 0.5)",
        },
      }).showToast();
    }
}