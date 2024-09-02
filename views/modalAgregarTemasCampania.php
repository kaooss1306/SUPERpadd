<div class="modal fade bd-example-modal-lg" id="modalAgregarTema" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ActualizarMedio">Seleccionar Temas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para actualizar la campaña -->
                <form id="formularioMedios">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="hidden" name="idcampania" value="<?php echo $idCampania ?>">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                <select class="form-control" id="id_Temas" name="id_Temas" placeholder="ID Temas" required>
                                    <?php if (empty($temasDisponibles)) : ?>
                                        <option value="">No hay temas disponibles</option>
                                    <?php else : ?>
                                        <?php foreach ($temasDisponibles as $id => $tema) : ?>
                                            <option value="<?php echo $id; ?>"><?php echo $tema['NombreTema']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" onclick="agregarMedioCampania()">
                    Agregar Temas
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Definir variables globales
    const API_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc";
    const BASE_URL = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1";

    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el ID de la campaña (asumiendo que está disponible en PHP)
        const idCampania = <?php echo json_encode($idCampania); ?>;

        // Cargar los temas de la campaña al cargar la página
        cargarTemasPorCampania(idCampania);
    });

    function agregarMedioCampania() {
        const formulario = document.getElementById('formularioMedios');

        // Obtener los valores de los campos individuales
        let idCampania = formulario.querySelector('input[name="idcampania"]').value;
        let tema = formulario.querySelector('select[name="id_Temas"]').value;
        tema = parseInt(tema, 10);
        idCampania = parseInt(idCampania, 10);
        const mapping = {
            "id_temas": tema,
            "id_campania": idCampania
        };

        // Construir el path con el ID de la campaña
        const url = `${BASE_URL}/campania_temas`;

        // Agrego data a tabla intermedia
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'apikey': API_KEY,
                'Authorization': `Bearer ${API_KEY}`
            },
            body: JSON.stringify(mapping)
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Agregado exitosamente',
                text: 'El tema ha sido agregado correctamente.',
                showConfirmButton: false,
                timer: 1500
            });
            // Enviar ID campaña a la función carga
            cargarTemasPorCampania(idCampania);
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarTema'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al actualizar la campaña:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al actualizar la campaña.',
                showConfirmButton: true
            });
        });
    }

    function cargarTemasPorCampania(idCampania) {
        const authHeader = {
            "apikey": API_KEY,
            "Authorization": `Bearer ${API_KEY}`,
            "Content-Type": "application/json"
        };

        // 1. Obtener los IDs de los temas desde la tabla intermedia filtrados por id_campania
        fetch(`${BASE_URL}/campania_temas?id_campania=eq.${idCampania}&select=*`, {
            method: 'GET',
            headers: authHeader
        })
        .then(response => response.json())
        .then(campaniaTemas => {
            // Extraer los IDs de los temas
            const temaIds = campaniaTemas.map(item => item.id_temas);

            // 2. Obtener la información de los temas usando los IDs obtenidos
            const temasPromises = temaIds.map(id => {
                return fetch(`${BASE_URL}/Temas?id_tema=eq.${id}&select=*`, {
                    method: 'GET',
                    headers: authHeader
                })
                .then(response => response.json());
            });

            // Esperar a que se resuelvan todas las promesas
            return Promise.all(temasPromises);
        })
        .then(temas => {
            // 3. Llamar a la función para rellenar la tabla con la información de los temas
            rellenarTabla(temas);
        })
        .catch(error => {
            console.error('Error al obtener los temas:', error);
        });
    }

    async function obtenerNombreMedio(idMedio) {
    try {
        const response = await fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Medios?id=eq.${idMedio}&select=*`, {
            headers: {
                'apikey': API_KEY,
                'Authorization': `Bearer ${API_KEY}`,
                'Range': '0-9'
            }
        });

        const data = await response.json();
        return data.length > 0 ? data[0].NombredelMedio : 'No aplica'; // Cambia 'nombre_medio' por el campo correcto del JSON
    } catch (error) {
        console.error('Error al obtener el nombre del medio:', error);
        return 'Error';
    }
}

async function rellenarTabla(temas) {

    const tableHead = document.querySelector('#table1 thead');
    const tableBody = document.querySelector('#table1 tbody');

    // Limpiar el contenido previo de la tabla
    tableHead.innerHTML = '';
    tableBody.innerHTML = '';

    // Crear el encabezado de la tabla
    const headerRow = document.createElement('tr');
    const headers = ['ID', 'Nombre Tema', 'Código Megatime', 'Duración', 'Cooperado', 'Rubro', 'Nombre Medio'];
    headers.forEach(headerText => {
        const th = document.createElement('th');
        th.textContent = headerText;
        headerRow.appendChild(th);
    });
    tableHead.appendChild(headerRow);

    // Crear las filas de la tabla con los datos de los temas
    for (const temaArray of temas) {
        const tema = temaArray[0]; // temaArray contiene un array con un solo objeto
        const row = document.createElement('tr');

        const idCell = document.createElement('td');
        idCell.textContent = tema.id_tema;
        row.appendChild(idCell);

        const nombreCell = document.createElement('td');
        nombreCell.textContent = tema.NombreTema;
        row.appendChild(nombreCell);

        const CodigoMegatimeCell = document.createElement('td');
        CodigoMegatimeCell.textContent = tema.CodigoMegatime || 'No aplica';
        row.appendChild(CodigoMegatimeCell);

        const duracionCell = document.createElement('td');
        duracionCell.textContent = tema.Duracion || 'No aplica';
        row.appendChild(duracionCell);

        const cooperadoCell = document.createElement('td');
        cooperadoCell.textContent = tema.cooperado || 'No aplica';
        row.appendChild(cooperadoCell);

        const rubroCell = document.createElement('td');
        rubroCell.textContent = tema.rubro || 'No aplica';
        row.appendChild(rubroCell);

        const medioCell = document.createElement('td');
        const nombreMedio = await obtenerNombreMedio(tema.id_medio);
        medioCell.textContent = nombreMedio;
        row.appendChild(medioCell);

        tableBody.appendChild(row);
    }
}

</script>
