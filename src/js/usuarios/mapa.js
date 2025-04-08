(function() {
    const latitud = document.querySelector('#lat').value;
    const longitud = document.querySelector('#lng').value;

    const lat = +latitud;
    const lng = +longitud;
    const mapa = L.map('mapa').setView([lat, lng ], 16);

    let marker;
 
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);

    marker = new L.marker([lat, lng]).addTo(mapa);
})();