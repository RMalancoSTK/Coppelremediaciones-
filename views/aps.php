<h1 class="mt-4">APS</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">APS</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#apsModal" id="btnNuevo">
            Crear nuevo APS
        </button>
    </div>
    <div class="card-body">
        <table id="apsTable" class="table table-bordered table-striped" aria-describedby="apsTable_info">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Registro</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Registro</th>
                    <th scope="col">Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="apsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAps" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id_aps" name="id_aps">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" onclick="guardarAps(event)">
                                    <i class="fas fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>