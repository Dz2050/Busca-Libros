if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const latitud = position.coords.latitude;
        const longitud = position.coords.longitude;

        console.log(`Tus coordenadas son ${latitud}, ${longitud}`);

        const requestURL = `http://localhost/Busca%20Libros/URL_API_HORA/ubicacion.json?lat=${latitud}&lon=${longitud}`;
        fetch(requestURL)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Hubo un error al obtener la hora.');
                }
                return response.text();
            })
            .then(data => {
                if (data.hora) {
                    const hora = data.hora;
                    console.log(`La hora actual es: ${hora}`);
                } else {
                    console.log('La respuesta de la API está vacía.');
                }
            })
            .catch(error => {
                console.error('Hubo un error al obtener la hora:', error);
            });
    }, error => {
        console.error('Hubo un error al obtener la ubicación:', error);
    });
} else {
    console.error('La geolocalización no está disponible en este navegador.');
}
