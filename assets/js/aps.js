"use strict";

$(function () {
  apsTable();
  document
    .getElementById("btnNuevo")
    .addEventListener(
      "click",
      limpiarFormulario,
      (document.getElementById("modalTitle").innerHTML = "Nuevo APS")
    );
});

function apsTable() {
  if (document.getElementById("apsTable")) {
    const acciones = (data, type, row) => {
      if (row.estatus_aps == `ACTIVO`) {
        return `
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#apsModal" onclick="editarRol(${row.id_aps})"><i class="fas fa-edit"></i></button>
          <button type="button" class="btn btn-danger btn-sm mr-1" onclick="desactivarAps(${row.id_aps})"><i class="fas fa-trash"></i></button>
        </div>
        `;
      } else {
        return `
        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-success btn-sm mr-1" onclick="activarAps(${row.id_aps})"><i class="fas fa-check"></i></button>
        </div>
        `;
      }
    };

    const estatus = (data, type, row) => {
      if (row.estatus_aps == `ACTIVO`) {
        return `<span class="badge badge-success">${row.estatus_aps}</span>`;
      } else {
        return `<span class="badge badge-danger">${row.estatus_aps}</span>`;
      }
    };

    $("#apsTable").DataTable({
      responsive: false,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Buscar...",
        lengthMenu: "Mostrar _MENU_ entradas",
        zeroRecords: "No hay entradas",
        info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        infoEmpty: "No hay entradas",
        infoFiltered: "(filtrado de _MAX_ entradas totales)",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "Siguiente",
          previous: "Anterior",
        },
      },
      ajax: {
        url: "../aps/listapsjson",
        dataSrc: "",
      },
      columns: [
        { data: "id_aps" },
        { data: "nombre" },
        { data: "estatus_aps", render: estatus },
        { data: "fecha_reg" },
        { data: null, render: acciones },
      ],
    });
  }
}

function editarRol(id) {
  document.getElementById("modalTitle").innerHTML = "Editar APS";
  limpiarFormulario();
  $.ajax({
    url: `../aps/getApsJson`,
    type: "POST",
    data: { id_aps: id },
    success: function (response) {
      var data = JSON.parse(response);
      document.getElementById("id_aps").value = data.id_aps;
      document.getElementById("nombre").value = data.nombre;
    },
  });
}

function limpiarFormulario() {
  document.getElementById("id_aps").value = "";
  document.getElementById("nombre").value = "";
}

function guardarAps(event) {
  event.preventDefault();
  var id_aps = document.getElementById("id_aps").value;
  var nombre = document.getElementById("nombre").value;
  $.ajax({
    url: `../aps/guardarApsJson`,
    type: "POST",
    data: {
      id_aps: id_aps,
      nombre: nombre,
    },
    success: function (response) {
      console.log(response);
      var data = JSON.parse(response);
      if (data.status == "success") {
        document.getElementById("btnCerrar").click();
        Swal.fire("¡Éxito!", data.message, "success");
        $("#apsTable").DataTable().ajax.reload();
      } else {
        Swal.fire("¡Error!", data.message, "error");
      }
    },
  });
  return false;
}

function desactivarAps(id) {
  let estatus = 0;
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Se desactivará el registro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, desactivarlo!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `../aps/desactivarApsJson`,
        type: "POST",
        data: { id_aps: id, estatus: estatus },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.status == "success") {
            Swal.fire("¡Éxito!", data.message, "success");
            $("#apsTable").DataTable().ajax.reload();
          } else {
            Swal.fire("¡Error!", data.message, "error");
          }
        },
      });
    }
  });
}

function activarAps(id) {
  let estatus = 1;
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Se activará el registro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, activarlo!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `../aps/activarApsJson`,
        type: "POST",
        data: { id_aps: id, estatus: estatus },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.status == "success") {
            Swal.fire("¡Éxito!", data.message, "success");
            $("#apsTable").DataTable().ajax.reload();
          } else {
            Swal.fire("¡Error!", data.message, "error");
          }
        },
      });
    }
  });
}
