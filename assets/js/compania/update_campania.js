document.addEventListener('DOMContentLoaded', function () {
    const updateButton = document.getElementById('updateButton');

    if (updateButton) {
        updateButton.addEventListener('click', function () {
            const id = updateButton.getAttribute('data-id');

            // Carga los datos de la campaña
            cargarDatosFormulario(id);
        });
    } else {
        console.error('Botón de actualización no encontrado');
    }
});

function cargarDatosFormulario(id) {

    const url = `https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?id_campania=eq.${id}`;

    fetch(url, {
        headers: {
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
            "Content-Type": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                const campaign = data[0];

                // Rellenar los campos del formulario con los datos de la campaña
                document.getElementById('campaniaId').value = campaign.id_campania;
                document.getElementById('NombreCampaniaUpdate').value = campaign.NombreCampania;
                document.getElementById('AnioUpdate').value = campaign.Anio;
                document.getElementById('id_ClienteUpdate').value = campaign.id_Cliente;
                document.getElementById('Id_AgenciaUpdate').value = campaign.Id_Agencia;
                document.getElementById('id_ProductoUpdate').value = campaign.id_Producto;
                document.getElementById('PresupuestoUpdate').value = campaign.Presupuesto;
                document.getElementById('id_TemasUpdate').value = campaign.id_Temas;
                document.getElementById('Planes_PublicidadUpdate').value = campaign.Id_Planes_Publicidad;

            } else {
                console.error('No se encontraron datos para la campaña con ID:', id);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se encontraron datos para la campaña.',
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar la campaña:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al cargar los datos de la campaña.',
            });
        });
}

function actualizarCompania() {
    const form = document.getElementById('formularioUpdateCampania');
    const formData = new FormData(form);

    const campaniaId = formData.get('campaniaId');
    const NombreCampaniaUpdate = formData.get('NombreCampaniaUpdate');
    const AnioUpdate = formData.get('AnioUpdate');
    const id_ClienteUpdate = formData.get('id_ClienteUpdate');
    const Id_AgenciaUpdate = formData.get('Id_AgenciaUpdate');
    const id_ProductoUpdate = formData.get('id_ProductoUpdate');
    const PresupuestoUpdate = formData.get('PresupuestoUpdate');
    const id_TemasUpdate = formData.get('id_TemasUpdate');
    const Id_Planes_Publicidad = formData.get('Planes_PublicidadUpdate');

    console.log('ID de la campaña: ' + Id_Planes_Publicidad);

    // Crear un objeto con los datos del formulario
    const data = {};

    // Mapeo de campos con "Update" al formato requerido
    const mapping = {
        "NombreCampania": NombreCampaniaUpdate,
        "Anio": parseInt(AnioUpdate),
        "id_Cliente": parseInt(id_ClienteUpdate),
        "Id_Agencia": parseInt(Id_AgenciaUpdate),
        "id_Producto": parseInt(id_ProductoUpdate),
        "Presupuesto": parseInt(PresupuestoUpdate),
        "id_Temas": parseInt(id_TemasUpdate),
        "Id_Planes_Publicidad": parseInt(Id_Planes_Publicidad),
    };
    
   

    // Construir el path con el ID de la campaña
    const url = `https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?id_campania=eq.${campaniaId}`;


  
    // Realizar la solicitud PUT o PATCH para actualizar la campaña
    fetch(url, {
        method: 'PATCH', // o 'PUT' dependiendo de tu API
        headers: {
            'Content-Type': 'application/json',
            'apikey': "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
            'Authorization': "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
        },
        body: JSON.stringify(mapping)
       
    })
        .then(data => {
            console.log('Campaña actualizada con éxito:', data);
            Swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: 'La campaña se ha actualizado correctamente.',
                showConfirmButton: false,
                timer: 1500
            });
            window.location.reload();
        })
}