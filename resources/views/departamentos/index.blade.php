@include('partials.header')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><b>Departamentos</b></div>

            <div class="card-body">
                <button class="btn btn-success mb-3" onclick="abrirModal();">Agregar Departamento</button>
                <div class="modal fade" id="modalDepartamento" tabindex="-1" aria-labelledby="modalDepartamentoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDepartamentoLabel">Departamento</h5>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id_departamento" id="id_departamento">
                                    <div class="form-group mb-3">
                                        <label for="">Nombre Departamento:</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre"
                                            placeholder="Digite el nombre" required />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Descripción:</label>
                                        <input class="form-control" type="text" name="desc" id="desc"
                                            placeholder="Digite la descripción" required />
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    onclick="cerrarModal();">Cancelar</button>
                                <button type="button" onclick="guardarDepartamento();"
                                    class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla_departamentos"
                    class="table display nowrap dataTable dtr-inline table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 40%;">Nombre Puesto</th>
                            <th style="width: 50%;">Descripción Puesto</th>
                            <th style="width: 5%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 40%;">Nombre Puesto</th>
                            <th style="width: 50%;">Descripción Puesto</th>
                            <th style="width: 5%;">Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/departamento.js') }}"></script>
<script>
    $(document).ready(function() {
        listarDepartamentos();
        $("#modalDepartamento").on("shown.bs.modal", () => {
            $("#nombre").trigger("focus");
        });
    });
</script>

@include('partials.footer')
