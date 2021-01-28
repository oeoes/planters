'use strict';

// initialize leaflet
const map = L.map('farm-map').setView([-6.589995903300954, 106.80604686178805], 9);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1Ijoic3VwZXJwaWthciIsImEiOiI0MGE3NGQ2OWNkMzkyMzFlMzE4OWU5Yjk0ZmYzMGMwOCJ9.3bGFHjoSXB8yVA3KeQoOIw'
}).addTo(map);

axios.get(`/superadmin/area/coordinates/${company_id}`).then((response) => {
    const coordinates = response.data.data;
    
    let blocks = [];
    let farms = new Set();
    coordinates.map((coord) => farms.add(coord.farm_id));

    farms.forEach((id) => {
        let farmData = {
            farm: '',
            afdelling: '',
            blocks: []
        }
        coordinates.filter((farm) => farm.farm_id === id).map((filteredFarm) => {
            farmData.farm = filteredFarm.farm;
            farmData.afdelling = filteredFarm.afdelling;
            farmData.blocks.push([filteredFarm.code, filteredFarm.lat, filteredFarm.lng]);
        });
        blocks.push(farmData);
    });

    // mapping
    blocks.forEach((farm) => {
        farm.blocks.forEach((block) => {
            L.marker([parseFloat(block[1]), parseFloat(block[2])], {
                riseOnHover: true
            }).addTo(map).bindPopup(`<h3>Blok ${block[0]}</h3> <span>Kebun: <strong>${farm.farm}</strong></span> <br /> <span>Afdelling: <strong>${farm.afdelling}</strong></span> <br />`)
        })
    })
});