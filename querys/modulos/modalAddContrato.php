<!-- Modal para agregar un nuevo contrato -->
<div class="modal fade" id="modalAddContrato" tabindex="-1" aria-labelledby="modalAddContratoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddContratoLabel">Agregar Contrato</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-add-contrato">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nombreContrato" class="form-label">Nombre del Contrato</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                <input type="text" class="form-control" id="nombreContrato" name="nombreContrato" required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="idCliente" class="form-label">Seleccione un Cliente</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <select class="form-select" id="idCliente" name="idCliente" required>
                  <?php foreach ($clientesMap as $cliente): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombreCliente']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-6 mb-3">
  <label for="idProducto" class="form-label">Seleccione un Producto</label>
  <div class="input-group">
    <span class="input-group-text"><i class="bi bi-box"></i></span>
    <select class="form-select" id="idProducto" name="idProducto" required>
      <option value="">Seleccione un producto</option>
    </select>
  </div>
</div>
            <div class="col-md-6 mb-3">
              <label for="idProveedor" class="form-label">Seleccione un Proveedor</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-truck"></i></span>
                <select class="form-select" id="idProveedor" name="idProveedor" required>
                  <?php foreach ($proveedorMap as $proveedor): ?>
                    <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombreProveedor']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="idMedio" class="form-label">Seleccione un Medio</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-broadcast"></i></span>
                <select class="form-select" id="idMedio" name="IdMedios" required>
                  <?php foreach ($mediosMap as $medio): ?>
                    <option value="<?php echo $medio['id']; ?>"><?php echo $medio['NombredelMedio']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="idFormaDePago" class="form-label">Seleccione una Forma de Pago</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                <select class="form-select" id="idFormaDePago" name="id_FormadePago" required>
                  <?php foreach ($pagosMap as $pago): ?>
                    <option value="<?php echo $pago['id']; ?>"><?php echo $pago['NombreFormadePago']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="estado" class="form-label">Estado del Contrato Nuevo</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                <select class="form-select" id="estado" name="Estado" required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-add-contrato">Agregar Contrato</button>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/addContrato.js"></script>