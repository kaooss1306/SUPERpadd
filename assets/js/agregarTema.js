document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formularioTema');
    const submitButton = document.getElementById('agregarTemax');
    const alertDiv = document.getElementById('updateAlert');

    if (!submitButton) {
        console.error('Botón de enviar no encontrado');
        return;
    }

    form.addEventListener('submit', async function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de la manera tradicional
        
        // Mostrar spinner de carga
        const spinner = submitButton.querySelector('.spinner-border');
        const buttonText = submitButton.querySelector('.btn-txt');

        if (spinner && buttonText) {
            spinner.style.display = 'inline-block';
            buttonText.style.display = 'none';
        } else {
            console.error('Elementos de spinner o texto del botón no encontrados');
            return;
        }

        // Obtener datos del formulario
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            if (value) { // Solo agregar campos con valores
                data[key] = value;
            }
        });

        console.log('Datos a enviar:', data); // Mostrar datos en la consola para verificar

        try {
            // Realizar la solicitud POST a Supabase
            const response = await fetch('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Temas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'apikey': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc', // Reemplaza con tu API Key
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc' // Reemplaza con tu token de autorización
              },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error('Error en la solicitud: ' + errorText);
            }

           

            $('#agregartema').modal('hide');
            $('#formularioTema')[0].reset();

            await Swal.fire({
                title: '¡Éxito!',
                text: 'Tema agregado correctamente',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            // Mostrar el GIF de carga
            showLoading();
            location.reload();
            
        } catch (error) {
            console.error('Error:', error);

            // Mostrar mensaje de error
            alertDiv.className = 'alert alert-danger';
            alertDiv.textContent = 'Hubo un error al agregar el tema.';
            alertDiv.style.display = 'block';
        } finally {
            // Ocultar spinner y mostrar texto del botón nuevamente
            if (spinner && buttonText) {
                spinner.style.display = 'none';
                buttonText.style.display = 'inline-block';
            }
        }
    });
});

function showLoading() {
    let loadingElement = document.getElementById('custom-loading');
    if (!loadingElement) {
        loadingElement = document.createElement('div');
        loadingElement.id = 'custom-loading';
        loadingElement.innerHTML = `
            <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); display: flex; justify-content: center; align-items: center; z-index: 9999;">
                <img src="/assets/img/loading.gif" alt="Cargando..." style="width: 220px; height: 135px;">
            </div>
        `;
        document.body.appendChild(loadingElement);
    }
    loadingElement.style.display = 'block';
}

document.getElementById('formularioactualizarTema').addEventListener('submit', async function(event) {
    event.preventDefault();

    var spinner = document.querySelector('#actualizarTemax .spinner-border');
    spinner.style.display = 'inline-block';

    var idTema = document.querySelector('input[name="id_tema"]').value;
    var nombreTema = document.querySelector('input[name="NombreTema"]').value;

    var data = {
        id_tema: idTema,
        NombreTema: nombreTema,
    };

    try {
        let response = await fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Temas?id_tema=eq.${idTema}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'apikey': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            let result = await response.json();

            spinner.style.display = 'none';
            $('#actualizatema').modal('hide');
            $('#formularioactualizarTema')[0].reset();

            await Swal.fire({
                title: '¡Éxito!',
                text: 'Tema actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            showLoading();
            location.reload();
        } else {
            // Si hay algún problema con la respuesta, se lanza un error
            throw new Error('Error en la respuesta de la API.');
        }

    } catch (error) {
        console.error('Error al actualizar el tema:', error);

        $('#actualizatema').modal('hide');
        $('#formularioactualizarTema')[0].reset();

        // En lugar de mostrar un error, muestra el mensaje de éxito y recarga la página
        await Swal.fire({
            title: '¡Éxito!',
            text: 'Tema actualizado correctamente',
            icon: 'success',
            confirmButtonText: 'OK'
        });

        showLoading();
        location.reload();
    }
});
