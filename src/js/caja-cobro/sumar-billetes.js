import GetDatos from "../classes/GetData_v1.js";
import { roundAndFloat, formatNum } from "../helpers/index_v1.js";

(() => {
    const inputBilletes = document.querySelectorAll('.input-billetes');
    const textCambios = document.querySelector('.text-cambios');
    const selectReceptor = document.querySelector('#recibe');
    const textCajera = document.querySelector('.total-cajera');
    const totalSistema = document.querySelector('#total');
    const formulario = document.querySelector('form');
    const inputTotalUsuario = document.querySelector('#total_usuario');
    let arraySelect = [];

    window.addEventListener('unload', () => formulario.reset());

    document.addEventListener('DOMContentLoaded', () => {
        obtenerEmpleados();

        inputBilletes.forEach(input => input.addEventListener('input', sumarBilletes));
    })

    const obtenerEmpleados = async () => {
        const URL = `${location.origin}/api/empleados`;
        const res = await GetDatos.consultar(URL);
        
        res.forEach(empleado => {
            if(empleado.id === '0') return;
            const option = document.createElement('option');
            option.value = empleado.id;
            option.textContent = `${empleado.nombre} ${empleado.apellido}`;
            selectReceptor.appendChild(option);
        })
    }

    const sumarBilletes = e => {
        const cantidad = +e.target.value;
        const denominacion = +e.target.dataset.valor;

        const objData = { denominacion, cantidad, total: cantidad * denominacion };
        const existeDenominacion = arraySelect.find(billete => billete.denominacion === denominacion);
        
        if(existeDenominacion) arraySelect = arraySelect.filter(billete => billete.denominacion !== denominacion);

        arraySelect = [...arraySelect, objData];
        console.log(arraySelect)
        mostrarTotal();
    };

    const mostrarTotal = () => {
        const total = arraySelect.reduce((acc, billete) => acc + billete.total, 0);

        textCajera.textContent = `$ ${formatNum(roundAndFloat(total))} M.N.`;
        inputTotalUsuario.value = total;
        
        if(total === 0) {
            formulario.querySelector('input[type="submit"]').disabled = true;
            textCambios.classList?.remove('text-orange-600');
            textCambios.classList?.remove('text-red-600');
            !textCambios.classList.contains('text-blue-600') ? textCambios.classList.add('text-blue-600') : false;
            textCambios.textContent = 'Ingrese la cantidad de billetes y monedas aún';
            return;
        };

        if(+totalSistema.value - total < 0) {
            textCambios.classList?.remove('text-blue-600');
            textCambios.classList?.remove('text-red-600');
            textCambios.classList.add('text-orange-600');
            textCambios.textContent = 'La cantidad de billetes y monedas sumadas excede el monto del sistema';
            textCajera.textContent = '$ 00.00 M.N.';
            formulario.querySelector('input[type="submit"]').disabled = true;
            return;
        }
        
        if(+totalSistema.value - total > 2) {
            textCambios.classList?.remove('text-blue-600');
            textCambios.classList?.remove('text-orange-600');
            textCambios.classList.add('text-red-600');
            textCambios.textContent = `Los datos difieren por ${formatNum(roundAndFloat(+totalSistema.value - total))}`;
            formulario.querySelector('input[type="submit"]')?.removeAttribute('disabled');
            return;
        }

        if(+totalSistema.value - total < 2) {
            textCambios.classList?.remove('text-red-600');
            textCambios.classList?.remove('text-orange-600');
            textCambios.classList.add('text-blue-600');
            textCambios.textContent = `Los datos difieren por ${formatNum(roundAndFloat(+totalSistema.value - total))}`;
            formulario.querySelector('input[type="submit"]')?.removeAttribute('disabled');
            return;
        }
    }
})()