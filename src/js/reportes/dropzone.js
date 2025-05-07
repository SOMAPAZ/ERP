import Dropzone from "dropzone";
import Alerta from "../classes/Alerta.js";

const dropzoneElement = document.querySelector("#dropzone");
const btnEnviar = document.querySelector("#btn-crear-nota");

if (dropzoneElement && btnEnviar) {
    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone("#dropzone", {
        url: "/crear-nota_reporte",
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 3,
        paramName: "imagenes[]",
        addRemoveLinks: true,
        acceptedFiles: ".png,.jpg,.jpeg",
        dictDefaultMessage: "Arrastra y suelta tus archivos o haz click para seleccionarlos",
        dictRemoveFile: "Borrar Archivos",
    });

    btnEnviar.addEventListener("click", function (e) {
        e.preventDefault();

        const descripcion = document.querySelector("#note").value.trim();
        const idReporte = document.querySelector("#id_report").value;

        if (descripcion === "") {
            new Alerta({
                msg: "Debes agregar una descripción",
                position: document.querySelector(".alerta-vacio"),
            });
            return;
        }

        const formData = new FormData();

        formData.append("note", descripcion);
        formData.append("id_report", idReporte);

        const archivos = dropzone.getAcceptedFiles();
        if (archivos.length === 0) {
            new Alerta({
                msg: "Debes agregar al menos una imagen",
                position: document.querySelector(".alerta-vacio"),
            });
            return;
        }

        archivos.forEach((file, index) => {
            formData.append("imagenes[]", file, file.name);
        });

        fetch("/crear-nota_reporte", {
            method: "POST",
            body: formData,
        })
            .then(async (response) => {
                if (!response.ok) throw new Error("Error al guardar");
                const data = await response.json();
                
                Swal.fire({
                    icon: "success",
                    title: data.tipo,
                    text: data.mensaje,
                    confirmButtonText: "Volver al reporte",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false, 
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `${window.location.origin}/reporte?folio=${idReporte}`;
                    }
                });
            })
            .catch((error) => {
                console.error("Error en el envío:", error);
                Swal.fire({
                    icon: "error",
                    text: "Hubo un error al enviar los datos.",
                    title: "Algo falló.",
                })
            });
    });
}
