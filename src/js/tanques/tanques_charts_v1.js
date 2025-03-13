import GetDatos from '../classes/GetData_v1.js';
import Alerta from '../classes/Alerta_v1.js';
import { formatDateD, limpiarHTML } from '../helpers/index_v1.js'

(() => {
    const selectTanques = document.querySelector('#tanque_id');
    const selectMes = document.querySelector('#number_mes');
    const selectYear = document.querySelector('#number_year');
    const formulario = document.querySelector('#enviar-form');
    const contenedor = document.querySelector('#contenedor-graficas');
    let seleccionado;

    let arrayDias = [];
    let arrayLevel = [];
    let arrayArrived = [];
    let tanques;
    let datos = {
        tanqueId: '',
        mes: '',
        year: '',
    }

    document.addEventListener('DOMContentLoaded', function() {
        obtenerTanques();
        selectTanques.addEventListener('change', setearDatos)
        selectMes.addEventListener('change', e => datos = { ...datos, mes: +e.target.value } )
        selectYear.addEventListener('change', e => datos = { ...datos, year: +e.target.value })
        formulario.addEventListener('submit', obtenerRegistros);
    })

    const obtenerTanques = async () => {
        const url = `${location.origin}/tanques`;
        tanques = await GetDatos.consultar(url);
        
        completarSelect();
    }

    const completarSelect = () => {
        tanques.forEach(tanque => {
            const opcion = document.createElement('OPTION')
            opcion.value = tanque.id,
            opcion.textContent = tanque.nombre
            selectTanques.appendChild(opcion);
        });
    }

    const setearDatos = (e) => {
        if(e.target.value === '') return;
        seleccionado = tanques.find( tanque => tanque.id === e.target.value);
        datos = {
            ...datos,
            tanqueId: seleccionado.id
        }
    }

    const obtenerRegistros = async (e) => {
        e.preventDefault();
        
        if (Object.values(datos).some( element => element === '')) {
            Alerta.Toast.fire({
                icon: 'error',
                title: 'Incompleto',
                text: 'Seleccione todos los parámetros'
            })
            return;
        }

        const url = `${location.origin}/tanques-registros?mes=${datos.mes}&id_tanque=${datos.tanqueId}&year=${datos.year}`;
        const res = await GetDatos.consultar(url);
        
        if(res.length === 0) {
            limpiarHTML(contenedor)
            const p = document.createElement('P');
            p.className = 'p-4 text-gray-800 bg-white font-bold uppercase dark:text-white dark:bg-gray-600 text-center rounded shadow sin-datos'
            p.textContent = 'No hay registros de este periodo o de este tanque';
            contenedor.appendChild(p);
            return;
        }
        
        renderCharts(res);
    }
    
    const renderCharts = (datos) => {
        const divChartLevel = document.createElement('DIV');
        divChartLevel.className = 'bg-white dark:bg-gray-800 shadow rounded sm:p-5 md:p-10'
        const paragLevel = document.createElement('P')
        paragLevel.className = 'text-gray-800 font-bold text-sm uppercase dark:text-white text-center pt-5'
        paragLevel.textContent = `Nivel de agua de ${seleccionado.nombre}`
        
        const divChartArrived = document.createElement('DIV');
        divChartArrived.className = 'bg-white dark:bg-gray-800 shadow rounded sm:p-5 md:p-10'
        const paragArrived = document.createElement('P')
        paragArrived.className = 'text-gray-800 font-bold text-sm uppercase dark:text-white text-center pt-5'
        paragArrived.textContent = `Porcentaje de llegada de ${seleccionado.nombre}`
        
        limpiarHTML(contenedor)
        limpiarHTML(divChartLevel)
        limpiarHTML(divChartArrived)
        
        divChartLevel.appendChild(paragLevel)
        divChartArrived.appendChild(paragArrived)

        contenedor.appendChild(divChartLevel)
        contenedor.appendChild(divChartArrived)

        arrayDias = [];
        arrayLevel = [];
        arrayArrived = [];
        datos.forEach( dato => arrayDias.push(formatDateD(dato.fecha)) )
        datos.forEach( dato => arrayLevel.push(dato.nivel) )
        datos.forEach( dato => arrayArrived.push(dato.llegada) )
        
        const chartConfigLevel = {
            series: [
                {
                name: `Nivel de agua de ${seleccionado.nombre}`,
                data: arrayLevel,
                },
            ],
            chart: {
                type: "line",
                height: 300,
                toolbar: {
                show: false,
                },
            },
            title: {
                show: "",
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#615fff"],
            stroke: {
                lineCap: "round",
                curve: "smooth",
            },
            markers: {
                size: 0,
            },
            xaxis: {
                axisTicks: {
                show: false,
                },
                axisBorder: {
                show: false,
                },
                labels: {
                style: {
                    colors: "#99a1af",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
                },
                categories: arrayDias,
            },
            yaxis: {
                labels: {
                style: {
                    colors: "#99a1af",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
                },
            },
            grid: {
                show: true,
                borderColor: "#99a1af",
                strokeDashArray: 5,
                xaxis: {
                lines: {
                    show: true,
                },
                },
                padding: {
                top: 5,
                right: 20,
                },
            },
            fill: {
                opacity: 0.8,
            },
            tooltip: {
                theme: "dark",
            },
        };

        const chartConfigArrived = {
            series: [
                {
                name: `Porcentaje de llegada de ${seleccionado.nombre}`,
                data: arrayArrived,
                },
            ],
            chart: {
                type: "line",
                height: 300,
                toolbar: {
                show: false,
                },
            },
            title: {
                show: "",
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#ff6900"],
            stroke: {
                lineCap: "round",
                curve: "smooth",
            },
            markers: {
                size: 0,
            },
            xaxis: {
                axisTicks: {
                show: false,
                },
                axisBorder: {
                show: false,
                },
                labels: {
                style: {
                    colors: "#99a1af",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
                },
                categories: arrayDias,
            },
            yaxis: {
                labels: {
                style: {
                    colors: "#99a1af",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
                },
            },
            grid: {
                show: true,
                borderColor: "#99a1af",
                strokeDashArray: 5,
                xaxis: {
                lines: {
                    show: true,
                },
                },
                padding: {
                top: 5,
                right: 20,
                },
            },
            fill: {
                opacity: 0.8,
            },
            tooltip: {
                theme: "dark",
            },
        };
        
        const chartLevel = new ApexCharts(divChartLevel, chartConfigLevel);
        const chartArrived = new ApexCharts(divChartArrived, chartConfigArrived);
        chartLevel.render();
        chartArrived.render();
    }

})()