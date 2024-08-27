async function obtenerNuevoIdSoporte() {
    try {
        let response = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?select=id_soporte&order=id_soporte.desc&limit=1", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        });

        if (response.ok) {
            const soportes = await response.json();
            const ultimoSoporte = soportes[0];
            const nuevoIdSoporte = ultimoSoporte ? ultimoSoporte.id_soporte + 1 : 1;
            return nuevoIdSoporte;
            console.log(nuevoIdSoporte,"ID SOPORTE");
        } else {
            console.error("Error al obtener el último ID de soporte:", await response.text());
            throw new Error("Error al obtener el último ID de soporte");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
        throw error;
    }
}

function getFormDataSoporte() {
    const formData = new FormData(document.getElementById('formualarioSoporte'));
    const dataObject = {};
    formData.forEach((value, key) => {
        if (key === 'id_medios[]') {
            if (!dataObject[key]) {
                dataObject[key] = [];
            }
            dataObject[key].push(value);
        } else {
            dataObject[key] = value;
        }
    });

    return {
        ...dataObject,  // Retorna todos los valores de dataObject
        created_at: new Date().toISOString()
    };
}

async function submitFormSoporte(event) {
    event.preventDefault(); // Evita la recarga de la página

    const formData = getFormDataSoporte();
    const nuevoIdSoporte = await obtenerNuevoIdSoporte(); // Obtener el nuevo ID
    const idProveedor = formData.id_proveedor;
    let soporteData;
    if (formData.revision === "on") {
        // Usar los datos del proveedor
        soporteData = {
            id_soporte: nuevoIdSoporte,
            created_at: formData.created_at,
            id_proveedor: formData.id_proveedor,
            nombreIdentficiador: formData.nombreIdentficiador,
            razonSocial: formData.razonsoculto,
            nombreFantasia: formData.nombref,
            rut_soporte: formData.rutt,
            giro: formData.giroo,
            nombreRepresentanteLegal: formData.nombreRepesentanteO,
            rutRepresentante: formData.rutRepresent,
            direccion: formData.direcciono,
            id_region: formData.regiono,
            id_comuna: formData.comunao,
            telCelular: formData.telCelularo,
            telFijo: formData.telFijoo,
            email: formData.emailO || null,
            bonificacion_ano: formData.bonificacion_ano,
            escala: formData.escala_rango
        };

    } else {
        // Usar los datos ingresados manualmente
        soporteData = {
            id_soporte: nuevoIdSoporte,
            created_at: formData.created_at,
            id_proveedor: formData.id_proveedor,
            nombreIdentficiador: formData.nombreIdentficiador,
            razonSocial: formData.razonSocial,
            nombreFantasia: formData.nombreFantasia,
            rut_soporte: formData.rut_soporte,
            giro: formData.giro,
            nombreRepresentanteLegal: formData.nombreRepresentanteLegal,
            rutRepresentante: formData.rutRepresentante,
            direccion: formData.direccion,
            id_region: formData.id_region,
            id_comuna: formData.id_comuna,
            telCelular: formData.telCelular,
            telFijo: formData.telFijo,
            email: formData.email || null,
            bonificacion_ano: formData.bonificacion_ano,
            escala: formData.escala_rango
        };
  
    }
    console.log(soporteData,"holaaa")
    try {
        // Registrar el soporte
        let responseSoporte = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes", {
            method: "POST",
            body: JSON.stringify(soporteData),
            headers: {
                "Content-Type": "application/json",
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        });
        console.log(responseSoporte,"soporte agregado se supone");
        if (responseSoporte.ok) {
            console.log("Soporte registrado correctamente");

            // Continuar con el registro de medios
            const soporteMediosData = formData['id_medios[]'].map(id_medio => ({
                id_soporte: nuevoIdSoporte, // Usar el ID generado
                id_medio: id_medio
            }));
            console.log(soporteMediosData,"medios");
            let responseSoporteMedios = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/soporte_medios", {
                method: "POST",
                body: JSON.stringify(soporteMediosData),
                headers: {
                    "Content-Type": "application/json",
                    "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
                }
            });

            if (responseSoporteMedios.ok) {

                  // Continuar con el registro de medios
                  const soporteProveedor = {
                    id_soporte: nuevoIdSoporte, // Usar el ID generado
                    id_proveedor: formData.id_proveedor // Asegúrate de que formData contiene id_proveedor
                };

            let responseSoporteMedios = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_soporte", {
                method: "POST",
                body: JSON.stringify(soporteProveedor),
                headers: {
                    "Content-Type": "application/json",
                    "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
                }

            });
                
                mostrarExito('¡Soporte agregado exitosamente!');
                $('#agregarSoportessss').modal('hide');
            $('#formualarioSoporte')[0].reset();
            location.reload();
            } else {
                const errorData = await responseSoporteMedios.text(); // Obtener respuesta como texto
                console.error("Error en soporte_medios:", errorData);
                alert("Error al registrar los medios, intente nuevamente");
            }
        } else {
            const errorData = await responseSoporte.text(); // Obtener respuesta como texto
            console.error("Error en soporte:", errorData);
            alert("Error al registrar el soporte, intente nuevamente");
        }
    } catch (error) {
        mostrarExito('¡Soporte agregado exitosamente!');
        $('#agregarSoportessss').modal('hide');
    $('#formualarioSoporte')[0].reset();
    location.reload();
    }
}
function mostrarExito(mensaje) {
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: mensaje,
        showConfirmButton: false,
        timer: 1500
    });
}



// Asigna el evento de envío al formulario de agregar soporte
document.getElementById('formualarioSoporte').addEventListener('submit', submitFormSoporte);
