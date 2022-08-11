const url = window.location;
let tabla_agencias;

const alertaAgencia = (title, text, icon) => {
    Swal.fire({
        title: `${title}`,
        text: `${text}`,
        icon: `${icon}`,
        showConfirmButton: false,
        timer: 2500,
        allowOutsideClick: false,
        heightAuto: false,
    });
};

const listarAgencias = async () => {
    tabla_agencias = await $("#tabla_agencias").DataTable({
        ordering: false,
        responsive: true,
        autoWidth: false,
        ajax: {
            method: "GET",
            url: `${url}/listar`,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            dataSrc: "data",
        },
        columns: [
            { defaultContent: "" },
            { data: "nombre_agencia" },
            { data: "direccion_agencia" },
            { data: "telefono_agencia" },
            {
                data: "id_agencia",
                render: function (data) {
                    return `<button class="btn btn-primary btn-sm" onclick="obtenerAgencia(${data})"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" onclick="confirmarEliminadoAgencia(${data})"><i class="fa fa-trash-can"></i></button>`;
                },
            },
        ],
        fnRowCallback: function (nRow) {
            $($(nRow).find("td")[4]).css("text-align", "center");
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Todos"],
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
        },
    });

    tabla_agencias.on("draw.dt", function () {
        const PageInfo = $("#tabla_agencias").DataTable().page.info();
        tabla_agencias
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
    });
};

const abrirModal = () => {
    $("#modalAgencia").modal({
        show: false,
        backdrop: "static",
    });
    $("#modalAgencia").modal("show");
};

const cerrarModal = () => {
    $("#modalAgencia").modal("hide");
    $("#id_agencia").val("");
    $("#nombre_agencia").val("");
    $("#direccion_agencia").val("");
    $("#telefono_agencia").val("");
};

const agregarAgencia = async () => {
    const _token = $("#token").val();
    const nombre_agencia = $("#nombre_agencia").val();
    const direccion_agencia = $("#direccion_agencia").val();
    const telefono_agencia = $("#telefono_agencia").val();

    const data = {
        nombre_agencia,
        direccion_agencia,
        telefono_agencia,
    };

    const response = await fetch(url, {
        method: "POST",
        mode: "cors",
        headers: {
            "X-CSRF-TOKEN": _token,
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });

    const result = await response.json();

    if (result.success) {
        cerrarModal();
        alertaAgencia("¡Agregado!", result.message, "success");
        tabla_agencias.ajax.reload();
    } else {
        alert(result.message);
    }
};

const obtenerAgencia = async (id_agencia) => {
    const response = await fetch(`${url}/${id_agencia}`, {
        method: "GET",
        mode: "cors",
        headers: {
            "Content-Type": "application/json",
        },
    });

    const result = await response.json();

    if (result.success) {
        abrirModal();
        $("#id_agencia").val(result.agencia.id_agencia);
        $("#nombre_agencia").val(result.agencia.nombre_agencia);
        $("#direccion_agencia").val(result.agencia.direccion_agencia);
        $("#telefono_agencia").val(result.agencia.telefono_agencia);
    } else {
        alert(result.message);
    }
};

const actualizarAgencia = async () => {
    const _token = $("#token").val();
    const id_agencia = $("#id_agencia").val();
    const nombre_agencia = $("#nombre_agencia").val();
    const direccion_agencia = $("#direccion_agencia").val();
    const telefono_agencia = $("#telefono_agencia").val();

    const data = {
        nombre_agencia,
        direccion_agencia,
        telefono_agencia,
    };

    const response = await fetch(`${url}/${id_agencia}`, {
        method: "PUT",
        mode: "cors",
        headers: {
            "X-CSRF-TOKEN": _token,
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });

    const result = await response.json();

    if (result.success) {
        cerrarModal();
        alertaAgencia("¡Actualizado!", result.message, "success");
        tabla_agencias.ajax.reload();
    } else {
        alert(result.message);
    }
};

const guardarAgencia = async () => {
    const id = $("#id_agencia").val();

    if (
        $("#nombre_agencia").val() == "" ||
        $("#direccion_agencia").val() == "" ||
        $("#telefono_agencia").val() == ""
    ) {
        return alertaAgencia(
            "¡Error!",
            "Por favor complete todos los campos",
            "error"
        );
    }

    if (id === "") {
        await agregarAgencia();
    } else {
        await actualizarAgencia();
    }
};

const confirmarEliminadoAgencia = (id_agencia) => {
  Swal.fire({
    title: "¿Seguro/a desea eliminar la agencia?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar",
    allowOutsideClick: false,
  }).then((result) => {
    if (result.isConfirmed) {
      eliminarAgencia(id_agencia);
    }
  });
};

const eliminarAgencia = async (id_agencia) => {
    const _token = $("#token").val();

    const response = await fetch(`${url}/${id_agencia}`, {
        method: "DELETE",
        mode: "cors",
        headers: {
            "X-CSRF-TOKEN": _token,
            "Content-Type": "application/json",
        },
    });

    const result = await response.json();

    if (result.success) {
        alertaAgencia("¡Eliminado!", result.message, "success");
        tabla_agencias.ajax.reload();
    } else {
        alert(result.message);
    }
}
