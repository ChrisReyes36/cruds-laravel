@include('partials.header')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><b>Agencias</b></div>

            <div class="card-body">
                <button class="btn btn-success mb-3" onclick="abrirModal();">Agregar Agencia</button>
                <div class="modal fade" id="modalAgencia" tabindex="-1" aria-labelledby="modalAgenciaLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAgenciaLabel">Agencia</h5>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id_agencia" id="id_agencia">
                                    <div class="form-group mb-3">
                                        <label for="nombre_agencia">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_agencia"
                                            name="nombre_agencia" placeholder="Nombre">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="direccion_agencia">Dirección</label>
                                        <input type="text" class="form-control" id="direccion_agencia"
                                            name="direccion_agencia" placeholder="Dirección">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="telefono_agencia">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono_agencia"
                                            name="telefono_agencia" placeholder="Teléfono">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    onclick="cerrarModal();">Cancelar</button>
                                <button type="button" onclick="guardarAgencia();"
                                    class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla_agencias"
                    class="table display nowrap dataTable dtr-inline table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Nombre Agencia</th>
                            <th style="width: 55%;">Dirección Agencia</th>
                            <th style="width: 15%;">Teléfono Agencia</th>
                            <th style="width: 5%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Nombre Agencia</th>
                            <th style="width: 55%;">Dirección Agencia</th>
                            <th style="width: 15%;">Teléfono Agencia</th>
                            <th style="width: 5%;">Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                {{-- <table class="table table-striped table-bordered" id="tabla_agencias">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($agencias); $i++)
                            <tr>
                                <th scope="row">{{ $agencias[$i]['id_agencia'] }}</th>
                                <td>{{ $agencias[$i]['nombre_agencia'] }}</td>
                                <td>{{ $agencias[$i]['direccion_agencia'] }}</td>
                                <td>{{ $agencias[$i]['telefono_agencia'] }}</td>
                                <td>
                                    <button class="btn btn-primary"
                                        onclick="obtenerAgencia({{ $agencias[$i]['id_agencia'] }});">Editar</button>
                                    <button class="btn btn-danger"
                                        onclick="eliminarAgencia({{ $agencias[$i]['id_agencia'] }});">Eliminar</button>
                                </td>
                            </tr>
                        @endfor
                        @foreach ($agencias as $agencia)
                          <tr>
                            <th scope="row">{{ $agencia->id }}</th>
                            <td>{{ $agencia->nombre }}</td>
                            <td>{{ $agencia->direccion }}</td>
                            <td>{{ $agencia->telefono }}</td>
                            <td>
                              <a href="{{ route('agencias.show', $agencia->id) }}" class="btn btn-primary">Ver</a>
                              <a href="{{ route('agencias.edit', $agencia->id) }}" class="btn btn-warning">Editar</a>
                              <form action="{{ route('agencias.destroy', $agencia->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/agencia.js') }}"></script>
<script>
    $(document).ready(function() {
        listarAgencias();
        $("#modalAgencia").on("shown.bs.modal", () => {
            $("#nombre_agencia").trigger("focus");
        });
    });
</script>

@include('partials.footer')
