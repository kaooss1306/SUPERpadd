
<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$user_name = $_SESSION['user_name'];

include 'componentes/header.php';
include '../qplanes.php';
include 'componentes/sidebar.php';

// Verificar si $mesesMap y $aniosMap están disponibles
if (!isset($mesesMap) || !isset($aniosMap)) {
    die("Error: No se pudieron obtener los datos de meses y años.");
}


include '../../componentes/header.php';

include '../../componentes/sidebar.php';
?>
<style>
 .calendario {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 20px;
        max-width: 100%;
        width: 100%;
    }
    .selectores {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    #mesSelector, #anioSelector {
        flex: 1;
        padding: 10px;
        font-size: 16px;
        background-color: white;
        border: 1px solid #d2d2d2;
    }
    .dias {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }
    .dia {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    .dia input {
        width: 100%;
        padding: 5px;
        margin-top: 5px;
        box-sizing: border-box;
    }
    .dia-numero {
        font-size: 14px;
        color: #888;
        margin-bottom: 5px;
    }
    #submitButton {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    #submitButton:hover {
        background-color: #0056b3;
    }
.custom-select-container {
    position: relative;
    width: 100%;
}

.client-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: white;
  
   
    overflow-y: auto;
    z-index: 1000;
    display: none; /* Oculto por defecto */
}

.client-dropdown li {
    padding: 10px;
    cursor: pointer;
}

.client-dropdown li:hover {
    background-color: #f1f1f1;
}

.clear-btn {
    background: none;
    border: none;
    color: #d9534f;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

</style>
<div class="main-content">
    <section class="section">
        <div style="background: white;
    width: 80% !important;
    margin: 0 auto;
    padding: 50px;">
    <form id="formularioPlan">
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Agregar Plan</h3>
                        <div class="row">
                            <div class="col">
                        
                                <div class="form-group">
                  
                                    <!-- Selección de clientes -->
                                    <label class="labelforms" for="id_cliente">Clientes</label>
                                    <div class="custom-select-container">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            </div>
                                            <input class="form-control" type="text" id="search-client" placeholder="Buscar cliente...">
                                            <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                            <input  id="selected-client-id" name="selected-client-id" >
                                        </div>
                                        <ul id="client-list" class="client-dropdown">
                                            <!-- Aquí se mostrarán las opciones filtradas -->
                                        </ul>
                                    </div>

                                    <label class="labelforms" for="codigo">Nombre de Plan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Plan" name="nombrePlan">
                                    </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="labelforms" for="id_producto">Producto</label>
                                        <div class="custom-select-container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                </div>
                                                <input class="form-control" type="text" id="search-product" placeholder="Buscar producto...">
                                                <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                                <input type="hidden"  id="selected-product-id" name="selected-product-id">
                                            </div>
                                            <ul id="product-list" class="client-dropdown">
                                                <!-- Aquí se mostrarán las opciones filtradas -->
                                            </ul>
                                        </div>
                            
                                            <label class="labelforms" for="id_contrato">Contrato</label>
                                                        <div class="custom-select-container">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                                </div>
                                                                <input class="form-control" type="text" id="search-contrato" placeholder="Buscar contrato...">
                                                                <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                                                <input type="hidden"  id="selected-contrato-id" name="selected-contrato-id">
                                                                <input type="hidden"   id="selected-proveedor-id" name="selected-proveedor-id">
                                                            </div>
                                                            <ul id="contrato-list" class="client-dropdown">
                                                                <!-- Aquí se mostrarán las opciones filtradas -->
                                                            </ul>
                                                        </div>


                                        <label class="labelforms" for="id_contrato">Soportes</label>
                                        <div class="custom-select-container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                </div>
                                                <input class="form-control" type="text" id="search-soporte" placeholder="Buscar soporte...">
                                                <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                                <input  type="hidden"  id="selected-soporte-id" name="selected-soporte-id" value="">
                                            </div>
                                            <ul id="soporte-list" class="client-dropdown">
                                                <!-- Aquí se mostrarán las opciones filtradas -->
                                            </ul>
                                        </div>
                                        <label for="descripcion" class="labelforms">Detalle</label>
                                    <div class="custom-textarea-container">
                                        <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Introduce la detalle aquí..."></textarea>
                                    </div>
                                        </div>
                                        <div class="col">
                                        <label class="labelforms" for="id_campania">Campaña</label>
                                        <div class="custom-select-container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                </div>
                                                <input class="form-control" type="text" id="search-campania" placeholder="Buscar campaña...">
                                                <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                                <input  type="hidden"  id="selected-campania-id" name="selected-campania-id">
                                            </div>
                                            <ul id="campania-list" class="client-dropdown">
                                                <!-- Aquí se mostrarán las opciones filtradas -->
                                            </ul>
                                        </div>
                                        
                                        <label class="labelforms" for="id_campania">Temas</label>
                                        <div class="custom-select-container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                </div>
                                                <input class="form-control" type="text" id="search-temas" placeholder="Buscar temas...">
                                                <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                                <input type="hidden"  id="selected-temas-id" name="selected-temas-id">
                                            </div>
                                            <ul id="temas-list" class="client-dropdown">
                                                <!-- Aquí se mostrarán las opciones filtradas -->
                                            </ul>
                                        </div>  
                                        <label for="forma-facturacion" class="labelforms">Forma de facturación</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                </div>
                                            <select id="forma-facturacion" name="forma-facturacion" class="form-control">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="afecta">Afecta</option>
                                                <option value="exenta">Exenta</option>
                                                <option value="exportacion">Exportación</option>
                                            </select>
                                        </div>
                                            </div>
                                        </div>
                                    
                          


                                  
                                 </div>
                                </div>
                       
                        </div>
                    </div>
                    <div >
    <div class="calendario">
        <div class="selectores">
            <select id="mesSelector">
                <?php foreach ($mesesMap as $id => $mes): ?>
                    <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($mes['Nombre']); ?></option>
                <?php endforeach; ?>
            </select>
            <select id="anioSelector">
                <?php foreach ($aniosMap as $id => $anio): ?>
                    <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($anio['years']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="diasContainer" class="dias"></div>
        
    </div>
</div>
                    <div class="d-flex justify-content-end mt-3">
                        <button id="submitButton" class="btn btn-primary btn-lg rounded-pill" type="submit" >
                            <span class="btn-txt">Guardar Plan</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                        </button>
                    </div>
                </form>
                </div>
    </section>
</div>


<script>
const clientesMap = <?php echo json_encode($clientesMap); ?>;
const productosMap = <?php echo json_encode($productosMap); ?>;
const campaignsMap = <?php echo json_encode($campaignsMap); ?>;
const contratosMap = <?php echo json_encode($contratosMap); ?>;
const soportesMap = <?php echo json_encode($soportesMap); ?>;
const campaniaTemasMap = <?php echo json_encode($campaniaTemasMap); ?>;
const temasMap = <?php echo json_encode($temasMap); ?>;

function setupSearch(searchId, listId, dataMap, textProperty, filterProperty = null, extraFilterFunction = null) {
    const searchInput = document.getElementById(searchId);
    const list = document.getElementById(listId);

    searchInput.addEventListener('focus', function() {
        const clientId = document.getElementById('selected-client-id').value;
        const filteredItems = dataMap.filter(item =>
            (!filterProperty || item[filterProperty] === (clientId ? parseInt(clientId, 10) : null)) &&
            (!extraFilterFunction || extraFilterFunction(item))
        );

        if (searchId === 'search-soporte') {
            const proveedorId = document.getElementById('selected-proveedor-id').value;
            if (proveedorId) {
                updateSoporteList(proveedorId);
            }
            return;
        }

        if (filteredItems.length > 0) {
            list.innerHTML = filteredItems.map(item =>
                `<li data-id="${item.id}" data-proveedor-id="${item.idProveedor || ''}">${item[textProperty]}</li>`
            ).join('');
            list.style.display = 'block';
        } else {
            list.style.display = 'none';
        }
    });

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const clientId = document.getElementById('selected-client-id').value;

        if (query.length > 0) {
            document.querySelector('.clear-btn').style.display = 'block';

            const filteredItems = dataMap.filter(item =>
                item[textProperty].toLowerCase().includes(query) &&
                (!filterProperty || item[filterProperty] === (clientId ? parseInt(clientId, 10) : null)) &&
                (!extraFilterFunction || extraFilterFunction(item))
            );

            if (filteredItems.length > 0) {
                list.innerHTML = filteredItems.map(item =>
                    `<li data-id="${item.id}" data-proveedor-id="${item.idProveedor || ''}">${item[textProperty]}</li>`
                ).join('');
                list.style.display = 'block';
            } else {
                list.style.display = 'none';
            }
        } else {
            if (searchId !== 'search-soporte') {
                const filteredItems = dataMap.filter(item =>
                    (!filterProperty || item[filterProperty] === (clientId ? parseInt(clientId, 10) : null)) &&
                    (!extraFilterFunction || extraFilterFunction(item))
                );

                if (filteredItems.length > 0) {
                    list.innerHTML = filteredItems.map(item =>
                        `<li data-id="${item.id}" data-proveedor-id="${item.idProveedor || ''}">${item[textProperty]}</li>`
                    ).join('');
                    list.style.display = 'block';
                } else {
                    list.style.display = 'none';
                }
            }
            document.querySelector('.clear-btn').style.display = 'none';
        }
    });

    list.addEventListener('click', function(event) {
        if (event.target.tagName === 'LI') {
            searchInput.value = event.target.textContent;
            const selectedId = event.target.getAttribute('data-id');
            const selectedProveedorId = event.target.getAttribute('data-proveedor-id');

            document.getElementById(`selected-${searchId.replace('search-', '')}-id`).value = selectedId;
            
            if (searchId === 'search-contrato') {
                document.getElementById('selected-proveedor-id').value = selectedProveedorId;
                updateSoporteList(selectedProveedorId);
            }

            if (searchId === 'search-campania') {
                updateTemasList(selectedId);
            }

            list.style.display = 'none';
            document.querySelector('.clear-btn').style.display = 'none';
        }
    });
}

function updateSoporteList(idProveedor) {
    const list = document.getElementById('soporte-list');
    const filteredSoportes = soportesMap.filter(soporte => soporte.idProveedor == idProveedor);

    if (filteredSoportes.length > 0) {
        list.innerHTML = filteredSoportes.map(soporte =>
            `<li data-id="${soporte.id}">${soporte.nombreSoporte}</li>`
        ).join('');
        list.style.display = 'block';
    } else {
        list.innerHTML = '<li>No se encuentran soportes para este proveedor.</li>';
        list.style.display = 'block';
    }
}

function updateTemasList(idCampania) {
    const list = document.getElementById('temas-list');
    const temasRelacionadosIds = campaniaTemasMap[idCampania] || [];
    const filteredTemas = temasMap.filter(tema => temasRelacionadosIds.includes(tema.id));

    if (filteredTemas.length > 0) {
        list.innerHTML = filteredTemas.map(tema =>
            `<li data-id="${tema.id}">${tema.nombreTema}</li>`
        ).join('');
        list.style.display = 'block';
    } else {
        list.innerHTML = '<li>No se encuentran temas para esta campaña.</li>';
        list.style.display = 'block';
    }
}

// Configuración de búsqueda para cada campo
setupSearch('search-client', 'client-list', clientesMap, 'nombreCliente');
setupSearch('search-product', 'product-list', productosMap, 'nombreProducto', 'idCliente');
setupSearch('search-campania', 'campania-list', campaignsMap, 'nombreCampania', 'idCliente');
setupSearch('search-contrato', 'contrato-list', contratosMap, 'nombreContrato', 'idCliente');
setupSearch('search-soporte', 'soporte-list', soportesMap, 'nombreSoporte');
setupSearch('search-temas', 'temas-list', temasMap, 'nombreTema');

function clearSearch() {
    document.getElementById('search-product').value = '';
    document.getElementById('selected-product-id').value = '';
    document.getElementById('product-list').style.display = 'none';
    document.getElementById('search-campania').value = '';
    document.getElementById('selected-campania-id').value = '';
    document.getElementById('campania-list').style.display = 'none';
    document.getElementById('search-contrato').value = '';
    document.getElementById('selected-contrato-id').value = '';
    document.getElementById('contrato-list').style.display = 'none';
    document.getElementById('search-soporte').value = '';
    document.getElementById('selected-soporte-id').value = '';
    document.getElementById('soporte-list').style.display = 'none';
    document.getElementById('search-temas').value = '';
    document.getElementById('selected-temas-id').value = '';
    document.getElementById('temas-list').style.display = 'none';
    document.getElementById('selected-proveedor-id').value = '';

    document.querySelectorAll('.clear-btn').forEach(btn => btn.style.display = 'none');
}

document.addEventListener('click', function(event) {
    const searchFields = [
        document.getElementById('search-product'),
        document.getElementById('search-campania'),
        document.getElementById('search-contrato'),
        document.getElementById('search-soporte'),
        document.getElementById('search-temas')
    ];

    const lists = [
        document.getElementById('product-list'),
        document.getElementById('campania-list'),
        document.getElementById('contrato-list'),
        document.getElementById('soporte-list'),
        document.getElementById('temas-list')
    ];

    if (!searchFields.some(field => field.contains(event.target)) &&
        !lists.some(list => list.contains(event.target))) {
        lists.forEach(list => list.style.display = 'none');
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mesSelector = document.getElementById('mesSelector');
    const anioSelector = document.getElementById('anioSelector');
    const diasContainer = document.getElementById('diasContainer');
    const submitButton = document.getElementById('submitButton');

    console.log('Selectores:', mesSelector, anioSelector);
    console.log('Contenedor de días:', diasContainer);

    if (!mesSelector || !anioSelector || !diasContainer || !submitButton) {
        console.error('No se pudieron encontrar todos los elementos necesarios');
        return;
    }

    const mesesMap = <?php echo json_encode($mesesMap); ?>;
    const aniosMap = <?php echo json_encode($aniosMap); ?>;

    function actualizarCalendario() {
        const mesId = parseInt(mesSelector.value);
        const anioId = parseInt(anioSelector.value);

        console.log('Mes seleccionado:', mesId, mesesMap[mesId]);
        console.log('Año seleccionado:', anioId, aniosMap[anioId]);

        const mes = parseInt(mesesMap[mesId]['Id']);
        const anio = parseInt(aniosMap[anioId]['years']);

        console.log('Mes y año para cálculos:', mes, anio);

        const diasEnMes = new Date(anio, mes, 0).getDate();
        console.log('Días en el mes:', diasEnMes);

        diasContainer.innerHTML = '';

        for (let dia = 1; dia <= diasEnMes; dia++) {
            const diaElement = document.createElement('div');
            diaElement.className = 'dia';
            diaElement.innerHTML = `
                <div class="dia-numero">${dia}</div>
                <input type="number" id="input-${anio}-${mes}-${dia}" />
            `;
            diasContainer.appendChild(diaElement);
        }

        console.log('Calendario actualizado');
    }

    function recopilarDatos() {
    const mesId = parseInt(mesSelector.value);
    const anioId = parseInt(anioSelector.value);
    const mes = parseInt(mesesMap[mesId]['Id']);
    const anio = parseInt(aniosMap[anioId]['years']);
    const diasEnMes = new Date(anio, mes, 0).getDate();

    // Obtén el ID del cliente seleccionado
    const clienteId = parseInt(document.getElementById('selected-client-id').value);
 console.log(clienteId,"Holaaa");
    const matrizCalendario = [];

    for (let dia = 1; dia <= diasEnMes; dia++) {
        const input = document.getElementById(`input-${anio}-${mes}-${dia}`);
        if (input && input.value) {
            matrizCalendario.push({
                mes: mes,
                anio: anio,
                dia: dia,
                cantidad: parseInt(input.value)
            });
        }
    }

    return {
        id_cliente: clienteId || 23, // Usa el ID del cliente seleccionado, o 23 como valor por defecto
        matrizCalendario: matrizCalendario
    };
}
    mesSelector.addEventListener('change', actualizarCalendario);
    anioSelector.addEventListener('change', actualizarCalendario);
    submitButton.addEventListener('click', enviarDatos);

    console.log('Inicializando calendario');
    actualizarCalendario();


function enviarDatos() {
    const datos = recopilarDatos();  // Asegúrate de que recopilarDatos() devuelva los datos correctos para la tabla "json"
    console.log('Datos a enviar:', JSON.stringify(datos));

    fetch('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/json', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'apikey': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
            'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
            'Prefer': 'return=representation' // Importante para obtener el id_calendar devuelto
        },
        body: JSON.stringify(datos)
    })
    .then(response => {
        console.log('Respuesta completa:', response);
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`HTTP error! status: ${response.status}, message: ${text}`);
            });
        }
        return response.json(); // Asumimos que la respuesta es un JSON que contiene el id_calendar
    })
    .then(data => {
        console.log('Respuesta del servidor:', data);

        // Captura el id_calendar de la respuesta
        const id_calendar = data[0].id_calendar;
        console.log('ID Calendar obtenido:', id_calendar);

        // Ahora que tienes el id_calendar, haz la segunda inserción
        const datosPlan = {
            NombrePlan: document.querySelector('input[name="nombrePlan"]').value,
            id_cliente: document.getElementById('selected-client-id').value,
            id_producto: document.getElementById('selected-product-id').value,
            id_contrato: document.getElementById('selected-contrato-id').value,
            id_soporte: document.getElementById('selected-soporte-id').value,
            detalle: document.getElementById('descripcion').value,
            id_campania: document.getElementById('selected-campania-id').value,
            id_temas: document.getElementById('selected-temas-id').value,
            fr_factura: document.getElementById('forma-facturacion').value,
            id_calendar: id_calendar // Usa el id_calendar obtenido
        };

        return fetch('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/PlanesPublicidad', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'apikey': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
                'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
            },
            body: JSON.stringify(datosPlan)
        });
    })
    .then(response => {
        console.log('Respuesta completa de la segunda inserción:', response);
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`HTTP error! status: ${response.status}, message: ${text}`);
            });
        }
        return response.text();
    })
    .then(data => {
        console.log('Segunda inserción exitosa:', data);
        Swal.fire({
            title: '¡Éxito!',
            text: 'Los datos se han guardado correctamente.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.reload(); // Recarga la página
            }
        });
    })
    .catch(error => {
        console.error('Error al guardar los datos:', error);
        Swal.fire({
            title: 'Error',
            text: 'Error al guardar los datos: ' + error.message,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}

   
});
</script>


<?php include '../../componentes/settings.php'; ?>


<?php include '../../componentes/footer.php'; ?>