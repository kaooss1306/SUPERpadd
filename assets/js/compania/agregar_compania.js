function guardarCompania(event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    const form = document.getElementById('formularioAgregarCampania');
    const formData = new FormData(form);

    // Convertir FormData a un objeto JSON
    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    // Transformar los datos del formulario al formato requerido
    const transformedData = {
        "NombreCampania": jsonData.NombreCampania,
        "Anio": parseInt(jsonData.Anio, 10),
        "id_Cliente": parseInt(jsonData.cliente, 10),
        "Id_Agencia": parseInt(jsonData.Id_Agencia, 10),
        "id_Producto": parseInt(jsonData.id_Producto, 10),
        "Presupuesto": parseFloat(jsonData.Presupuesto),
        "id_Temas": parseInt(jsonData.id_Temas, 10),
        "Id_Planes_Publicidad": jsonData.Planes_Publicidad !== null ? parseInt(jsonData.Planes_Publicidad, 10) : null
    };

    // URL y headers para la solicitud POST
    const url = 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?select=*';
    const headers = {
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Content-Type": "application/json",
        "Prefer": "return=minimal"
    };

    // Realizar la solicitud POST usando fetch
    fetch(url, {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(transformedData)
    })
    .then(response => {
        if (response.ok) {
            Swal.fire({
                title: 'Éxito!',
                text: 'Campaña agregado correctamente',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
            window.location.reload();
        } else {
            return response.json().then(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un error al enviar los datos',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        }
    })
    .catch(error => {
        swal("Error", `Error en la solicitud: ${error.message}`, "error");
    });
}
