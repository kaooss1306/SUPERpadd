document.addEventListener('DOMContentLoaded', function() {
    const btnAddContrato = document.getElementById('btn-add-contrato');
    const formAddContrato = document.getElementById('form-add-contrato');
    const selectCliente = document.getElementById('idCliente');
    const selectProducto = document.getElementById('idProducto');
    const selectProveedor = document.getElementById('idProveedor');
    const selectMedio = document.getElementById('idMedio');

    if (!selectMedio) {
        console.error("Error: No se pudo encontrar el elemento con ID 'idMedio'");
    }

    if (btnAddContrato) {
        btnAddContrato.addEventListener('click', function(event) {
            event.preventDefault();
            if (formAddContrato.checkValidity()) {
                submitForm();
            } else {
                formAddContrato.reportValidity();
            }
        });
    } else {
        console.error("Error: No se pudo encontrar el botón de añadir contrato");
    }

    if (selectCliente) {
        selectCliente.addEventListener('change', function() {
            console.log('Cliente seleccionado:', this.value);
            cargarProductoCliente(this.value);
        });
    } else {
        console.error("Error: No se pudo encontrar el elemento select del cliente");
    }

    if (selectProveedor) {
        selectProveedor.addEventListener('change', function() {
            console.log('Proveedor seleccionado:', this.value);
            filtrarMediosProveedor(this.value);
        });
    } else {
        console.error("Error: No se pudo encontrar el elemento select del proveedor");
    }

    function cargarProductoCliente(idCliente) {
        console.log('Cargando producto para el cliente:', idCliente);
        if (!selectProducto) {
            console.error("Error: El elemento select de productos no está disponible");
            return;
        }
        selectProducto.innerHTML = '<option value="">Cargando producto...</option>';

        if (!idCliente) {
            selectProducto.innerHTML = '<option value="">Seleccione un cliente primero</option>';
            return;
        }

        fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos?Id_Cliente=eq.${idCliente}&select=*`, {
            headers: {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        })
        .then(response => response.json())
        .then(productos => {
            console.log('Productos recibidos:', productos);
            selectProducto.innerHTML = '';

            if (productos.length > 0) {
                productos.forEach(producto => {
                    const option = document.createElement('option');
                    option.value = producto.id;
                    option.textContent = producto.NombreDelProducto;
                    selectProducto.appendChild(option);
                });
                
                selectProducto.value = productos[0].id;
                console.log('Producto seleccionado:', selectProducto.value);
                
                selectProducto.dispatchEvent(new Event('change'));
            } else {
                const option = document.createElement('option');
                option.value = "";
                option.textContent = "No hay productos para este cliente";
                selectProducto.appendChild(option);
            }
        })
        .catch(error => {
            console.error("Error al cargar productos:", error);
            selectProducto.innerHTML = '<option value="">Error al cargar producto</option>';
        });
    }

    function filtrarMediosProveedor(idProveedor) {
        if (!selectMedio) {
            console.error("Error: El elemento select de medios no está disponible");
            return;
        }

        console.log('Filtrando medios para el proveedor:', idProveedor);

        if (!idProveedor) {
            // Mostrar todos los medios si no se selecciona un proveedor
            Array.from(selectMedio.options).forEach(option => {
                option.style.display = '';
            });
            return;
        }

        fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_medios?id_proveedor=eq.${idProveedor}&select=*`, {
            headers: {
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        })
        .then(response => response.json())
        .then(relaciones => {
            console.log('Relaciones proveedor-medios:', relaciones);
            if (relaciones.length > 0) {
                const idMediosDelProveedor = new Set(relaciones.map(rel => rel.id_medio));
                
                Array.from(selectMedio.options).forEach(option => {
                    if (idMediosDelProveedor.has(parseInt(option.value))) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Seleccionar el primer medio visible
                const primerMedioVisible = Array.from(selectMedio.options).find(option => option.style.display !== 'none');
                if (primerMedioVisible) {
                    selectMedio.value = primerMedioVisible.value;
                } else {
                    selectMedio.value = '';
                }

                console.log('Medio seleccionado:', selectMedio.value);
                selectMedio.dispatchEvent(new Event('change'));
            } else {
                console.log('No se encontraron medios para este proveedor');
                Array.from(selectMedio.options).forEach(option => {
                    option.style.display = 'none';
                });
                selectMedio.value = '';
            }
        })
        .catch(error => {
            console.error("Error al cargar medios:", error);
            console.error("Detalles del error:", error.message);
        });
    }

    function getFormData() {
        const formData = new FormData(formAddContrato);
        const dataObject = {};
        formData.forEach((value, key) => {
            dataObject[key] = value;
        });
        console.log(dataObject, "Datos del formulario");
        
        return {
            NombreContrato: dataObject.nombreContrato,
            IdCliente: parseInt(dataObject.idCliente),
            IdProducto: parseInt(dataObject.idProducto),
            IdProveedor: parseInt(dataObject.idProveedor),
            IdMedios: parseInt(dataObject.IdMedios),
            id_FormadePago: parseInt(dataObject.id_FormadePago),
            Estado: dataObject.Estado === "1" // Convierte a booleano
        };
    }

    function submitForm() {
        let bodyContent = JSON.stringify(getFormData());
        console.log(bodyContent, "Datos a enviar");

        let headersList = {
            "Content-Type": "application/json",
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
            "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
        };

        fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Contratos", {
            method: "POST",
            body: bodyContent,
            headers: headersList
        })
        .then(response => {
            console.log("Estado de la respuesta:", response.status);
            console.log("Cabeceras de la respuesta:", response.headers);
            return response.text().then(text => {
                console.log("Cuerpo de la respuesta:", text);
                if (response.ok) {
                    return text ? JSON.parse(text) : {};
                } else {
                    throw new Error(`El servidor respondió con estado: ${response.status}. Cuerpo: ${text}`);
                }
            });
        })
        .then(data => {
            console.log("Registro correcto", data);
            Swal.fire({
                title: '¡Éxito!',
                text: 'El contrato ha sido agregado correctamente.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAddContrato'));
            modal.hide();
        })
        .catch(error => {
            console.error("Detalles del error:", error);
            Swal.fire({
                title: 'Error',
                text: `Hubo un problema al agregar el contrato: ${error.message}`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }
});