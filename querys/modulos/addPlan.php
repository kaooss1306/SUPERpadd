<?php
// Iniciar la sesión
session_start();


// Función para hacer peticiones cURL
  // Función para hacer peticiones cURL
  function makeRequest($url) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// Obtener datos
$campaigns = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?select=*');
$clientes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes?select=*');
$contratos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Contratos?select=*');
$planes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/PlanesPublicidad?select=*');
$meses = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Meses?select=*');
$anos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Anios?select=*');
$productos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos?select=*');


$mesesMap = [];
foreach ($meses as $mes) {
    $mesesMap[$mes['Id']] = $mes;
}
$anosMap = [];
foreach ($anos as $anio) {
    $anosMap[$anio['id']] = $anio;
}
$clientesMap = [];
foreach ($clientes as $cliente) {
    $clientesMap[] = [
        'id' => $cliente['id_cliente'],
        'nombreCliente' => $cliente['nombreCliente']
    ];
}
$productosMap = [];
foreach ($productos as $producto) {
    $productosMap[] = [
        'id' => $producto['id'],
        'nombreProducto' => $producto['NombreDelProducto'],
        'idCliente' => $producto['Id_Cliente']
    ];
}

$campaignsMap = [];
foreach ($campaigns as $campaign) {
    $campaignsMap[] = [
        'id' => $campaign['id_campania'],
        'nombreCampania' => $campaign['NombreCampania'],
        'idCliente' => $campaign['id_Cliente']
    ];
}

$contratosMap = [];
foreach ($contratos as $contrato) {
    $contratosMap[] = [
        'id' => $contrato['id'],
        'nombreContrato' => $contrato['NombreContrato'],
        'idCliente' => $contrato['IdCliente']
    ];
}
include '../../componentes/header.php';
include '../../componentes/sidebar.php';
?>
<style>

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
    <form id="formularioTema">
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Agregar Tema</h3>
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
        <input type="hidden" id="selected-client-id" name="selected-client-id" >
    </div>
    <ul id="client-list" class="client-dropdown">
        <!-- Aquí se mostrarán las opciones filtradas -->
    </ul>
</div>
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


                                    <!-- Demás Campos  -->
                                <div class="encuentro">
                             

                                        <label class="labelforms" for="id_campania">Campaña</label>
                                        <div class="custom-select-container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                </div>
                                                <input class="form-control" type="text" id="search-campania" placeholder="Buscar campaña...">
                                                <button type="button" class="clear-btn" style="display:none;" onclick="clearSearch()">x</button>
                                                <input type="hidden"  id="selected-campania-id" name="selected-campania-id">
                                            </div>
                                            <ul id="campania-list" class="client-dropdown">
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
                                                <input type="hidden" id="selected-contrato-id" name="selected-contrato-id">
                                            </div>
                                            <ul id="contrato-list" class="client-dropdown">
                                                <!-- Aquí se mostrarán las opciones filtradas -->
                                            </ul>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary btn-lg rounded-pill" type="submit" id="agregarTemax">
                            <span class="btn-txt">Guardar Plan</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                        </button>
                    </div>
                </form>
    </section>
</div>


<script>
const clientesMap = <?php echo json_encode($clientesMap); ?>;
const productosMap = <?php echo json_encode($productosMap); ?>;
const campaignsMap = <?php echo json_encode($campaignsMap); ?>;
const contratosMap = <?php echo json_encode($contratosMap); ?>;

function setupSearch(searchId, listId, dataMap, textProperty, filterProperty) {
    const searchInput = document.getElementById(searchId);
    const list = document.getElementById(listId);

    // Mostrar todos los elementos al principio según el cliente seleccionado
    searchInput.addEventListener('focus', function() {
        const clientId = document.getElementById('selected-client-id').value;
        const filteredItems = dataMap.filter(item =>
            (!filterProperty || item[filterProperty] === (clientId ? parseInt(clientId, 10) : null))
        );

        if (filteredItems.length > 0) {
            list.innerHTML = filteredItems.map(item =>
                `<li data-id="${item.id}">${item[textProperty]}</li>`
            ).join('');
            list.style.display = 'block';
        } else {
            list.style.display = 'none';
        }
    });

    // Filtrar a medida que el usuario escribe
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const clientId = document.getElementById('selected-client-id').value;

        if (query.length > 0) {
            document.querySelector('.clear-btn').style.display = 'block';

            // Filtrar elementos por nombre y idCliente
            const filteredItems = dataMap.filter(item =>
                item[textProperty].toLowerCase().includes(query) &&
                (!filterProperty || item[filterProperty] === (clientId ? parseInt(clientId, 10) : null))
            );

            if (filteredItems.length > 0) {
                list.innerHTML = filteredItems.map(item =>
                    `<li data-id="${item.id}">${item[textProperty]}</li>`
                ).join('');
                list.style.display = 'block';
            } else {
                list.style.display = 'none';
            }
        } else {
            // Mostrar todos los productos cuando no hay query
            const filteredItems = dataMap.filter(item =>
                (!filterProperty || item[filterProperty] === (clientId ? parseInt(clientId, 10) : null))
            );

            if (filteredItems.length > 0) {
                list.innerHTML = filteredItems.map(item =>
                    `<li data-id="${item.id}">${item[textProperty]}</li>`
                ).join('');
                list.style.display = 'block';
            } else {
                list.style.display = 'none';
            }

            document.querySelector('.clear-btn').style.display = 'none';
        }
    });

    // Seleccionar un elemento de la lista
    list.addEventListener('click', function(event) {
        if (event.target.tagName === 'LI') {
            searchInput.value = event.target.textContent;
            document.getElementById(`selected-${searchId.replace('search-', '')}-id`).value = event.target.getAttribute('data-id');
            list.style.display = 'none';
            document.querySelector('.clear-btn').style.display = 'none';
        }
    });
}

// Inicializa la búsqueda de clientes, productos, campañas y contratos
setupSearch('search-client', 'client-list', clientesMap, 'nombreCliente');
setupSearch('search-product', 'product-list', productosMap, 'nombreProducto', 'idCliente');
setupSearch('search-campania', 'campania-list', campaignsMap, 'nombreCampania', 'idCliente');
setupSearch('search-contrato', 'contrato-list', contratosMap, 'nombreContrato', 'idCliente');

// Función para limpiar todos los campos de búsqueda
function clearSearch() {
    document.getElementById('search-client').value = '';
    document.getElementById('selected-client-id').value = '';
    document.getElementById('client-list').style.display = 'none';
    document.getElementById('search-product').value = '';
    document.getElementById('selected-product-id').value = '';
    document.getElementById('product-list').style.display = 'none';
    document.getElementById('search-campania').value = '';
    document.getElementById('selected-campania-id').value = '';
    document.getElementById('campania-list').style.display = 'none';
    document.getElementById('search-contrato').value = '';
    document.getElementById('selected-contrato-id').value = '';
    document.getElementById('contrato-list').style.display = 'none';

    document.querySelectorAll('.clear-btn').forEach(btn => btn.style.display = 'none');
}

// Ocultar las listas cuando se hace clic fuera de ellas
document.addEventListener('click', function(event) {
    const searchFields = [
        document.getElementById('search-client'),
        document.getElementById('search-product'),
        document.getElementById('search-campania'),
        document.getElementById('search-contrato')
    ];

    const lists = [
        document.getElementById('client-list'),
        document.getElementById('product-list'),
        document.getElementById('campania-list'),
        document.getElementById('contrato-list')
    ];

    if (!searchFields.some(field => field.contains(event.target)) &&
        !lists.some(list => list.contains(event.target))) {
        lists.forEach(list => list.style.display = 'none');
    }
});

</script>


<?php include '../../componentes/settings.php'; ?>


<?php include '../../componentes/footer.php'; ?>