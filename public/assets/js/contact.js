const map = L.map('map').setView([-27.10505,-52.61945], 14);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const customIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34]
});
L.marker([-27.10505, -52.61945], { icon: customIcon })
    .addTo(map)
    .bindPopup(`
        <b>PrintLabs Chapecó</b><br>
        <small>Rua Benjamin Constant, 555D - Centro</small>
    `);

