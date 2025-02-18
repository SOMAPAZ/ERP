import { getSearch, formatNum, roundAndFloat, formatDateText } from "../helpers/index.js"
import GetDatos from "../classes/GetData.js";
import PostDatos from "../classes/PostData.js";
import Alerta from "../classes/Alerta.js";
import Modal from "../classes/Modal.js";

(()=> {
    const inputID = document.querySelector('#id_user')
    const inputNombre = document.querySelector('#nombre_usuario')
    const inputTipo = document.querySelector('#tipo_usuario')
    const inputMesinicio = document.querySelector('#mes_inicio')
    const inputMesFin = document.querySelector('#mes_fin')
    const inputTotal = document.querySelector('#total')

    //Solo vista
    const inputTotalAgua = document.querySelector('#total_agua')
    const inputTotalDren = document.querySelector('#total_drenaje')
    const inputTotalRec = document.querySelector('#total_recargos')
    const inputTotalIva = document.querySelector('#total_iva')

    const btnPago = document.querySelector('#realizar-pago')
    const btnDesc = document.querySelector('#realizar-desc')
    const btnCancelDesc = document.querySelector('#eliminar-desc')
    const btnDescInYear = document.querySelector('#descuento-inicio-year')

    const inputsTipoPago = document.querySelectorAll('input[name="tipo_pago"]')

    let descuentoAgua = 0;
    let descuentoRecargoAgua = 0;
    let descuentoDren = 0;
    let descuentoRecargoDren = 0;

    let tipoPago = 0;

    let searchs;
    let resUser = [];
    let resDebt = [];

    let copiaDebt = [];

    document.addEventListener('DOMContentLoaded', () => {
        searchs = getSearch();
        consultar();
        btnPago.addEventListener('click', confirmarPago)
        btnDesc.addEventListener('click', formDescRec)
        inputsTipoPago.forEach(inp => inp.addEventListener('click', () => {tipoPago = inp.value}));
        btnCancelDesc.addEventListener('click', resetear)
        btnDescInYear?.addEventListener('click', descontarInicio)
    })

    const consultar = async () => {
        const id = searchs.usuario;
        const urlUser = `${location.origin}/api/usuario?id=${id}`;
        const urlDebt = `${location.origin}/deuda-usuario?id=${id}`;
    
        [resUser, resDebt] = await Promise.all([
            GetDatos.consultar(urlUser),
            GetDatos.consultar(urlDebt)
        ])

        rellenarInputs(resDebt)
    }

    const rellenarInputs = (response) => {
        inputID.value = resUser.id
        inputNombre.value = `${resUser.user} ${resUser.lastname}`
        inputTipo.value = `${resUser.id_usertype}`;
        inputMesinicio.value = formatDateText(response.periodo.inicio)
        inputMesFin.value = formatDateText(response.periodo.final)
        inputTotal.value = `${formatNum(response.total)} MN`

        //Solo vista
        inputTotalAgua.value = `$ ${formatNum(response.agua)}`
        inputTotalDren.value = `$ ${formatNum(response.drenaje)}`
        inputTotalRec.value = `$ ${formatNum(response.recargos.total)}`
        inputTotalIva.value = `$ ${formatNum(response.iva.total)}`
    }

    const confirmarPago = () => {
        if(tipoPago === 0) {
            Alerta.Toast.fire({
                icon: "warning",
                title: 'Seleccione un tipo de pago',
              });
            return
        }

        Swal.fire({
          title: `¿Abonar $${formatNum(copiaDebt.total ? copiaDebt.total : resDebt.total)} MN?`,
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Confirmar pago",
          cancelButtonText: "Cancelar",
        }).then(result => (result.isConfirmed) ? guardarPago() : '');
    }

    async function guardarPago() {
    const periodo = fechaMinMax();
    const radios = document.querySelectorAll("input[type='radio']");
        radios.forEach(radio => {
            if (radio.checked) {
            deudaGral.tipoPago = radio.value;
            }
    });

    const formData = new FormData();
    formData.append("id_user", usuario_informacion.id);
    formData.append("mes_incio", periodo.min.toLocaleDateString("en-US"));
    formData.append("mes_fin", periodo.max.toLocaleDateString("en-US"));
    formData.append("monto_agua", deudaGral.agua);
    formData.append("monto_drenaje", deudaGral.drenaje);
    formData.append("monto_iva_agua", deudaGral.aguaIVA);
    formData.append("monto_iva_drenaje", deudaGral.drenajeIVA);
    formData.append("monto_recargo_agua", deudaGral.recargoAgua);
    formData.append("monto_recargo_drenaje", deudaGral.recargoDrenaje);
    formData.append("numero_meses", deudaGral.meses);
    formData.append("tipo_pago", deudaGral.tipoPago);
    formData.append("monto_descuento_recargo_agua", RecNaturalAgua ? Number(RecNaturalAgua) : 0);
    formData.append("monto_descuento_recargo_drenaje", RecNaturalDrenaje ? Number(RecNaturalDrenaje) : 0);
    formData.append("total", deudaGral.total);

    try {
        const URL = `${location.origin}/api/pago-total`
        const response = await fetch(URL, {
        method: "POST",
        body: formData,
        });
        const resultado = await response.json();

        if(resultado.tipo === "Exito") {
        Swal.fire({
            title: `Pago guardado correctamente con folio ${resultado.folio}`,
            text: "El pago se ha guardado correctamente",
            icon: "success",
            confirmButtonText: "Mostrar recibo",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false, 
        }).then((result) => {
            if (result.isConfirmed) {
            window.open(`pdf/recibo?folio=${resultado.folio}&id=${usuario_informacion.id}`, '_blank');
            }
        });

        limpiarHTML(document.querySelector("#radio_inputs"));
        limpiarHTML(divBoton);
        consultarInfoUsuario(usuario_informacion.id);
        fechas = [];
        }
    } catch (error) {
        console.log(error);
    }
    }

    const formDescRec = () => {
        const formulario = document.createElement("FORM");
        formulario.className = "p-4 md:p-5";
        formulario.innerHTML = `<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>`;
        formulario.onsubmit = e => e.preventDefault()
        const h3 = document.createElement("H3");
        h3.className = "mb-5 text-lg font-normal text-gray-500 dark:text-gray-400";
        h3.textContent = "Ingrese el monto de recargos a descontar";
        const divAlerta = document.createElement('DIV');
        divAlerta.id = 'div-notif';
    
        const btnChange = document.createElement("BUTTON");
        btnChange.className ="text-xs font-semibold rounded-sm text-yellow-900 hover:bg-yellow-900 hover:text-white border border-yellow-900 px-3 py-1 dark:text-yellow-200 dark:border-yellow-200 dark:hover:bg-yellow-200 dark:hover:text-gray-900 mb-2";
        btnChange.textContent = "Porcentaje";
        btnChange.type = "button";
        btnChange.id = "botton-desc-tipo";
        btnChange.dataset.tipo = 1;
        btnChange.ondblclick = (e) => cambiarTipoDesc(e);
    
        const input = document.createElement("INPUT");
        input.className = "w-full rounded-lg border border-gray-300 bg-white px-4 py-2 mb-4 text-gray-900 placeholder:text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:placeholder:text-gray-500";
        input.type = "number";
        input.name = "descuento"
        
        const btnConfirm = document.createElement("BUTTON");
        btnConfirm.className = "text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
        btnConfirm.textContent = "Calcular";
        btnConfirm.onclick = (e) => descuentoRecargos(e);
    
        formulario.appendChild(h3);
        formulario.appendChild(divAlerta);
        formulario.appendChild(input);
        formulario.appendChild(btnChange);
        formulario.appendChild(btnConfirm); 
    
        Modal.renderModal(formulario, btnConfirm)
    }

    const cambiarTipoDesc = (e) => {
        e.preventDefault()
        let tipoDesc = e.target;

        tipoDesc.parentElement.querySelector('input').value = "";
        tipoDesc.dataset.tipo === "1" ? tipoDesc.textContent = "Pesos" : tipoDesc.textContent = "Porcentaje";
        tipoDesc.dataset.tipo === "1" ? tipoDesc.dataset.tipo = 2 : tipoDesc.dataset.tipo = 1;      
    }

    const descuentoRecargos = (e) => {
        e.preventDefault();
        const divModal = e.target.parentElement.parentElement;
        const inputs = divModal.querySelectorAll('input')
        PostDatos.crearFormData(inputs);

        const number = divModal.querySelector('input').value;
        let descuentoAplicado = 0;
        const tipo = document.querySelector(".default-modal #botton-desc-tipo").dataset.tipo;
        copiaDebt = structuredClone(resDebt);

        if(tipo === "1") {

            if(number > 100) {
            Alerta.Toast.fire({
                icon: "error",
                title: "Debe ingresar un porcentaje menor al 100%",
            });
            return;
            }

            descuentoAplicado = number;
        }
            
        if(tipo === "2") {
            const pesos = parseFloat(number)
            if(pesos > resDebt.recargos.total) {
            Alerta.Toast.fire({
                icon: "error",
                title: "Debe ingresar una cantidad menor al total de recargos",
            });
            return;
            }
            descuentoAplicado = (pesos * 100) / resDebt.recargos.total
        }

        descuentoRecargoAgua = resDebt.recargos.agua * (descuentoAplicado/100)
        descuentoRecargoDren = resDebt.recargos.drenaje * (descuentoAplicado/100)

        copiaDebt.recargos.agua = roundAndFloat(resDebt.recargos.agua - descuentoRecargoAgua)
        copiaDebt.recargos.drenaje = roundAndFloat(resDebt.recargos.drenaje - descuentoRecargoDren)
        copiaDebt.recargos.total = roundAndFloat(resDebt.recargos.total - (resDebt.recargos.total * (descuentoAplicado/100)))
        copiaDebt.total = roundAndFloat(copiaDebt.total - (resDebt.recargos.total * (descuentoAplicado/100)))

        console.log(copiaDebt)
        rellenarInputs(copiaDebt)
        btnDesc.classList.add("hidden")
        btnCancelDesc.classList.remove("hidden")
        document.querySelector('.default-modal')?.remove();
        return;
    }

    const descontarInicio = () => {
        copiaDebt = structuredClone(resDebt);
        if(resDebt.meses.rezagados > 0) {
            Alerta.Toast.fire({
                icon: 'error',
                title: "El usuario debe ir al corriente"
            })
            return;
        }
        
        if(resUser.id_usertype !== 'Normal') {
            Alerta.Toast.fire({
                icon: 'warning',
                title: "Este usuario ya cuenta con su respectivo descuento"
            })
            return;
        }

        descuentoAgua = resDebt.agua - (resDebt.agua * 0.10);
        descuentoDren = resDebt.drenaje - (resDebt.drenaje * 0.10);
        copiaDebt.agua = roundAndFloat(descuentoAgua);
        copiaDebt.drenaje = roundAndFloat(descuentoDren);
        copiaDebt.iva.total = resDebt.iva.total - (resDebt.iva.total * 0.10)
        copiaDebt.total = resDebt.total - (resDebt.total * 0.10)
        
        rellenarInputs(copiaDebt);
        btnDescInYear.classList.add('hidden')

        const btnCancelarDesIn = document.createElement('BUTTON');
        btnCancelarDesIn.className= "bg-red-200 text-red-800 px-4 py-2 rounded-lg font-black text-xs uppercase hover:bg-red-300"
        btnCancelarDesIn.textContent = "Eliminar descuento"
        btnCancelarDesIn.onclick = () => {
            copiaDebt = [];
            rellenarInputs(resDebt);
            btnCancelarDesIn.remove()
            btnDescInYear.classList.remove('hidden')
        }

        btnDescInYear.parentElement.appendChild(btnCancelarDesIn)
    }

    const resetear = () => {
        btnDesc.classList.remove('hidden')
        btnCancelDesc.classList.add('hidden')
        copiaDebt = [];
        rellenarInputs(resDebt)
    }
})()