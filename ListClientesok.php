<?php
// Iniciar la sesión
session_start();

// Función para hacer peticiones cURL
include 'querys/qclientes.php';

include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<style>
       .is-invalid {
        border-color: #dc3545 !important;
    }
    .custom-tooltip {
        position: absolute;
        background-color: #dc3545;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s;
        pointer-events: none;
    }
    .custom-tooltip::before {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #dc3545 transparent transparent transparent;
    }
    .input-wrapper {
        position: relative;
    }
</style>
<div class="main-content">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Clientes</li>
        </ol>
    </nav><br>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header milinea">
                            <div class="titulox"><h4>Listado de Clientes</h4></div>
                            <div class="agregar"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClienteModal"><i class="fas fa-plus-circle"></i> Agregar Cliente</a></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExportadora">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Cliente</th>
                                            <th>Nombre de Fantasia</th>
                                            <th>Grupo</th>
                                            <th>Razón Social</th>
                                            <th>Tipo de Cliente</th>
                                            <th>Rut Empresa</th>
                                            <th>Región</th>
                                            <th>Comuna</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?php echo $cliente['id_cliente']; ?></td>
                                            <td><?php echo $cliente['nombreCliente']; ?></td>
                                            <td><?php echo $cliente['nombreFantasia']; ?></td>
                                            <td><?php echo $cliente['grupo']; ?></td>
                                            <td><?php echo $cliente['razonSocial']; ?></td>
                                            <td><?php echo $tiposClienteMap[$cliente['id_tipoCliente']] ?? ''; ?></td>
                                            <td><?php echo $cliente['RUT']; ?></td>
                                            <td><?php echo $regionesMap[$cliente['id_region']] ?? ''; ?></td>
                                            <td><?php echo $comunasMap[$cliente['id_comuna']] ?? ''; ?></td>
                                            <td>
                                            <div class="alineado">
       <label class="custom-switch sino" data-toggle="tooltip" 
       title="<?php echo $cliente['estado'] ? 'Desactivar Cliente' : 'Activar Cliente'; ?>">
    <input type="checkbox" 
           class="custom-switch-input estado-switch"
           data-id="<?php echo $cliente['id_cliente']; ?>" data-tipo="cliente" <?php echo $cliente['estado'] ? 'checked' : ''; ?>> <span class="custom-switch-indicator"></span>
</label>
    </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary micono" href="views/viewCliente.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" data-toggle="tooltip" title="Ver Cliente"><i class="fas fa-eye "></i></a>
                                                <button type="button" class="btn btn-success micono" data-bs-toggle="modal" data-bs-target="#actualizarcliente" data-idcliente="<?php echo $cliente['id_cliente']; ?>" onclick="loadClienteData(this)" ><i class="fas fa-pencil-alt"></i></button>


                                            

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

















<!-- Modal para Agregar Cliente -->
<div class="modal fade" id="addClienteModal" tabindex="-1" aria-labelledby="addClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClienteModalLabel">Agregar Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addClienteForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreFantasia" class="form-label">Nombre de Fantasía</label>
                                <input type="text" class="form-control" id="nombreFantasia" name="nombreFantasia">
                            </div>
                            <div class="mb-3">
                                <label for="id_tipoCliente" class="form-label">Tipo de Cliente</label>
                                <select class="form-select" id="id_tipoCliente" name="id_tipoCliente" required>
                                <?php foreach ($tiposCliente as $tipo): ?>
                                <option value="<?php echo $tipo['id_tyipoCliente']; ?>"><?php echo htmlspecialchars($tipo['nombreTipoCliente']); ?></option>
                            <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="razonSocial" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razonSocial" name="razonSocial" required>
                            </div>
                            <div class="mb-3">
                                <label for="grupo" class="form-label">Grupo</label>
                                <input type="text" class="form-control" id="grupo" name="grupo">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3 input-wrapper">
                        <label for="RUT" class="form-label">RUT Empresa</label>
                        <input type="text" class="form-control" id="RUT" name="RUT" required>
                        <div class="custom-tooltip" id="RUT-tooltip"></div>
                    </div>
                            <div class="mb-3">
                                <label for="giro" class="form-label">Giro</label>
                                <input type="text" class="form-control" id="giro" name="giro" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreRepresentanteLegal" class="form-label">Nombre Representante Legal</label>
                                <input type="text" class="form-control" id="nombreRepresentanteLegal" name="nombreRepresentanteLegal" required>
                            </div>
                            <div class="mb-3 input-wrapper">
                        <label for="Rut_representante" class="form-label">RUT Representante</label>
                        <input type="text" class="form-control" id="Rut_representante" name="Rut_representante" required>
                        <div class="custom-tooltip" id="Rut_representante-tooltip"></div>
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="direccionEmpresa" class="form-label">Dirección Empresa</label>
                                <input type="text" class="form-control" id="direccionEmpresa" name="direccionEmpresa" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_region" class="form-label">Región</label>
                                <select class="form-select" id="id_region" name="id_region" required>
                                    <?php foreach ($regiones as $region): ?>
                                        <option value="<?php echo $region['id']; ?>"><?php echo $region['nombreRegion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_comuna" class="form-label">Comuna</label>
                                <select class="form-select" id="id_comuna" name="id_comuna" required>
                                    <?php foreach ($comunas as $comuna): ?>
                                        <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>"><?php echo $comuna['nombreComuna']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3 input-wrapper">
                        <label for="telCelular" class="form-label">Teléfono Celular</label>
                        <input type="tel" class="form-control" id="telCelular" name="telCelular" required>
                        <div class="custom-tooltip" id="telCelular-tooltip"></div>
                    </div>
                    <div class="mb-3 input-wrapper">
                        <label for="telFijo" class="form-label">Teléfono Fijo</label>
                        <input type="tel" class="form-control" id="telFijo" name="telFijo">
                        <div class="custom-tooltip" id="telFijo-tooltip"></div>
                    </div>
                            <div class="mb-3 input-wrapper">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="custom-tooltip" id="email-tooltip"></div>
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formato" class="form-label">Formato</label>
                                <select class="form-select" id="formato" name="formato">
                                    <option value="">Seleccionar Formato</option>
                                    <option value="Fee">Fee</option>
                                    <option value="% Comisión Offline">% Comisión Offline</option>
                                    <option value="% Comisión Online">% Comisión Online</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nombreMoneda" class="form-label">Moneda</label>
                                <select class="form-select" id="nombreMoneda" name="nombreMoneda">
                                    <option value="UF">UF</option>
                                    <option value="Peso">Peso</option>
                                    <option value="Dólar">Dólar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor</label>
                                <input type="number" class="form-control" id="valor" name="valor">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveClienteBtn">Guardar Cliente</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var Fn = {
        validaRut: function(rutCompleto) {
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto)) return false;
            var tmp = rutCompleto.split('-');
            var digv = tmp[1];
            var rut = tmp[0];
            if (digv == 'K') digv = 'k';
            return (Fn.dv(rut) == digv);
        },
        dv: function(T) {
            var M = 0, S = 1;
            for (; T; T = Math.floor(T / 10)) S = (S + T % 10 * (9 - M++ % 6)) % 11;
            return S ? S - 1 : 'k';
        }
    };
    function validaPhoneChileno(phone) {
        // Patrón para teléfonos chilenos
        // Acepta formatos: +56912345678, 912345678, 221234567
        var phonePattern = /^(\+?56|0)?([2-9]\d{8}|[2-9]\d{7})$/;
        return phonePattern.test(phone);
    }
    function showError(input, message) {
        input.classList.add('is-invalid');
        var tooltip = document.getElementById(input.id + '-tooltip');
        tooltip.textContent = message;
        tooltip.style.opacity = '1';
        positionTooltip(input, tooltip);
    }

    function hideError(input) {
        input.classList.remove('is-invalid');
        var tooltip = document.getElementById(input.id + '-tooltip');
        tooltip.style.opacity = '0';
    }

    function positionTooltip(input, tooltip) {
        var rect = input.getBoundingClientRect();
        tooltip.style.left = '10px';
        tooltip.style.top = -(tooltip.offsetHeight + 5) + 'px';
    }
    

    // Validación en tiempo real para RUTs
    var rutInputs = document.querySelectorAll('#RUT, #Rut_representante');
    rutInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value === "") {
                hideError(this);
            } else if (!Fn.validaRut(this.value)) {
                showError(this, "RUT INVALIDO - DEBES INGRESAR SIN PUNTOS Y CON GUIÓN");
            } else {
                hideError(this);
            }
        });
    });

    // Validación en tiempo real para Email
    var emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function() {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value === "") {
            hideError(this);
        } else if (!emailPattern.test(this.value)) {
            showError(this, "EMAIL INCORRECTO");
        } else {
            hideError(this);
        }
    });

      // Validación en tiempo real para teléfonos
      var phoneInputs = document.querySelectorAll('#telCelular, #telFijo');
    phoneInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value === "") {
                hideError(this);
            } else if (!validaPhoneChileno(this.value)) {
                showError(this, "NÚMERO DE TELÉFONO NO VÁLIDO");
            } else {
                hideError(this);
            }
        });
    });

    document.getElementById('saveClienteBtn').addEventListener('click', function() {
        if (validateForm()) {
            submitForm();
        } else {
            alert("Por favor, complete todos los campos correctamente antes de enviar.");
        }
    });

    function validateForm() {
        var inputs = document.querySelectorAll('#addClienteForm input, #addClienteForm select');
        var valid = true;
        
        inputs.forEach(function(input) {
            if (input.value === "") {
                input.classList.add("invalid");
                valid = false;
            } else {
                input.classList.remove("invalid");
            }
        });

        if (!Fn.validaRut(document.getElementById('RUT').value) ||
            !Fn.validaRut(document.getElementById('Rut_representante').value)) {
            valid = false;
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(document.getElementById('email').value)) {
            valid = false;
        }

        return valid;
    }

    function submitForm() {
    var form = document.getElementById('addClienteForm');
    var formData = new FormData(form);

    fetch('querys/qinsert_cliente.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Cliente agregado exitosamente',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
            $('#addClienteModal').modal('hide');
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Error al agregar cliente: ' + data.error,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'Error al procesar la solicitud',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}
});
</script>






<?php include 'componentes/settings.php'; ?>
<script src="assets/js/toggleClientes.js"></script>
<script src="assets/js/deleteCliente.js"></script>
<?php include 'componentes/footer.php'; ?>