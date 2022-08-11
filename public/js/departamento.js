const url = window.location;
let tabla_departamentos;

const alertaDepartamento = (title, text, icon) => {
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

const listarDepartamentos = async () => {
    tabla_departamentos = await $("#tabla_departamentos").DataTable({
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
            { data: "nombre_departamento" },
            { data: "descripcion_departamento" },
            {
                data: "id_departamento",
                render: function (data) {
                    return `<button class="btn btn-primary btn-sm" onclick="obtenerDepartamento(${data})"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" onclick="eliminarDeparamento(${data})"><i class="fa fa-trash"></i></button>`;
                },
            },
        ],
        fnRowCallback: function (nRow) {
            $($(nRow).find("td")[3]).css("text-align", "center");
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Todos"],
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
        },
    });

    tabla_departamentos.on("draw.dt", function () {
        const PageInfo = $("#tabla_departamentos").DataTable().page.info();
        tabla_departamentos
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
    });
};

const abrirModal = () => {
    $("#modalDepartamento").modal({
        show: false,
        backdrop: "static",
    });
    $("#modalDepartamento").modal("show");
};

const cerrarModal = () => {
    $("#modalDepartamento").modal("hide");
    $("#id_departamento").val("");
    $("#nombre").val("");
    $("#desc").val("");
};

const agregarDepartamento = async () => {
    const _token = $("#token").val();
    const nombre_departamento = $("#nombre").val();
    const descripcion_departamento = $("#desc").val();

    const data = {
        nombre_departamento,
        descripcion_departamento,
    };

    const response = await fetch(`${url}`, {
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
        alertaDepartamento("Exito", result.message, "success");
        tabla_departamentos.ajax.reload();
    } else {
        alertaDepartamento("Error", result.message, "error");
    }
};

const obtenerDepartamento = async (id_departamento) => {
    const response = await fetch(`${url}/${id_departamento}`, {
        method: "GET",
        mode: "cors",
        headers: {
            "Content-Type": "application/json",
        },
    });

    const result = await response.json();

    if (result.success) {
        abrirModal();
        console.log(result.departamento);
        $("#id_departamento").val(result.departamento.id_departamento);
        $("#nombre").val(result.departamento.nombre_departamento);
        $("#desc").val(result.departamento.descripcion_departamento);
    } else {
        alertaDepartamento("Error", result.message, "error");
    }
};

const actualizarDepartamento = async () => {
    const _token = $("#token").val();
    const id_departamento = $("#id_departamento").val();
    const nombre_departamento = $("#nombre").val();
    const descripcion_departamento = $("#desc").val();

    const data = {
        nombre_departamento,
        descripcion_departamento,
    };

    const response = await fetch(`${url}/${id_departamento}`, {
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
        alertaDepartamento("Exito", result.message, "success");
        tabla_departamentos.ajax.reload();
    } else {
        alertaDepartamento("Error", result.message, "error");
    }
};

const guardarDepartamento = async () => {
    const id_departamento = $("#id_departamento").val();

    if ($("#nombre").val() == "" || $("#desc").val() == "") {
        return alertaDepartamento(
            "Error",
            "Debe llenar todos los campos",
            "error"
        );
    }

    if (id_departamento == "") {
        await agregarDepartamento();
    } else {
        await actualizarDepartamento();
    }
};

const eliminarDeparamento = async (id_departamento) => {
    const _token = $("#token").val();

    const response = await fetch(`${url}/${id_departamento}`, {
        method: "DELETE",
        mode: "cors",
        headers: {
            "X-CSRF-TOKEN": _token,
            "Content-Type": "application/json",
        },
    });

    const result = await response.json();

    if (result.success) {
        alertaDepartamento("Exito", result.message, "success");
        tabla_departamentos.ajax.reload();
    } else {
        alertaDepartamento("Error", result.message, "error");
    }
}
