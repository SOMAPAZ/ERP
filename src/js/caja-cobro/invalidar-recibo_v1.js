import Alerta from "../classes/Alerta_v1.js";
import PostDatos from "../classes/PostData_v1.js";

(() => {
    const btnsCancelar = document.querySelectorAll('.cancelar-recibo');
    let seleccionado = [];

    document.addEventListener('DOMContentLoaded', () => {
        btnsCancelar.forEach(btn => btn.addEventListener('click', obtenerDataSet));
    });

    const obtenerDataSet = e => {
        seleccionado = e.target;
        const folio = +e.target.dataset.recibo;
        
        Swal.fire({
            title: `Desea cancelar el recibo ${folio}?`,
            text: 'Esta acción no se puede deshacer',
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Cancelar recibo",
            cancelButtonText: "Cerrar",
          }).then(result => result.isConfirmed ? invalidarRecibo(folio) : Swal.fire("Recibo no cancelado", "", "warning"));
    }

    const invalidarRecibo = async (folio) => {
        const URL = `${location.origin}/cancelar-recibo`;

        try {
            const res = await PostDatos.eliminarDatos(URL, folio);
            
            if(res.tipo === "Exito") {
                Alerta.Toast.fire({
                    icon: "success",
                    title: "Recibo cancelado",
                    text: "El recibo ha sido cancelado correctamente"
                });
            }
            location.reload();
        } catch (error) {
            console.log(error);
        }
    }
})()