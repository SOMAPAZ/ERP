(() => {
    console.log('hola')

    const inputBilletes = document.querySelectorAll('.input-billetes');
    const textCambios = document.querySelector('.text-cambios');

    document.addEventListener('DOMContentLoaded', () => {
        inputBilletes.forEach(input => {
            input.addEventListener('input', sumarBilletes);
        })
    })

    const sumarBilletes = e => {
        textCambios.classList.remove('text-blue-800', 'bg-blue-100');
        textCambios.classList.add('text-yellow-800', 'bg-yellow-100');
        textCambios.textContent = `No coinciden el monto del sistes con el monto de cajera`;
    };
})()